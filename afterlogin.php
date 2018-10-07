<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

//starting session, loggeduser is the user of interest
session_start();
$loggeduser = $_SESSION['loggeduser'];

if( !preg_match('/^[\w_\-]+$/', $loggeduser) ){
		echo "Invalid username";
		exit;
	}
$dirpath = sprintf("/srv/uploads/%s",$loggeduser);
$files = array_diff(scandir($dirpath), array('.', '..')); //Source: https://stackoverflow.com/questions/15774669/list-all-files-in-one-directory-php

//if submit button was pressed, check validity of filename and then move file to srv/uploads
if($_POST['submit']){
     $name = basename($_FILES['file']['name']);
     //For moving the file
     $tmp = $_FILES['file']['tmp_name'];
     $type = $_FILES['file']['type'];
     $size = $_FILES['file']['size'];
     
    if( !preg_match('/^[\w_\.\-]+$/', $name) ){
		echo "Invalid filename";
		exit;
	}
	
	$full_path = sprintf("/srv/uploads/%s/%s", $loggeduser, $name);

	if( move_uploaded_file($_FILES['file']['tmp_name'], $full_path) ){
		echo "Successfully uploaded File";
		exit;
	}else{
		echo "failure";
		exit;
	}
	 
	         
}
?>
