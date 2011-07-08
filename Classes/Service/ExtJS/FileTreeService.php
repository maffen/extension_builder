<?php

class Tx_ExtensionBuilder_Service_ExtJS_FileTreeService {

	/**
	 * @var array
	 */
	protected $excludeFolders = array();

	/**
	 * @var array
	 */
	protected $files = array();

	/**
	 * @throws Tx_ExtensionBuilder_Exception
	 * @return array
	 */
	public function getFiles($rootFolder) {

		if (!is_dir($rootFolder)) {
			throw new Tx_ExtensionBuilder_Exception('Extension folder does not exist', t3lib_div::SYSLOG_SEVERITY_FATAL);
		}

		$this->files = $this->getAllFilesAndFoldersInPath($rootFolder, $extList = '', $recursivityLevels = 99, '.git');
		//debug($this->files,'Recursive');
		/**
		if (!empty($this->excludeFolders)) {
			$excludeFolders = array();
			foreach ($this->excludeFolders as $excludeFolder) {
				$excludeFolders[] = str_replace('/', '\/', $excludeFolder);
			}
			$excludePattern = '/^(' . implode('|', $excludeFolders) . ')/';

			foreach ($this->files as $index => $file) {
				if (preg_match($excludePattern, $file)) {
					unset($this->files[$index]);
				}
			}
		}
		*/
		return $this->files;
	}
	
	protected function getAllFilesAndFoldersInPath($path, $extList = '', $recursivityLevels = 99, $excludePattern = '') {
		$fileArr = array();
		
		$dirs = t3lib_div::get_dirs($path);
		//debug(json_encode($dirs),'children');
		if (is_array($dirs) && $recursivityLevels > 0) {
			foreach ($dirs as $subdir) {
				if ((string) $subdir != '' && (!strlen($excludePattern) || !preg_match('/^' . $excludePattern . '$/', $subdir))) {
					$children = $this->getAllFilesAndFoldersInPath($path . '/' . $subdir . '/', $extList, $recursivityLevels - 1, $excludePattern);
					$fileArr[] = array('text'=>$subdir,'expanded' => FALSE, 'children' => $children);
				}
			}
		}
		$filesInPath = t3lib_div::getFilesInDir($path, $extList, 0, 1, $excludePattern);
		foreach($filesInPath as $f){
			$fileArr[] = array('text'=>$f,'leaf' =>TRUE);
		}
		//debug(json_encode($fileArr),$path);
		return $fileArr;
	}
}

?>