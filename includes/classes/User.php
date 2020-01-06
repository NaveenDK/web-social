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

    // public function getFirstAndLastName2(){
    //    // $username = $this-> user['username'];
    //     //$query =mysqli_query($this->con,"SELECT first_name, last_name FROM users WHERE username = '$username'");
    //    // $row = mysqli_fetch_array($query);
    //     return $this-> user['first_name'].' '.$this->user['last_name'];
    // }


}

?>