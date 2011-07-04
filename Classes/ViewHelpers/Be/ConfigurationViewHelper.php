<?php

class Tx_ExtensionBuilder_ViewHelpers_Be_ConfigurationViewHelper extends Tx_ExtensionBuilder_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * @return void
	 */
	public function render() {
		$this->pageRenderer->loadPrototype(FALSE);

		$this->pageRenderer->disableCompressJavascript();
		$this->pageRenderer->disableCompressCss();
		$this->pageRenderer->setExtJsPath($this->baseUrl . 'Resources/Public/Library/ext-4.0.2a/');

		$this->pageRenderer->addJsFile($this->mainDirBackpath . TYPO3_mainDir . 'ajax.php?ajaxID=ExtDirect::getAPI&namespace=TYPO3.ExtensionBuilder', NULL, FALSE, TRUE);

		$this->pageRenderer->addInlineSettingArray('extensionBuilder', array(
			'baseUrl' => $this->baseUrl
		));

		$this->pageRenderer->addInlineLanguageLabelFile('EXT:extension_builder/Resources/Private/Language/locallang.xml');
	}

	/**
	* Gets instance of template if exists or create a new one.
	* Saves instance in viewHelperVariableContainer
	*
	* @return template $doc
	*/
	public function getDocInstance() {
		if (!isset($GLOBALS['SOBE']->doc)) {
			$GLOBALS['SOBE']->doc = t3lib_div::makeInstance('Tx_ExtensionBuilder_TYPO3_Template');
			$GLOBALS['SOBE']->doc->backPath = $GLOBALS['BACK_PATH'];
		}
		return $GLOBALS['SOBE']->doc;
	}

}

?>