
<div id="friends">

    <?php

        $image = "images/user_male.jpg";

        if ($FRIENDS_ROW['gender'] == "Female")
        {
            // code...
            $image = "images/user_female.jpg";
        }

    ?>

    <img src="<?php echo $image ?>" alt="" id="friends-img">
    <br>
    <?php echo $FRIENDS_ROW['first_name'] . " " . $FRIENDS_ROW['last_name'] ?>
</div>