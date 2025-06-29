<?php
    error_reporting(E_ALL ^ E_NOTICE);
    if ( !isset($_SESSION))
    {
        ini_set('session.use_only_cookies',1);
        session_start();
    }
    if ( isset($_SESSION['username']))
        echo "Welcome: " , $_SESSION['username'];
    //if ( isset($_SESSION['email']))
    //    echo "Welcome: " , $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/295/295128.png">
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
  content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="jumbotron">
    <div class="container text-center">
        <h1>Royal Tech University</h1>

    </div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-earphone"></span> ContactUs</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
        <?php
            if ( !isset($_SESSION))
            {
                ini_set('session.use_only_cookies',1);
                session_start();
            }

            if ( isset($_SESSION['username']))
            {
                echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>';
                echo '<li><a href="profile.php"><span class="glyphicon glyphicon-briefcase"></span> Profile</a></li>';
                echo '<li><a href="classes.php"><span class="glyphicon glyphicon-exclamation-sign"></span> Classes</a></li>';
            }
            else
            {
                echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>';
                echo '<li><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span> Registration</a></li>';
            }
        ?>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>