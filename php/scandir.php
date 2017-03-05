<?php 

/*  goal:
1. list files and directory inside the images directory
2. convert php array into json array 
3. redirect upload.php to wardrobe.html */
header("Content-Type: application/json");

$directory = '../img/uploaded';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));


echo json_encode($scanned_directory);

$myfile = fopen("../js/uploadedimgarray.json", "w") or die("Unable to open file!");
$txt = json_encode($scanned_directory);
fwrite($myfile, $txt);
fclose($myfile);



?>