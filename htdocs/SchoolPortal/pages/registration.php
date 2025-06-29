<?php
    error_reporting(E_ALL ^ E_NOTICE)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href=
"https://cdn-icons-png.flaticon.com/512/295/295128.png">
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Registration Page</title>
</head>
<body>
<?php 
include 'master.php';
?>

    <div class="container text-center">
    <h1>Welcome to the Registration page</h1>
    </div>

    <?php

    include '../database/DatabaseHandler.php';
    


    $db_type = 'mysql';
    $db_host = 'localhost';
    $db_name = 'school_portal';
    $db_user = 'root';
    $db_pass = 'toor';
    $db_port = '3306';
    $db_charset = 'utf8';
    $message = "";
    $toastClass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];


        $checkEmail = DatabaseHandler::getHandler()->checkEmail($conn,$email);

        if ($checkEmail > 0) {
            $message = "Email ID already exists";
            $toastClass = "#ffa500";
        }
        else {
            $stmt = DatabaseHandler::getHandler()->createUser($conn, $email, $pass, $fname, $lname, $phone);
            

            if ($stmt == true) {
                $message = "Account created successfully";
                $toastClass = "#28a745"; // Success color
            } else {
                $message = "Error: " . $stmt;
                //$message = "Error: " . $stmt->error;
                $toastClass = "#dc3545"; // Failure color
            }
    
        }

    }

?>

<body class="bg-light">
    <div class="container p-5 d-flex flex-column align-items-center">
        <?php if ($message): ?>
            <div class="toast align-items-center text-white border-0" 
          role="alert" aria-live="assertive" aria-atomic="true"
                style="background-color: <?php echo $toastClass; ?>;">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $message; ?>
                    </div>
                    <button type="button" class="btn-close
                    btn-close-white me-2 m-auto" 
                          data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>


            <form method="post" class="form-control mt-5 p-4"
            style="height:auto; width:380px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row text-center">
                <i class="fa fa-user-circle-o fa-3x mt-1 mb-2" style="color: green;"></i>
                <h5 class="p-4" style="font-weight: 700;">Create Your Account</h5>
            </div>
            <div class="mb-2">
                <label for="email"><i 
                  class="fa fa-envelope"></i> Email</label>
                <input type="text" name="email" id="email"
                  class="form-control" required>
            </div>
            <div class="mb-2 mt-2">
                <label for="pass"><i 
                  class="fa fa-lock"></i> Password</label>
                <input type="text" name="pass" id="pass"
                  class="form-control" required>
            </div>
            <div class="mb-2 mt-2">
                <label for="fname"><i 
                  class="fa fa-user"></i> First Name</label>
                <input type="text" name="fname" id="fname"
                  class="form-control" required>
            </div>
            <div class="mb-2 mt-2">
                <label for="lname"><i 
                  class="fa fa-user"></i> Last Name</label>
                <input type="text" name="lname" id="lname"
                  class="form-control" required>
            </div>
            <div class="mb-2 mt-2">
                <label for="phone"><i 
                  class="fa fa-phone"></i> Phone</label>
                <input type="text" name="phone" id="phone"
                  class="form-control" required>
            </div>
            <div class="mb-2 mt-3">
                <button type="submit" 
                  class="btn btn-success
                bg-success" style="font-weight: 600;">Create
                    Account</button>
            </div>
    
        </div>

        
<?php include 'footer.php';?>
</body>
</html>