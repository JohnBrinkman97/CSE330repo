<?php
session_start();
$username = $_SESSION["username"];
// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid

if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);

chmod($full_path,777);
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: upload_success.php");
	exit;
}else{
	header("Location: upload_failure.php");
	exit;
	
}

?>