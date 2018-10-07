<?php
$usersfile = fopen("/srv/users.txt","r+") or die("Unable to find users file!");
$givenuser = (string)$_POST['newuser'];
if( !preg_match('/^[\w_\-]+$/', $givenuser) ){
		echo "Invalid username";
		exit;
	}
$foundornot = false;

//trying to see if user already exists
while(! feof($usersfile)){
    $user = rtrim(fgets($usersfile), "\r\n");
    if($givenuser == $user){
        $foundornot = true;
    }
}
//making user if it was not found already
if ($foundornot) echo "User already exists!";
else {
    $writefile = fopen("/srv/users.txt","a+") or die("Unable to find users file!");
    fwrite($writefile,"$givenuser\n"); 
    if (!file_exists("/srv/uploads/".$givenuser)) mkdir("/srv/uploads/".$givenuser, 777, true);
    chmod("/srv/uploads/".$givenuser, 0777);
    echo "User succesfully added!";
    fclose($writefile);
}
fclose($usersfile);
?>