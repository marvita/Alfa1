<?php 
if (!isset($result["error"])) {
	// everything ok, add the image tag
	$result["imagetag"] = $this->ImageCache->resizeImage($result["filePath"] . "/" . $result["filename"], array("maxWidth" => "175", "maxHeight" => "135", "cropZoom" => true));
}
echo json_encode($result); ?>
