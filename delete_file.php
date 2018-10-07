<?php
    session_start();
    $filearr = $_SESSION['mainfile'];
    foreach($_POST['del'] as $key => $value);
    //needed to know which file was deleted, since buttons were dynamically created
    $filename = $filearr[$key];
    //check validity of files
    if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }
    
    $username = (string)$_SESSION['loggeduser'];
    //just checking validity of username
    if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo "Invalid username";
        exit;
    }
    //destroy file
    $full_path = sprintf("/srv/uploads/%s/%s", $username, $filename);
    unlink($full_path);
    echo "Say goodbye to your precious ". $filename;
?>
