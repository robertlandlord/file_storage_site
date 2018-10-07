<?php
$usersfile = fopen("/srv/users.txt","r+") or die("Unable to find users file!");
$givenuser = (string)$_POST['deletuser'];
$foundornot = false;
//expanding users.txt and finding the user
$user_array = explode("\n", fread($usersfile, filesize("/srv/users.txt")));
foreach($user_array as $user) {
    $user = rtrim($user, "\r\n");
    if ($user == $givenuser){
        $foundornot = true;
    }
}

//rewriting the users.txt file without the deleted user
if (!$foundornot) echo "User was not found!";
else {
    $writefile = fopen("/srv/users.txt","w") or die("Unable to find users file!");
    foreach ($user_array as $user) {
        if ($user != $givenuser) fwrite($writefile,"$user\n");
    }
    if (file_exists("/srv/uploads/".$givenuser)) rmdir("/srv/uploads/".$givenuser);
    echo "User succesfully deleted!";
    fclose($writefile);
}
fclose($usersfile);
?>