<?php

class Tx_ExtensionBuilder_ViewHelpers_Be_AbstractBackendViewHelper extends Tx_Fluid_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * @var string
	 */
	protected $mainDirBackpath;

	/**
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * @return void
	 */
	public function initialize() {
		parent::initialize();
		$this->pageRenderer = $this->getDocInstance()->getPageRenderer();
		$this->mainDirBackpath = str_repeat('../', substr_count(TYPO3_mainDir, '/'));
		$this->baseUrl = $this->mainDirBackpath . t3lib_extMgm::siteRelPath(
			$this->controllerContext->getRequest()->getControllerExtensionKey()
		);
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