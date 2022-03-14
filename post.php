
<div id="posts">
    <div>
        <?php

            $image = "images/user_male.jpg";

            if ($ROW_USER['gender']  == "Female")
            {
                // code...
                $image = "images/user_female.jpg";
            }
        ?>
        <img src="<?php echo $image ?>" alt="" width="75px" style="margin-right: 4px;">
    </div>
    <div>
        <div style="font-weight: bold; color: #405d9b;">

            <?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name']; ?>
            
        </div>

        <?php echo $ROW['post'] ?>

    <br><br>
    
    <a href="#">Like</a> . <a href="">Comment</a>.
    <span style="color: #999;">

        <?php echo $ROW['date'] ?>

    </span> 

    </div>
</div>