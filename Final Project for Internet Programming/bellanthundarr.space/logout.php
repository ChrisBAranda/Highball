<?php
//Starts and destroy session and redirects the user to the login page if 
//the LOGOUT button is pressed.
session_start();
session_destroy();

header('location:index.php');

?>