<?php
$con = mysqli_connect("localhost","root","", "web-social");

if (mysqli_connect_errno()){
    echo "Failed to connect: ". mysqli_connect_errno();

}

$query = mysqli_query($con, "INSERT INTO test VALUES('','Naveen')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Feed</title>
</head>
<body>
Hello Naveen!
    
</body>
</html>