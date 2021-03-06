<?php

class User{
    private $user;
    private $con;

    public function __construct($con,$user){
        $this->con = $con;
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username= '$user'");
        $this->user = mysqli_fetch_array($user_details_query); //this will assign an array of all the user rows - so each row will
        //have users = username age and etc etc to retrieve user['username']
        //

    }
    public function getUsername(){
        return $this ->user['username'];
    }

    public function getNumPosts(){
        $username= $this ->user['username']; //you get the username assigned 
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'"); //then you pick 'num_posts' where username 
        $row = mysqli_fetch_array($query); ///fetch array and assign it to $row variable
        return $row['num_posts']; //so here we say row['num_posts'] to specifically pick the no of posts of the username 

    }
    public function getFirstAndLastName(){
        $username = $this-> user['username'];
        $query =mysqli_query($this->con,"SELECT first_name, last_name FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'].' '.$row['last_name']; //refer to getNumPosts() - same application to firstAndLast names
    }

    public function getProfilePic(){

        $username = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT profile_pic FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];
        
    }


    public function getFriendArray(){

        $username = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT friend_array FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['friend_array'];
        
    } 

    Public function isClosed(){

        $username = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT user_closed FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query); // //Same application to firstandlastname

        if($row['user_closed'] =='yes')	
            return true;
        else
            return false;
    }


    public function isFriend($username_to_check){
        $usernameComma = ",".$username_to_check.",";
        if(strstr($this->user['friend_array'],$usernameComma) || $username_to_check == $this->user['username'])
        //this->user['friend_array'] will give something like ',fried1,john,...' so we check if usernameComma is still 
        //in and OR we check username_to_check is equal to this users username  
        {
            return true;
        }
        else{
            return false;
        }



    }



    public function didReceiveRequest($user_from){
        $user_to = $this->user['username'];
    //    echo "user_from printed as ".$user_from;
        $check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if(mysqli_num_rows($check_request_query)>0){
            return true;
        }
        else{
            return false;
        }

    }

    public function didSendRequest($user_to){
        $user_from = $this->user['username'];
        //echo "user_to printed as ".$user_to;
        $check_request_query = mysqli_query($this->con,"SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_from'");
        if(mysqli_num_rows($check_request_query)>0){
            return true;
        }
        else{
            return false;
        }

    }


    public function removeFriend($user_to_remove){
        $logged_in_user = $this->user['username'];
        $query = mysqli_query($this->con,"SELECT friend_array FROM users WHERE username='$user_to_remove'");
        $row = mysqli_fetch_array($query);
        $friend_array_username = $row['friend_array'];

        $new_friend_array = str_replace($user_to_remove.",", "",$this->user['friend_array']);
        $remove_friend =  mysqli_query($this->con,"UPDATE users SET friend_array='$new_friend_array' WHERE username = '$logged_in_user'");
     
        
        $new_friend_array = str_replace($this->user['username'].",", "",$friend_array_username);
        $remove_friend =  mysqli_query($this->con,"UPDATE users SET friend_array='$new_friend_array' WHERE username = '$user_to_remove'");
        
    
    }

    public function sendRequest($user_to){
           
        $user_from = $this->user['username'];
        $query = mysqli_query($this->con,"INSERT INTO friend_requests VALUES('','$user_to','$user_from')");


    }

    // public function getFirstAndLastName2(){
    //    // $username = $this-> user['username'];
    //     //$query =mysqli_query($this->con,"SELECT first_name, last_name FROM users WHERE username = '$username'");
    //    // $row = mysqli_fetch_array($query);
    //     return $this-> user['first_name'].' '.$this->user['last_name'];
    // }


}

?>