<?php

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['mysocial_userid']);

    //image upload starts here
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {

            if ($_FILES['file']['type'] == "image/jpeg")
            {
                $allowed_size = (1024 * 1024) * 7;
                if ($_FILES['file']['size'] < $allowed_size)
                {
                    //Everything is fine!
                    $filename = "uploads/" . $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    $image = new Image();
                    $image->crop_image($filename,$filename,800,800);

                    if (file_exists($filename))
                    {
                        
                        $userid = $user_data['userid'];
                        $query = "UPDATE users SET profile_image = '$filename' WHERE userid = '$userid' LIMIT 1";
                        $DB = new Database();
                        $DB->save($query);

                        header("Location: profile.php");
                        die();
                    }

                }else
                {
                    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                    echo "<br>The following errors occured:<br><br>";
                    echo "Only photos of size 3mb or lower are allowed!";
                    echo "</div>";
                }

            }else
            {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                echo "<br>The following errors occured:<br><br>";
                echo "Only photos of Jpeg type are allowed!";
                echo "</div>";

            }

        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "Please upload a valid image!";
            echo "</div>";
        } 
    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Image | MySocial</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="profile-body">
    <br>
    <!--The profile header starts here-->
    <?php 

        include("header.php");
        
    ?>

    <!--The profile cover area starts here-->
    <div class="profile-cover-area">
        
        <!--Below the cover area-->
        
        <div style="display: flex;">

           
        <!--posts area-->
            <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;" >

                <form method="post" enctype="multipart/form-data">
                    <div id="post-text-area">

                        <input type="file" name="file">
                        <input style="width: 100px;" type="submit" name="" value="change" id="post-button">
                        <br>

                    </div>
                </form>

            </div>

        </div>
        
    </div>


</body>
</html>