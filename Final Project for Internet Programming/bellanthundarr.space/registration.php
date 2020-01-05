<?php

session_start();

header('location:index.php');
//Connects to the database
$conn = mysqli_connect('localhost', 'webapps', 'DankMemes19');

mysqli_select_db($conn, 'caranda_helloworld');

//Declaration and initialization of username and password variables.
$name = $_POST['user'];
$pass = $_POST['password'];

$s = "SELECT * FROM usertable WHERE name = '$name'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

//Statement to see if the username has already been taken.
if ($num == 1) {
    echo "Username Already Taken";
} else {
    $reg = "INSERT INTO usertable(name , password) values('$name' , '$pass')";
    mysqli_query($conn, $reg);
    echo "Registration Complete!";
}
?> 
