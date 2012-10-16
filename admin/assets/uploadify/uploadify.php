<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/


// Define a destination
$targetFolder = '/projects/belmar/admin/modules/gallery'; // Relative to the root


if (!empty($_FILES)) {
	$tempFile = $_FILES['image']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . "watermark.png";

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['image']['name']);

	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
        echo $targetFile;
	} else {
		echo 'Invalid file type.';
	}
//}
//if (!empty($_FILES)) {
//    print_r($_FILES);
//	$tempFile = $_FILES['Filedata']['tmp_name'];
//	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
//	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
//
//	// Validate the file type
//	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
//	$fileParts = pathinfo($_FILES['Filedata']['name']);
//
//	if (in_array($fileParts['extension'],$fileTypes)) {
//		move_uploaded_file($tempFile,$targetFile);
//		echo '1';
//	} else {
//		echo 'Invalid file type.';
//	}
}