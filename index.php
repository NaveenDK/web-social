<?php
include("includes/header.php");
?>
    <div class="user_details column">
    <a href="">  <img width="80"src="<?php echo $user['profile_pic']; ?>"/> </a>

    <div class="user_details_left_right">
     <a href=""> <?php echo $user['first_name']." ".$user['last_name']; ?> </a> <br>
     <?php echo "Posts: ".$user['num_posts']."<br>";
        echo "Likes: ".$user['num_likes'];
     ?>   
    </div>
    </div> <!-- closes the div tag that is opened with the class user_details column -->
<div class="main_column column">
    <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
    </form>

</div>


</div> <!--closes the div tag opened in the wrapper at the header.php tag -->
</body>
</html>