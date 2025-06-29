<?php
// Start session
session_start();

// Check if student is logged in
if (!isset($_SESSION['username'])) {
    die("Error: Student not logged in.");
}

// Check if any classes are selected for dropping
if (!isset($_POST['drop_classes']) || empty($_POST['drop_classes'])) {
    die("Error: No classes selected for dropping.");
}

// Get the student_id from session
$student_id = $_SESSION['username'];

// Get the array of class IDs to drop
$drop_classes = $_POST['drop_classes'];

// Database connection settings
$host = "localhost";
$user = "root";
$password = "toor";
$database = "school_portal";

// Create MySQLi connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Prepare delete statement to drop classes from tblenrollment
$stmt = $conn->prepare("DELETE FROM tblenrollment WHERE student_id = ? AND class_id = ?");

// Check if statement preparation was successful
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Loop through the selected classes and remove each one from enrollment
foreach ($drop_classes as $class_id) {
    $stmt->bind_param("ss", $student_id, $class_id);
    if (!$stmt->execute()) {
        echo "Failed to drop class ID $class_id: " . $stmt->error . "<br>";
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect back to profile page with success message
header("Location: profile.php?message=Classes Dropped Successfully");
exit();
?>