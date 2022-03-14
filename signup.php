<?php 

    include("classes/connect.php");
    include("classes/signup.php");

    $first_name = "";
    $last_name = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        $signup = new Signup();
        $result = $signup->evaluate($_POST);
        
        if($result != "")
        {

            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $result;
            echo "</div>";
        }else
        {

            header("Location: login.php");
            die;
        }
 

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];

    }  

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mysocial | Signup</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <header>
        <div class="logo-text">Mysocial</div>
        <a href="login.php">
            <div class="login-btn">Log in</div>
        </a>
    </header>

    <div class="signup-area">

        Sign up to Mysocial<br><br>

        <form method="post" action="">

            <input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>

            <input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>

            <span style="font-weight: normal;">Gender:</span><br>
            <select id="text" name="gender">
                <option><?php echo $gender ?></option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <br><br>

            <input value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
            
            <input name="password" type="password" id="text" placeholder="Password"><br><br>
            <input name="password2" type="password" id="text" placeholder="Retype Password"><br><br>

            <input type="submit" id="signup-button" value="Sign up">
            <br><br><br>
        </form>
    </div>

</body>
</html>
        