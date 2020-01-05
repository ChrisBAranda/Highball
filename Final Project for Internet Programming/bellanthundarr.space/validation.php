<?php

session_start();
//Connect to databse
$conn = mysqli_connect('localhost', 'webapps', 'DankMemes19');
//Select from the database
mysqli_select_db($conn, 'caranda_helloworld');
//Declaration and initialization of username and password variables.
$name = $_POST['user'];
$pass = $_POST['password'];

//Selects from the usertable
$s = "SELECT * FROM usertable WHERE name = '$name' && password = '$pass';";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

//If the user exist in the usertable it bring the user into the todo list.
//Otherwise, it redirect the user to the login page.
if ($num == 1) {
    $_SESSION['username'] = $name;
    header('location:home.php');
} else {
    header('location:index.php');
}
?> 

