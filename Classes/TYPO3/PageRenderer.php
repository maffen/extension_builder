<?php

class Tx_ExtensionBuilder_TYPO3_PageRenderer extends t3lib_PageRenderer {

	/**
	 * helper function for render the javascript libraries
	 *
	 * @return string content with javascript libraries
	 */
	protected function renderJsLibraries() {
		$this->addPrototype = FALSE;

		$this->addExtJS = FALSE;

		parent::renderJsLibraries();
		$this->addExtJS = TRUE;

		$out = '';

		$out .= '<script src="' . $this->processJsFile($this->backPath . $this->extJsPath .
				'ext-all' . ($this->enableExtJsDebug ? '-debug' : '') . '.js') .
				'" type="text/javascript"></script>' . LF;

			// remove extjs from JScodeLibArray
		unset(
			$this->jsFiles[$this->backPath . $this->extJsPath . 'ext-all.js'],
			$this->jsFiles[$this->backPath . $this->extJsPath . 'ext-all-debug.js']
		);

		$inlineSettings = $this->inlineLanguageLabels ? 'TYPO3.lang = ' . json_encode($this->inlineLanguageLabels) . ';' : '';
		$inlineSettings .= $this->inlineSettings ? 'TYPO3.settings = ' . json_encode($this->inlineSettings) . ';' : '';

		if ($this->addExtCore || $this->addExtJS) {
				// set clear.gif, move it on top, add handler code
			$code = '';
			if (count($this->extOnReadyCode)) {
				foreach ($this->extOnReadyCode as $block) {
					$code .= $block;
				}
			}
//			$code = preg_replace("/(\n|\r|\t)/", NULL, $code);

			$out .= $this->inlineJavascriptWrap[0] . '
				Ext.ns("TYPO3");
				Ext.BLANK_IMAGE_URL = "' . htmlspecialchars(t3lib_div::locationHeaderUrl($this->backPath . 'gfx/clear.gif')) . '";' . LF .
					$inlineSettings .
					'Ext.onReady(function() {' .
					($this->enableExtJSQuickTips ? 'Ext.QuickTips.init();' . LF : '') . $code .
					' });' . $this->inlineJavascriptWrap[1];
			unset ($this->extOnReadyCode);

			$this->addCssFile($this->backPath . $this->extJsPath . 'resources/css/ext-all-gray.css', 'stylesheet', 'all', '', TRUE, TRUE);
			if ($this->extJScss) {
				if (isset($GLOBALS['TBE_STYLES']['extJS']['all'])) {
					$this->addCssFile($this->backPath . $GLOBALS['TBE_STYLES']['extJS']['all'], 'stylesheet', 'all', '', TRUE, TRUE);
				} else {
					$this->addCssFile($this->backPath . $this->extJsPath . 'resources/css/ext-all.css', 'stylesheet', 'all', '', TRUE, TRUE);
				}
			}
		} else {
			if ($inlineSettings) {
				$out .= $this->inlineJavascriptWrap[0] . $inlineSettings . $this->inlineJavascriptWrap[1];
			}
		}

		return $out;
	}

}

?>