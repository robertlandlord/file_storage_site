<?php
session_start();

$filearr = $_SESSION['mainfile'];
foreach($_POST['id'] as $key => $value);

$filename = (string)$filearr[$key];

//checking file validity
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

//dont have to check username because its check at creation
$username = (string)$_SESSION['loggeduser'];

$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);

// getting MIME type with finfo
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);

// displaying info with mim
header("Content-Type: ".$mime);
readfile($full_path);

?>