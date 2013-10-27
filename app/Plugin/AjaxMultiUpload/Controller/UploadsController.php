<?php
/**
 *
 * Dual-licensed under the GNU GPL v3 and the MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Suman (srs81 @ GitHub)
 * @package       plugin
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *                and/or GNU GPL v3 (http://www.gnu.org/copyleft/gpl.html)
 */
 
class UploadsController extends AjaxMultiUploadAppController {

	public $name = "Upload";
	public $uses = null;
	
	public $helpers = array("ImageCache");
	
	// list of valid extensions, ex. array("jpeg", "xml", "bmp")
	var $allowedExtensions = array();

	function upload($dir=null) {
       	require_once (ROOT . DS . APP_DIR . "/Plugin/AjaxMultiUpload/Config/bootstrap.php");
		// max file size in bytes
		$size = Configure::read ('AMU.filesizeMB');
		if (strlen($size) < 1) $size = 4;
		$relPath = Configure::read ('AMU.directory');
		if (strlen($relPath) < 1) $relPath = "files";

		$sizeLimit = $size * 1024 * 1024;
                $this->layout = "json";
	        Configure::write('debug', 0);
		$directory = WWW_ROOT . DS . $relPath;
 
		if ($dir === null) {
			$this->set("result", "{\"error\":\"Upload controller was passed a null value.\"}");
			return;
		}
		// Replace underscores delimiter with slash
		$objDir = str_replace ("___", "/", $dir);
		$dir = $directory . DS . "$objDir/";
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		$uploader = new qqFileUploader($this->allowedExtensions, 
			$sizeLimit);
		$result = $uploader->handleUpload($dir);
		$result["filePath"] = $relPath . "/" . $objDir;
		$this->set("result", $result);
	}

	/**
	 *
	 * delete a file
	 *
	 * Thanks to traedamatic @ github
	 */
	public function delete($file = null) {
		if(is_null($file)) {
			$this->Session->setFlash(__('File parameter is missing'));
			$this->redirect($this->referer());
		}
		$file = base64_decode($file);
		if(file_exists($file)) {
			if(unlink($file)) {
				$this->Session->setFlash(__('File deleted!'));				
			} else {
				$this->Session->setFlash(__('Unable to delete File'));					
			}
		} else {
			$this->Session->setFlash(__('File does not exist!'));					
		}
		
		$this->redirect($this->referer());	
	}
}

?>