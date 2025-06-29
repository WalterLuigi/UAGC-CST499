<?php
    error_reporting(E_ALL ^ E_NOTICE)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Profile Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'master.php';?>

    <div class="container text-center">
    <h1>Welcome to the Profile page</h1>
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

if ( isset($_SESSION['username'])) {
    $student_id = $_SESSION['username'];
    $rowResults = array(); 
    $rowResults = DatabaseHandler::getHandler()->getData($conn);

    echo'<div class="container p-5 d-flex flex-column align-items-center">';
        echo'<div class="container text-center">';
            echo'<ul style="list-style-type:none;">';
                echo'<li>Email: '. $rowResults["email"].'</li>';
                echo'<br>'; 
                echo'<li>First Name: '. $rowResults["firstName"].'</li>';
                echo'<br>'; 
                echo'<li>Last Name: '. $rowResults["lastName"].'</li>';
                echo'<br>'; 
                echo'<li>Phone: '. $rowResults["phone"].'</li>';
                echo'<br>';       
                echo'<br>'; 
                echo'<li>Enrolled Classes</li>'; 
                echo'<br>'; 
                
                
                $enrolled_classes_query = "SELECT c.class_id, c.class_name,  c.description, c.credits
                FROM tblenrollment e
                JOIN tblclasses c ON e.class_id = c.class_id
                WHERE e.student_id = ?";
             
                 $stmt = $conn->prepare($enrolled_classes_query);
                 $stmt->bind_param("s", $student_id);
                 $stmt->execute();
                 $result = $stmt->get_result();
             
                 if ($result->num_rows > 0) {
                     echo '<form method="post" action="process_drop_classes.php">';
             
                     while ($class = $result->fetch_assoc()) {
                     // Display class details with checkbox to drop
                         echo '<div class="class-block">';
                         echo '<input type="checkbox" name="drop_classes[]" value="' . $class['class_id'] . '"> ';
                         echo '<strong>Class Name:</strong> ' . htmlspecialchars($class['class_name']) . '<br>';
                         echo '<strong>Description:</strong> ' . htmlspecialchars($class['description']) . '<br>';
                         echo '<strong>Credits:</strong> ' . htmlspecialchars($class['credits']) . '<br>';
                         echo '</div><br>';
                     }
                     echo '<input type="submit" value="Drop Selected Classes" class="btn btn-danger">';
                     echo '</form>';
             
                 } else {
                     echo '<p>No classes enrolled yet.</p>';
                 }

            echo'</ul>';
        echo'</div>';
    echo'</div>';
    
}




?>

<?php include 'footer.php';?>
</body>
</html>