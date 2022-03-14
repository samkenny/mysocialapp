<?php 

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
 
    $email = "";
    $password = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $login = new Login();
        $result = $login->evaluate($_POST);
        
        if($result != "")
        {

            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
            echo "</div>";
            
        }else
        {

            header("Location: profile.php");
            die;
        }
 

        $email = $_POST['email'];
        $password = $_POST['password'];
        

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login | Mysocial</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
<body>
    <header>
        <div class="logo-text">Mysocial</div>
        <a href="signup.php">
            <div class="signup-btn">Signup</div>
        </a>
    </header>

    <div class="login-area">
        <form method="post">
            Log in to Mysocial<br><br>

            <input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"><br><br>
            <input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>

            <input type="submit" id="login-button" value="Log in">
            <br><br><br>
        </form>
    </div>
    
</body>
</html>