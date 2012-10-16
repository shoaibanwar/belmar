<?php 
	require "class.rwatermark.php";
	
	error_reporting(0);
	$handle = new RWatermark(FILE_JPEG, "original.jpg");
	
	$handle->SetPosition("ABS",0,0);
	$handle->SetTransparentColor(255, 0, 255);
	$handle->SetTransparency(80);
	$handle->AddWatermark(FILE_PNG, "watermark.png");
	
	Header("Content-type: image/png");
	$handle->GetMarkedImage(IMG_PNG);
	$handle->Destroy();
?>
