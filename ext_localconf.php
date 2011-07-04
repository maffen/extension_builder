<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

/** ExtDirect section **/
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ExtDirect']['TYPO3.ExtensionBuilder.ExtDirect'] =
		t3lib_extMgm::extPath('extension_builder') . 'Classes/ExtDirect/CoreProvider.php:Tx_ExtensionBuilder_ExtDirect_CoreProvider';
/** ExtDirect section **/

?>