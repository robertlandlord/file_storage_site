<?php
$usersfile = fopen("/srv/users.txt","r") or die("Unable to find users file!");
$givenuser = (string)$_POST['username'];
if( !preg_match('/^[\w_\-]+$/', $givenuser) ){
		echo "Invalid username";
		exit;
	}
//checking if user was in users.txt
$foundornot = false;
$approveduser = '';
while(! feof($usersfile)){
    $user = rtrim(fgets($usersfile), "\r\n");
    if($givenuser == $user){
        $foundornot = true;
        $approveduser = $givenuser;
    }
}
//if user was found, then go to the new post login page
if($foundornot){
    session_start();
    $_SESSION['loggeduser'] = $approveduser;
    header("Location: http://ec2-13-59-77-129.us-east-2.compute.amazonaws.com/~robertlandlord/postloginmain.php");
    die();
    session_close();
}
else{
    echo "User not found, please try again.";
}
fclose($usersfile);
?>