<?php
if(isset($_POST['login_button'])){

    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);//make sure its in the right format
    $_SESSION['log_email'] = $email; //Store email into session variable
    $password  = md5($_POST['log_password']);//get password
    $check_database_query = mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);
    
    if($check_login_query==1 ){
        $row = mysqli_fetch_array($check_database_query);//store the results of a query as an array in the row variable
        $username = $row['username'];
        $_SESSION['username']= $username; // as long a
        header("Location: index.php");
        exit();
       // $email
    }
   else{
       array_push($error_array,"Email or password was incorrect<br>");
   }

}

?>