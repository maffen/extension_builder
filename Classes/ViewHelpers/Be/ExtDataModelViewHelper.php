<?php

class Tx_ExtensionBuilder_ViewHelpers_Be_ExtDataModelViewHelper extends Tx_ExtensionBuilder_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * @return void
	 */
	public function render() {
		$dataModelService = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_ExtJS_DataModelService');
		$model = $dataModelService->render();

		$extOnReadyCode = '';
		foreach($model as $className => $configuration) {
			$baseFields = array(
				(object) array('name' => 'id', 'type' => 'integer'),
				(object) array('name' => 'text', 'type' => 'string')
			);

			foreach ($configuration->fields as $key => $value) {
				if ($value->name === 'id') {
					unset($baseFields[0]);
				}
				if ($value->name === 'text') {
					unset($baseFields[1]);
				}
			}

			$configuration->fields = array_merge($baseFields, $configuration->fields);
			$configuration->extend = 'ExtensionBuilder.Core.Ext.data.Model';
			$extOnReadyCode .= sprintf("Ext.define('%s', %s);", $className, json_encode($configuration));
		}

		$extOnReadyCode .= sprintf("Ext.ns('ExtensionBuilder.Core'); ExtensionBuilder.Core.aggregateRoot = '%s';",
			$dataModelService->getAggregateRoot()
		);

		// just for testing/mockup
		//$fileTreeService = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_ExtJS_FileTreeService');
		//$files = $fileTreeService->getFiles(PATH_typo3conf. 'ext/blog_example');
		//$extOnReadyCode .= 'ExtensionBuilder.Core.fileTree = '.json_encode($files) . ';';

		$this->pageRenderer->addExtOnReadyCode($extOnReadyCode, TRUE);
	}

}

?>