<?php

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['mysocial_userid']);

    //posting starts here
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // code...
        $post = new Post();
        $id = $_SESSION['mysocial_userid'];
        $result = $post->create_post($id, $_POST);

        if ($result == "")
        {
            // code...
            header("Location: profile.php");
            die();
        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
            echo "</div>";

        }
    }

    //Retrieve posts from the database
    $post = new Post();
    $id = $_SESSION['mysocial_userid'];
    
    $posts = $post->get_posts($id);

    //Retrieve friends
    $user = new User();
    $id = $_SESSION['mysocial_userid'];
    
    $friends = $user->get_friends($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | MySocial</title>
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
        <div class="cover-image-box">

            <img src="./images/mountain.jpg" alt="" id="cover-img">

            <span style="font-size: 12px;">

                <?php

                    $image = "";
                    if (file_exists($user_data['profile_image']))
                    {
                        $image = $user_data['profile_image'];
                    }
                ?>

                <img src="<?php echo $image ?>" alt="" id="profile-pic"><br>

                <a style="text-decoration-line: none; color: #f0f;" href="change_profile_image.php">Change Photo</a>
            </span>
            <br>

            <div style="font-size: 20px;"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?></div>
            
            <br>
            <a href="index.php"><div class="menu-button">Timeline</div></a>
            <div class="menu-button">About</div>
            <div class="menu-button">  Friends</div>
            <div class="menu-button">Photos</div>
            <div class="menu-button">Settings</div>
        </div><!--Below the cover area-->
        
        <div style="display: flex;">

            <!--Friends area-->
            <div style="min-height: 400px; flex:1;">
                <div id="friends-bar">
                    Friends<br>

                    <?php

                        if ($friends)
                        {
                            // code...
                            foreach ($friends as $FRIENDS_ROW)
                            {
                                // code...
                                
                                include("user.php");
                            
                            }

                        }

                    ?>  

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