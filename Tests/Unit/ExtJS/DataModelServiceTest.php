<?php

require_once(t3lib_extMgm::extPath('extension_builder') . 'Tests/Unit/ExtJS/Fixtures/Service/ExtJSDataModelService.php');


class Tx_ExtensionBuilder_Service_ExtJS_DataModelServiceTest extends Tx_ExtensionBuilder_Tests_BaseTest {

	protected $dataModelService;

	function setUp() {
		parent::setUp();
		$this->dataModelService = new Tx_ExtensionBuilder_Tests_ExtJSDataModelService();
	}

	public function tearDown() {

	}

	/**
	 * @test
	 */
	public function setUpTest() {
		$this->assertInstanceOf('Tx_ExtensionBuilder_Tests_ExtJSDataModelService', $this->dataModelService);
	}

	/**
	 * @test
	 */
	public function testGetSourceFiles() {

		$files = array(
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Extension.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Module.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Person.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Plugin.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Backend/Action.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Backend/Controller.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Frontend/Action.php',
			'Tests/Unit/ExtJS/Fixtures/Domain/Model/Frontend/Controller.php',
		);

		foreach ($files as $index => $file) {
			$files[$index] = t3lib_extMgm::extPath('extension_builder', $file);
		}

		$this->assertEquals(
			$files,
			array_values($this->dataModelService->getSourceFiles())
		);
	}

	/**
	 * @test
	 */
	public function testFindingRootDomainModelObject() {
		$this->dataModelService->getSourceFiles();
		$this->dataModelService->includeSourceFiles();

		$this->assertEquals(
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension',
			$this->dataModelService->getAggregateRoot()
		);
	}

	/**
	 * @test
	 */
	public function testFetchingClassProperties() {
		$this->dataModelService->getSourceFiles();
		$this->dataModelService->includeSourceFiles();

		$dataModelRootClassName = $this->dataModelService->getAggregateRoot();

		$classProperties = $this->dataModelService->getClassProperties($dataModelRootClassName);

		$expected = array(
			'key' => array(
				'Var' => array(array('value' => 'string')),
				'Validate' => array(
					array('type' => 'length', 'min' => '2'),
					array('type' => 'format', 'matcher' => '/^[a-z]{2,10}/'),
				),

			),
			'name' => array(
				'Var' => array(array('value' => 'string')),
				'Label' => array(array())
			),
			'category' => array(
				'Var' => array(array('value' => 'array')),
				'List' => array(array('value' => array('Frontend', 'Backend')))
			),
			'state' => array(
				'Var' => array(array('value' => 'string')),
				'List' => array(array('value' => array('Alpha', 'Beta', 'Test', 'Stable')))
			),
			'person' => array(
				'Var' => array(array('value' => 'array')),
				'OneToMany' => array(array('targetEntity' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Person'))
			),
			'plugin' => array(
				'Var' => array(array('value' => 'array')),
				'OneToMany' => array(array('targetEntity' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin'))
			),
			'module' => array(
				'Var' => array(array('value' => 'array')),
				'OneToMany' => array(array('targetEntity' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module'))
			)
		);

		$this->assertEquals(
			$expected,
			$classProperties
		);
	}

	/**
	 * @test
	 */
	public function testRootModelJsonNotation() {
		$this->dataModelService->getSourceFiles();
		$this->dataModelService->includeSourceFiles();

		$dataModelRootClassName = $this->dataModelService->getAggregateRoot();

		$classProperties = $this->dataModelService->getClassProperties($dataModelRootClassName);

		$dataModelDescriptionObject = $this->dataModelService->getExtDataModelDescriptionFromClassNameAndAnnotations($dataModelRootClassName, $classProperties);

		$expected = (object) array(
			'fields' => array(
				(object) array(
					'name' => 'key',
					'type' => 'string',
				),
				(object) array(
					'name' => 'name',
					'type' => 'string',
				),
				(object) array(
					'name' => 'category',
					'type' => 'array',
				),
				(object) array(
					'name' => 'state',
					'type' => 'string',
				),
			),
			'labelProperty' => 'name',
			'validations' => array(
				(object) array(
					'type' => 'length',
					'min' => 2,
					'field' => 'key',
				),
				(object) array(
					'type' => 'format',
					'matcher' => '/^[a-z]{2,10}/',
					'field' => 'key',
				),
			),
			'hasMany' => array(
				(object) array(
					'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Person',
					'name' => 'person',
				),
				(object) array(
					'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin',
					'name' => 'plugin',
				),
				(object) array(
					'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module',
					'name' => 'module',
				),
			)
		);

		$this->assertEquals($expected, $dataModelDescriptionObject);
	}

	/**
	 * @test
	 */
	public function testFindModelLabel() {
		$this->dataModelService->getSourceFiles();
		$this->dataModelService->includeSourceFiles();

		$extJS4NotatedModel = $this->dataModelService->render();

		$label = $this->dataModelService->getClassLabel('Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension');
		$this->assertEquals('name', $label);
	}

	/**
	 * @test
	 * @return void
	 */
	public function testFullModelAnnotation() {
		$this->dataModelService->getSourceFiles();
		$this->dataModelService->includeSourceFiles();

		$extJS4NotatedModel = $this->dataModelService->render();

		$expected = array(
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension' => (object) array(
				'fields' => array(
					(object) array(
						'name' => 'key',
						'type' => 'string',
					),
					(object) array(
						'name' => 'name',
						'type' => 'string'
					),
					(object) array(
						'name' => 'category',
						'type' => 'array',
					),
					(object) array(
						'name' => 'state',
						'type' => 'string',
					),
				),
				'labelProperty' => 'name',
				'validations' => array(
					(object) array(
						'type' => 'length',
						'min' => 2,
						'field' => 'key',
					),
					(object) array(
						'type' => 'format',
						'matcher' => '/^[a-z]{2,10}/',
						'field' => 'key',
					),
				),
				'hasMany' => array(
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Person',
						'name' => 'person',
					),
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin',
						'name' => 'plugin',
					),
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module',
						'name' => 'module',
					),
				),
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Person' => (object) array(
				'fields' => array(
					(object) array(
						'name' => 'name',
						'type' => 'string',
					),
					(object) array(
						'name' => 'email',
						'type' => 'string',
					),
				),
				'labelProperty' => 'name',
				'validations' => array(),
				'hasMany' => array(),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin' => (object) array(
				'fields' => array(),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Frontend_Controller',
						'name' => 'controllers',
					),
				),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Frontend_Controller' => (object) array(
				'fields' => array(),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Frontend_Action',
						'name' => 'actions',
					),
				),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Plugin',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Frontend_Action' => (object) array(
				'fields' => array(
					(object) array(
						'name' => 'name',
						'type' => 'string',
					),
				),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Frontend_Controller',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module' => (object) array(
				'fields' => array(),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Backend_Controller',
						'name' => 'controllers',
					)
				),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Extension',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Backend_Controller' => (object) array(
				'fields' => array(),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(
					(object) array(
						'model' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Backend_Action',
						'name' => 'actions',
					),
				),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Module',
			),
			'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Backend_Action' => (object) array(
				'fields' => array(
					(object) array(
						'name' => 'name',
						'type' => 'string',
					),
				),
				'labelProperty' => NULL,
				'validations' => array(),
				'hasMany' => array(),
				'belongsTo' => 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_Domain_Model_Backend_Controller',
			),
		);

		$indexes = array_keys($extJS4NotatedModel);
		foreach ($indexes as $index) {
			$this->assertEquals($expected[$index], $extJS4NotatedModel[$index], 'Classname: ' . $index);
		}
	}

}

?>