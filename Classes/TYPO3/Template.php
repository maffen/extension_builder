<?php

class Tx_ExtensionBuilder_TYPO3_Template extends template {

	/**
	 * @var Tx_ExtensionBuilder_TYPO3_PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * Gets instance of PageRenderer
	 *
	 * @return Tx_ExtensionBuilder_TYPO3_PageRenderer
	 */
	public function getPageRenderer() {
		if (!isset($this->pageRenderer)) {
			$this->pageRenderer = t3lib_div::makeInstance('Tx_ExtensionBuilder_TYPO3_PageRenderer');
			$this->pageRenderer->setTemplateFile(
				TYPO3_mainDir . 'templates/template_page_backend.html'
			);
			$this->pageRenderer->setLanguage($GLOBALS['LANG']->lang);
			$this->pageRenderer->enableConcatenateFiles();
			$this->pageRenderer->enableCompressCss();
			$this->pageRenderer->enableCompressJavascript();

				// add all JavaScript files defined in $this->jsFiles to the PageRenderer
			foreach ($this->jsFiles as $file) {
				$this->pageRenderer->addJsFile($GLOBALS['BACK_PATH'] . $file);
			}
		}
		if (intval($GLOBALS['TYPO3_CONF_VARS']['BE']['debug']) === 1) {
			$this->pageRenderer->enableDebugMode();
		}
		return $this->pageRenderer;
	}

}

?>