<?php
//Starts php session
session_start();
//Checks to see if the user has accessed the page appropriately. That is, logging in.
//Otherwise, it redirects the user to the login page.
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
?>

<html>
    <head>
        <title>To-Do List</title>
        <meta charset="utf-8">
        <!--Links to favicon, bootstrap and other styling sheets-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    </head>

    <!--Loads the Javascript function that displays the date and time-->
    <body onload="display_ct()">

        <!--Navigation bar-->
        <div class="page-header">
        </div>

        <!--Welcomes the user to the home page when logged in successfully.-->
        <nav class="navbar navbar-dark bg-primary">
            <span class="navbar-brand mb-0 h1">Welcome <?php echo $_SESSION['username']; ?>!</span>
            <button class="btn btn-dark navbar-btn">
                <a href="logout.php">LOGOUT</a>
            </button>

        </nav>
        <!--Displays the time and date.-->
        <h1>The date and time is:</h1>
        <h1 id='ct'></h1>

        <!--Table design-->

        <div class="container">


            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <!--Message prompt shown above the todo list-->
                        <!--Messages are given depending on what button was pressed and user input-->                        
                        <?php require_once 'process.php' ?>
                        <!--Displays message in a div element-->                        
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

                                <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php endif ?>

                        <div class="container">
                            <?php
                            //Connection to database and gatering information from the tasklist table.
                            $mysqli = new mysqli('localhost', 'webapps', 'DankMemes19', 'caranda_helloworld') or die(mysqli_error($mysqli));
                            $result = $mysqli->query("SELECT * FROM tasklist") or die($mysqli->error);
                            ?>


                            <?php

                            function pre_r($array) {
                                echo '<pre>';
                                print_r($array);
                                echo '</pre>';
                            }
                            ?>

                            <!--Form for user input. User inputs the following: Task name, due date, and description.-->                        
                            <div class="row justify-content-left">
                                <form action="process.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <label>Task</label>
                                        <input type="text" name="task" class="form-control" value="<?php echo $task; ?>" placeholder="Task">
                                    </div>
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input type="text" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Due Date">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control" value="<?php echo $description; ?>" placeholder="Description">
                                    </div>
                                    <div class="form-group">
                                        <!--The button is updated if the user decides to edit a task by pressing the edit button.-->                        
                                        <!--The button then changes from "CREATE" to "UPDATE"-->                        
                                        <?php if ($update == true) : ?>
                                            <button type="submit" class="btn btn-info " name="update">UPDATE</button>
                                        <?php else : ?>
                                            <button type="submit" class="btn btn-primary" name="save">CREATE</button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                            <!--Table to display tasks-->
                            <table class="table table-bordered table-light table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Task #</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$i is the task number, making the table a numbered list of task.
                                    $i = 1;
                                    //Fetch the data from tasklist.
                                    while ($row = $result->fetch_assoc()) :
                                        ?>

                                        <tr>
                                            <!--Displays the task title, date, and description.-->
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td class="task"><?php echo $row['task']; ?></td>
                                            <td class="date"><?php echo $row['date']; ?></td>
                                            <td class="description"><?php echo $row['description']; ?></td>
                                            <!--Centered buttons for task options EDIT and DELETE-->
                                            <td align="center" >
                                                <a id="task-button" href="home.php?edit=<?php echo $row['id']; ?>" class="btn btn-info align-bottom">EDIT</a>
                                                <a id="task-button" href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger align-bottom">DELETE</a>
                                            </td>
                                        </tr>
                                        <?php
                                        //As more tasks are added, increment $i, maintaing numbered order for the list.
                                        $i++;
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Script tags for Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <!--Script code for time and date-->
        <script type="text/javascript">
        function display_c() {
            var refresh = 1000; // Refresh rate in milliseconds for time and date to be constantly updated.
            mytime = setTimeout('display_ct()', refresh);
        }

        function display_ct() {
            //Initializing a date variable where the date is displayed.
            var x = new Date();

            //Date variables: Month, day and year.
            var month = x.getMonth() + 1;
            var day = x.getDate();
            var year = x.getFullYear();
            if (month < 10) {
                month = '0' + month;
            }
            if (day < 10) {
                day = '0' + day;
            }
            //Display of date
            var x3 = month + '/' + day + '/' + year;

            //Variables to display the time.
            var hour = x.getHours();
            var minute = x.getMinutes();
            var second = x.getSeconds();
            var newformat = hour >= 12 ? 'PM' : 'AM';

            // Find current hour in AM-PM Format 
            hours = hour % 12;

            //Adds in 0s for single-digit numbers (i.e. 1 -> 01) for time variables
            if (hour < 10) {
                hour = '0' + hour;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (second < 10) {
                second = '0' + second;
            }
            if (hour > 12) {
                hour = hour - 12;
            }
            //Display of time
            var x3 = x3 + ' ' + hour + ':' + minute + ':' + second + " " + newformat;

            document.getElementById('ct').innerHTML = x3;
            display_c();
        }
        </script>
    </body>
</html>
