<?php
//destroying session, restarting stuff and heading back to home page
session_unset();
session_destroy();
header("Location: http://ec2-13-59-77-129.us-east-2.compute.amazonaws.com/~robertlandlord/uploadtestmain.html");
?>