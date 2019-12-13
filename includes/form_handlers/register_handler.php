<?php

$fname = "";
$lname = "";
$em = "";
$em2= "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button']))

{
    //Registration form values
    //Fname
    $fname = strip_tags($_POST['reg_fname']); //take away strip tags incase an user submits html , basic security measure
    $fname = str_replace('','',$fname); //remove spaces
    $fname = ucfirst(strtolower($fname)); //lower case everything and uppercase the first one 
    $_SESSION['reg_fname'] = $fname; //stores first name into session variable
     //Lname
      $lname = strip_tags($_POST['reg_lname']); //take away strip tags incase an user submits html , basic security measure
      $lname = str_replace('','',$lname); //remove spaces
      $lname = ucfirst(strtolower($lname)); //lower case everything and uppercase the first one 
      $_SESSION['reg_lname']= $lname; //Stores last name into session variable
  
      //email
      $em = strip_tags($_POST['reg_email']); //take away strip tags incase an user submits html , basic security measure
      $em = str_replace('','',$em); //remove spaces
      $em = ucfirst(strtolower($em)); //lower case everything and uppercase the first one 
      $_SESSION['reg_email']= $em; //Stores email into session variable

  
     //email 2
      
       $em2 = strip_tags($_POST['reg_email2']); //take away strip tags incase an user submits html , basic security measure
       $em2 = str_replace('','',$em2); //remove spaces
       $em2 = ucfirst(strtolower($em2)); //lower case everything and uppercase the first one 
       $_SESSION['reg_email2']= $em2; //Stores email2 into session variable

        //password
        $password = strip_tags($_POST['reg_password']); //take away strip tags incase an user submits html , basic security measure
       $password2 = strip_tags($_POST['reg_password2']); //take away strip tags incase an user submits html , basic security measure
        
        $date =  date("Y-m-d");// Gets the current date
        if($em == $em2){
                if(filter_var($em,FILTER_VALIDATE_EMAIL)){
                    $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                    //check if email already exists
                    $e_check = mysqli_query ($con, "SELECT email FROM users WHERE email = '$em'");
                   
                    //Count the number of rows returned
                    $num_rows = mysqli_num_rows($e_check);

                    if($num_rows > 0 ){
                        array_push($error_array,"Email already in use <br>");
                      
                    }

                }
                else{
                    array_push($error_array,"Invalid email format <br>");
                    
                }
        }
        else{
            array_push($error_array,"Emails do not match <br>");
         
        }

    if(strlen($fname)> 25 || strlen($fname)<2){
        
        array_push($error_array,"Your first name must be between 2 and 25 characters <br>");
    }

    if(strlen($lname) >25 || strlen($lname)<2){
        array_push($error_array,"Your last name must be between 2 and 25 characters <br>");
        

    }
    if($password != $password2){
        array_push($error_array," Your passswords do not match<br>");
        
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/',$password)){
            array_push($error_array,"Your password can only contain english characters or numbers<br>");
            
        }

    }
    if(strlen($password >30) || strlen($password) < 5){
        array_push($error_array,"Your password must be between 5 and 30 characters<br>");
       
    }

    if(empty($error_array)){
        $password = md5($password);//encrypt password before sending it to database

        $username = strtolower($fname."_".$lname); //Generate usernam by concatenating first name and last name
        $check_username_query= mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

        $i = 0;
        //if username exists add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++; //Add 1 to i
            $username = $username."_".$i;
            $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username = '$username'");
        }
    
    //profile picture assignment
    $rand = rand(1,2); //Random number  between 1 and 2

    if($rand == 1)
           $profile_pic = "assets/images/profile_pics/defaults/user_black.png";
    else if ($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/user_blue.png";

    $query = mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

    array_push($error_array, "<span style='color:#14c800;'> You're all set ! Go ahead and login!</span><br>");

    //Clear session variables
    $_SESSION['reg_fname'] = "";
    $_SESSION['reg_lname'] = "";
    $_SESSION['reg_email'] = "";
    $_SESSION['reg_email2'] = "";
    }



}
?>