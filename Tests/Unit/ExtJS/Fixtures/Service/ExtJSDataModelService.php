<?php

require_once(t3lib_extMgm::extPath('extension_builder') . 'Classes/Service/ExtJS/DataModelService.php');

class Tx_ExtensionBuilder_Tests_ExtJSDataModelService extends Tx_ExtensionBuilder_Service_ExtJS_DataModelService {

	public function __construct() {
		$this->sourceFolder = t3lib_extMgm::extPath('extension_builder', 'Tests/Unit/ExtJS/Fixtures/Domain/Model/');
		$this->excludeFolders[] = $this->sourceFolder . 'Class/';
	}

	protected function getClassNameFromFileName($fileName) {
		$className = str_replace(t3lib_extMgm::extPath('extension_builder', 'Tests/Unit/ExtJS/Fixtures/'), NULL, $fileName);
		return 'Tx_ExtensionBuilder_Tests_ExtJS_Fixtures_' . str_replace('/', '_', substr($className, 0, -4));
	}

	/**
	 * Make all methods public
	 *
	 * @param mixed $method
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments) {
		if (method_exists($this, $method)) {
			switch (count($arguments)) {
				case 1:
					return $this->$method($arguments[0]);
				case 2:
					return $this->$method($arguments[0], $arguments[1]);
				case 3:
					return $this->$method($arguments[0], $arguments[1], $arguments[2]);
				case 4:
					return $this->$method($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
				case 5:
					return $this->$method($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]);
				default:
					return $this->$method();
			}
		}
	}
}

?>