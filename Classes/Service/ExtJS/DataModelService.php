<?php

require_once(t3lib_extMgm::extPath('extension_builder') . 'Resources/Private/PHP/Addendum/annotations.php');

class Tx_ExtensionBuilder_Service_ExtJS_DataModelService {

	/**
	 * @var string
	 */
	protected $sourceFolder;

	/**
	 * @var array
	 */
	protected $excludeFolders = array();

	/**
	 * @var array
	 */
	protected $sourceFiles = array();

	/**
	 * @var string
	 */
	protected $aggregateRoot;

	/**
	 *
	 */
	public function __construct() {
		$this->sourceFolder = t3lib_extMgm::extPath('extension_builder', 'Classes/Domain/Model/');
		$this->excludeFolders[] = $this->sourceFolder . 'Class/';
		$this->getSourceFiles();
		$this->includeSourceFiles();
	}

	/**
	 * @throws Tx_ExtensionBuilder_Exception
	 * @return array
	 */
	protected function getSourceFiles() {
		if (!empty($this->sourceFiles)) {
			return $this->sourceFiles;
		}

		if (!is_dir($this->sourceFolder)) {
			throw new Tx_ExtensionBuilder_Exception('Source folder does not exist', t3lib_div::SYSLOG_SEVERITY_FATAL);
		}

		$this->sourceFiles = t3lib_div::getAllFilesAndFoldersInPath($this->sourceFiles, $this->sourceFolder, 'php');

		if (!empty($this->excludeFolders)) {
			$excludeFolders = array();
			foreach ($this->excludeFolders as $excludeFolder) {
				$excludeFolders[] = str_replace('/', '\/', $excludeFolder);
			}
			$excludePattern = '/^(' . implode('|', $excludeFolders) . ')/';

			foreach ($this->sourceFiles as $index => $file) {
				if (preg_match($excludePattern, $file)) {
					unset($this->sourceFiles[$index]);
				}
			}
		}

		return $this->sourceFiles;
	}

	protected function includeSourceFiles() {
		foreach ($this->sourceFiles as $file) {
			require_once($file);
		}
	}

	public function reflectModel() {
		$this->includeSourceFiles();
	}

	protected function parseDocComment($docComment) {
			// Make sure all annotations are UppercaseFirst
		$docComment = preg_replace("/\@([a-z][^\ ]*)/e", "'@'.ucfirst('\\1')", $docComment);
			// Add () around simple values
		$docComment = preg_replace("/\* \@([^\( ]*) ([^( |\r|\n|\t)]{2,})/", "* @$1('$2')", $docComment);

		$annotationMather = new AnnotationsMatcher;
		$annotationMather->matches($docComment, $annotations);

			// Convert array<className> to a OneToMany annotation
		foreach ($annotations as $index => $annotation) {
			if (t3lib_div::isFirstPartOfStr($annotation[0]['value'], 'array<')) {
				preg_match("/\<(.*?)\>/", $annotation[0]['value'], $match);
				$annotations['OneToMany'] = array(array('targetEntity' => $match[1]));
				$annotations[$index][0]['value'] = 'array';
			}
		}

		return $annotations;
	}

	protected function getClassNameFromFileName($fileName) {
		$className = str_replace(t3lib_extMgm::extPath('extension_builder', 'Classes/'), NULL, $fileName);
		return 'Tx_ExtensionBuilder_' . str_replace('/', '_', substr($className, 0, -4));
	}

	public function getAggregateRoot() {
		if (!empty($this->aggregateRoot)) {
			return $this->aggregateRoot;
		}

		foreach ($this->sourceFiles as $index => $fileName) {
			$className = $this->getClassNameFromFileName($fileName);

				// We reflect the properties using addendum since it's far more advanced than Tx_Extbase_Reflection_ClassReflection
			$reflection = new ReflectionClass($className);
			$annotations = $this->parseDocComment($reflection->getDocComment());

			if (!empty($annotations['AggregateRoot'])) {
				$this->aggregateRoot = $className;
				return $className;
			}
		}
	}

	public function getClassLabel($input) {
		if (is_array($input)) {
			$properties = $input;
		} else {
			$properties = $this->getClassProperties($input);
		}

		foreach ($properties as $property => $config) {
			if (isset($config['Label'])) {
				return $property;
			}
		}
		return NULL;
	}

	protected function getClassProperties($className) {
		$properties = array();
		$reflection = new ReflectionClass($className);
		$reflectedProperties = $reflection->getProperties();

		foreach ($reflectedProperties as $property) {
			$propertyReflection = new ReflectionProperty($className, $property->name);
			$properties[$property->name] = $this->parseDocComment($propertyReflection->getDocComment());
		}
		return $properties;
	}

	public function getExtDataModelDescriptionFromClassNameAndAnnotations($className, $annotations, $parentClassName = NULL) {
		$extRegModelJson = new stdClass();
		$extRegModelJson->fields = array();
		$extRegModelJson->labelProperty = $this->getClassLabel($annotations);
		$extRegModelJson->validations = array();
		$extRegModelJson->hasMany = array();
		$extRegModelJson->validations = array();

		if (!empty($parentClassName)) {
			$extRegModelJson->belongsTo = $parentClassName;
		}

		foreach ($annotations as $field => $configuration) {
			if ($this->propertyIsRelation($configuration)) {
				if (!empty($configuration['OneToMany'])) {
					$extRegModelJson->hasMany[] = $this->buildAssocationDeclaration(
						$field,
						$configuration['OneToMany'][0]['targetEntity']
					);
				}
			} else {
				$extRegModelJson->fields[] = $this->buildFieldDeclaration($field, $configuration, $extRegModelJson);
			}
		}

		return $extRegModelJson;
	}

	protected function buildFieldDeclaration($field, $annotationConfiguration, &$extRegModelObject) {
		$fieldConfig = array(
			'name' => $field
		);
		if (!empty($annotationConfiguration['Var'])) {
			$fieldConfig['type'] = $annotationConfiguration['Var'][0]['value'];
		}

		if (!empty($annotationConfiguration['Validate'])) {
			foreach ($annotationConfiguration['Validate'] as $validation) {
				$validation['field'] = $field;
				$extRegModelObject->validations[] = (object) $validation;
			}
		}
		return (object) $fieldConfig;
	}

	protected function buildAssocationDeclaration($field, $targetEntity) {
		$association = new stdClass();
		$association->model = $targetEntity;
		$association->name = $field;
		return $association;
	}

	public function propertyIsRelation(array $propertyAnnotation) {
		if (!empty($propertyAnnotation['OneToMany'])) {
			return TRUE;
		}
		return FALSE;
	}

	public function render() {
		$definitionList = array();
		$this->renderObject($this->getAggregateRoot(), $definitionList, NULL);
		return $definitionList;
	}

	protected function renderObject($className, &$definitionList, $parentClass = NULL) {
		$classProperties = $this->getClassProperties($className);
		$definitionList[$className] = $this->getExtDataModelDescriptionFromClassNameAndAnnotations(
			$className,
			$classProperties,
			$parentClass
		);

		foreach ($definitionList[$className]->hasMany as $index => $oneToManyRelation) {
			$this->renderObject($oneToManyRelation->model, $definitionList, $className);
		}
	}
}

?>