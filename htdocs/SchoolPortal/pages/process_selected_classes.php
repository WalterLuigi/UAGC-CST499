<?php

session_start();


error_reporting(E_ALL ^ E_NOTICE);


if (!isset($_SESSION['username'])) {
    die("Error: Student not logged in.");
}


if (!isset($_POST['selected_classes']) || empty($_POST['selected_classes'])) {
    die("Error: No classes selected.");
}


$student_id = $_SESSION['username'];


$selected_classes = $_POST['selected_classes'];


include '../database/DatabaseHandler.php';
    


$db_type = 'mysql';
$db_host = 'localhost';
$db_name = 'school_portal';
$db_user = 'root';
$db_pass = 'toor';
$db_port = '3306';
$db_charset = 'utf8';


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO tblenrollment (student_id, class_id) VALUES (?, ?)");


if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}


foreach ($selected_classes as $class_id) {

    $stmt->bind_param("ss", $student_id, $class_id);
    if (!$stmt->execute()) {
        echo "Failed to register for class ID $class_id: " . $stmt->error . "<br>";
    }
}


$stmt->close();
$conn->close();


echo "<div class='container text-center'><h2>Registration successful!</h2></div>";
?>