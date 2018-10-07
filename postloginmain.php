<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>File upload</title>
        <link rel="stylesheet" href="uploadtestmainstyles.css">
    </head>
    <body>
        <p>
            <h3>Uploaded files:</h3>
            <!--showing all files that user had while also making dynamically created buttons(view/delete) for each-->
           <?php
                session_start();
                $loggeduser = $_SESSION['loggeduser'];
                $full_path = "/srv/uploads/" . $loggeduser;
                if(count(glob($full_path."/*"))==0) echo "No Files!";
                else{
                    $file_array = array();
                    $counter = 0;
                    foreach(array_filter(glob($full_path.'/*'), 'is_file') as $file){
                        $filearr=explode("/", $file);
                        $file_name = $filearr[count($filearr)-1];
                        array_push($file_array,$file_name);
                        $_SESSION['mainfile']=$file_array;
                        echo $file_name . "<form action='view_file.php' method='post'> <input type='submit' name='id[$counter]' value='View File'> </form>";
                        echo "<form action='delete_file.php' method='post'> <input type='submit' name='del[$counter]' value='delet this'> </form>";
                        $counter = $counter +1;
                    } 
                }
            ?> 
            
        </p>
        <form action="afterlogin.php" method="post" enctype="multipart/form-data">
            File: <input type="file" name="file">
            <input type="submit" name = "submit" value = "Upload">       
        </form>
        <br>
        <form action="logout.php">
            <input type="submit" name="logout" value="Log Out">
        </form>
    </body>
</html>
    
