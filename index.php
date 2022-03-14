<?php

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['mysocial_userid']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline | MySocial</title>
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

            <!--Friends area-->
            <div style="min-height: 400px; flex:1;">
                <div class="friends-bar" style="white;min-height: 400px;margin-top: 20px;color: #405d9b;padding: 8px;text-align: center;font-size: 20px;">
                    <img src="images/selfie.jpg" style="width: 150px; border-radius: 50%; border: solid 2px white;"><br>
                    <a href="profile.php" style="text-decoration: none;">
                        
                        <?php echo $user_data['first_name'] . "<br> " . $user_data['last_name'] ?>

                    </a>

                </div>

            </div><!--end of friends area-->

            <!--posts area-->
            <div style="min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;" >

                <div id="post-text-area">

                    <form method="post">
                        <textarea name="post" placeholder="What's on your mind?"></textarea>
                        <input type="submit" name="" value="post" id="post-button">
                    </form>
                    <br>
                </div>

                <!--start of the html of posts feed-->
                <div id="posts-bar">

                    <!--posts feeds  content starts here-->

                    <?php

                        if ($posts)
                        {
                            // code...
                            foreach ($posts as $ROW)
                            {
                                // code...
                                $user =  new User();
                                $ROW_USER = $user->get_user($ROW['userid']);

                                include("post.php");
                            
                            }

                        }

                    ?>                  

                </div>
            </div>

        </div>
        
    </div>


</body>
</html>