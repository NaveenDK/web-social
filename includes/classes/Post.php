<?php

class Post{
    private $user_obj;
    private $con;

    public function __construct($con,$user){
        $this->con = $con;
        $this->user_obj = new User($con,$user);
    }

    public function submitPost($body,$user_to){
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con,$body);
        
        $body = str_replace('\r\n', '\n', $body);
        $body = nl2br($body);

        
        $check_empty = preg_replace('/\s+/','',$body); //Delete all spaces



        if($check_empty =! 0){
            //current data and time
            $date_added = date("Y-m-d H-i-s");
            //Get username
            $added_by = $this->user_obj->getUsername();


            //If user is on own profie, user_to is 'none'
            if($user_to = $added_by){
                $user_to = "none";
            }
            //insert post
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES ('','$body','$added_by','$user_to','$date_added','no','no','0')");
//someting for later
            $returned_id = mysqli_insert_id($this-> con);
//Update post-count for the user
             $num_posts = $this->user_obj->getNumPosts();   
             $num_posts ++;
             $update_query = mysqli_query($this->con,"UPDATE users SET num_posts = '$num_posts' WHERE username='$added_by'");


        }



    }



}

?>