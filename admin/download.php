<?PHP
// Define the path to file



if(isset($_GET['file']) && $_GET['file']!="" && file_exists($_GET['file']))
 {   $file = $_GET['file'];


	// Set headers
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=$file");
	header("Content-length: ".(string)(filesize($file)));
	header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	// Read the file from disk
	readfile($file);
}
else
{
die('file not found');
}
?>
