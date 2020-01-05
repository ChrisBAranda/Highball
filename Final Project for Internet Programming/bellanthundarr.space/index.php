<html>
    <head>
        <title>Task Manager | Login</title>
        <!--Link to the favicon image and other links to bootstrap and style sheets-->
        <!--This also loads any images used for this project.-->         
        <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="page-header">
        </div>

        <nav class="navbar navbar-dark bg-primary">
        </nav>

        <!--Container element that holds the login and registration box-->
        <div class="container">
            <div class="login-box">      
                <div class="row">
                    <!--Start of Login code-->
                    <div class="col-md-6 login-left">
                        <h2>Login</h2>
                        <form action="validation.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <!--End of Login code-->


                    <!--For the registration part of the project-->
                    <div class="col-md-6 login-right">
                        <h2>Register</h2>
                        <form action="registration.php" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="user" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                    <!--End of registration code-->
                </div>
            </div>
        </div>
        <div>
            <img id="bold-and-brash" alt="trash" src="https://vignette.wikia.nocookie.net/spongebob/images/f/f2/Oldbash.jpg/revision/latest?cb=20170724203516">
            <p id="desc">Artist: Squidward J. Q. Tentacles
                <br>Title: Bold and Brash (Restored) (August 1999)</p>
        </div>
    </body>
</html>
