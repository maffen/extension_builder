<?php

class Tx_ExtensionBuilder_ViewHelpers_Be_ResourceIncludeViewHelper extends Tx_ExtensionBuilder_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * @param string $file
	 * @param string $directory
	 * @param string $pattern
	 * @param bool $recursive
	 * @param string $type
	 * @param boolean $compress
	 * @param boolean $forceOnTop
	 * @param string $allWrap
	 * @return void
	 */
	public function render($file = NULL, $directory = NULL, $pattern = NULL, $recursive = TRUE, $type = 'JavaScript', $compress = TRUE, $forceOnTop = FALSE, $allWrap = NULL) {
		if ($type !== 'JavaScript' && $type !== 'CSS') {
			return;
		}

		$path = t3lib_extMgm::extPath($this->controllerContext->getRequest()->getControllerExtensionKey());
		$path .= 'Resources/Public/';

		if (!empty($file)) {
			if (is_file($path . $file)) {
				$file = $this->mainDirBackpath . str_replace(PATH_site, NULL, $path) . $file;
				if ($type === 'JavaScript') {
					$this->pageRenderer->addJsFile($file, 'text/javascript', $compress, $forceOnTop, $allWrap);
				} elseif ($type === 'CSS') {
					$this->pageRenderer->addCssFile($file, 'stylesheet', 'all', '', $compress, $forceOnTop, $allWrap);
				}
			}
		} elseif (!empty($directory)) {
			$files = array();
			$path .= $directory;

			if (t3lib_div::isAbsPath($path)) {
				$files = t3lib_div::getAllFilesAndFoldersInPath($files, $path, NULL, FALSE, $recursive === TRUE ? 99 : 0);
				foreach ($files as $index => $file) {
					if (preg_match($pattern, basename($file))) {
						$file = $this->mainDirBackpath . str_replace(PATH_site, NULL, $file);
						if ($type === 'JavaScript') {
							$this->pageRenderer->addJsFile($file, 'text/javascript', $compress, $forceOnTop, $allWrap);
						} elseif ($type === 'CSS') {
							$this->pageRenderer->addCssFile($file, 'stylesheet', 'all', '', $compress, $forceOnTop, $allWrap);
						}
					}
				}
			}
		}
	}

}

?>