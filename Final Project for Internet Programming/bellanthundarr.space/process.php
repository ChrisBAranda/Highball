<?php

session_start();

//Connection to database
$mysqli = new mysqli('localhost', 'webapps', 'DankMemes19', 'caranda_helloworld') or die(mysqli_error($mysqli));

//Declaration and initialization of starting variables
$id = 0;
$update = false;
$task = "";
$date = "";
$description = "";


//Adds and saves the record when the save button is pressed.
if (isset($_POST['save'])) {
    
    //Converts the user input to a string
    //To prevent SQL injection attacks
    //NOTE: Added due to syntax errors with sql.
    $task = $mysqli -> real_escape_string($_POST['task']);
    $date = $mysqli -> real_escape_string($_POST['date']);
    $description = $mysqli -> real_escape_string($_POST['description']);
    
    //Checks to see if the form is empty or if not all fields are filled in.
    //If it is, then it brings up and error message.
    if (empty($task) || empty($date) || empty($description)) {
        $_SESSION['message'] = "Fill in all fields!";
        $_SESSION['msg_type'] = "danger";
        header("location: home.php");
    } else {
        //Otherwise insert user input into the tasklist table.
        $mysqli->query("INSERT INTO tasklist (task, date, description) VALUES ('$task', '$date', '$description')") or die($mysqli->error);

        //Success prompt
        $_SESSION['message'] = "Task has been added!";
        $_SESSION['msg_type'] = "success";
        //Brings user back to homepage.
        header("location: home.php");
    }
}

//Deletes a record if the DELETE button for a task is pressed.
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    //Removes the task fromt he tasklist. Otherwise, bring up an error message
    $mysqli->query("DELETE FROM tasklist WHERE id=$id") or die($mysqli->error);
    
    //Message prompt for the deletion of task
    $_SESSION['message'] = "Task has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: home.php");
}

//Edits the selected record when the EDIT button is pressed.
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    //Changes update variable to true. Leaving the task open for updating.
    $update = true;
    $result = $mysqli->query("SELECT * FROM tasklist WHERE id=$id") or die($mysqli->error);
    //If the task is availiable, fetch the data for that list in the table.
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $task = $row['task'];
        $date = $row['date'];
        $description = $row['description'];
    }
}

//Update the record when the update button has ben pressed.
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    //Conversion of user input to string variables.
    $task = $mysqli -> real_escape_string($_POST['task']);
    $date = $mysqli -> real_escape_string($_POST['date']);
    $description = $mysqli -> real_escape_string($_POST['description']);
    //Updates the task in the tasklist. Otherwise, prompt up an error message.
    $mysqli->query("UPDATE tasklist SET task='$task', date='$date', description='$description'  WHERE id=$id") or die($mysqli->error);

    //Success message if the task has been updated
    $_SESSION['message'] = "Task has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header('location: home.php');
}
