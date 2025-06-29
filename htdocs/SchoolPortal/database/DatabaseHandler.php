<?php

$db_type = 'mysql';
$db_host = 'localhost';
$db_name = 'school_portal';
$db_user = 'root';
$db_pass = 'toor';
$db_port = '3306';
$db_charset = 'utf8';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


class DatabaseHandler {
    

    private static $handler;

    public static function getHandler() {

        if (!self::$handler) {
            self::$handler = new DatabaseHandler();
        }
        return self::$handler;
    }
    
    
    public function checkEmail($conn,$email) {
        $sql = "SELECT email FROM tbluser WHERE email = ?";
        $checkEmail = $conn->prepare($sql);
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();
        $result = $checkEmail->num_rows;
        return $result;

    }


    public function createUser($conn, $email, $pass, $fname, $lname, $phone) {
        $sql = "INSERT INTO tbluser (email, password, firstName, lastname, phone)
                VALUES (?, ?, ?, ?, ?)";
        $createUser = $conn->prepare($sql);
        $createUser->bind_param("sssss", $email, $pass, $fname, $lname, $phone);

        if ($createUser->execute()) {
            $result = true;
            return $result;
        } else {
            $message = "Error: " . $createUser->error;
            return $message;
        }

    }


    public function loginUser($conn, $email, $pass) {
        $sql = "SELECT password FROM tbluser WHERE email = ?";
        $loginUser = $conn->prepare($sql);
        $loginUser->bind_param("s", $email);
        $loginUser->execute();
        $loginUser->store_result();
        return $loginUser;
    }


    public function getUser($conn, $email) {
        $sql = "SELECT student_id FROM tbluser WHERE email = ?";
        $getUser = $conn->prepare($sql);
        $getUser->bind_param("s", $email);
        $getUser->execute();
        $getUser->store_result();
        return $getUser;
    }


    public function enrollClass($conn, $student_id, $class_id) {
        $sql = "SELECT student_id FROM tbluser WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $student_id = $stmt->fetch(PDO::FETCH_OBJ);

        $enrollStmt = $conn->prepare("INSERT INTO tblenrollment (student_id, class_id)
        VALUES (?, ?)");
        $enrollStmt->bind_param("ii", $student_id, $class_id);
        $enrollStmt->execute();

        if ($stmt->execute()) {
            $stmtResult = true;
            return $stmtResult;
        } else {
            $message = "Error: " . $stmt->error;
            return $message;
        }
        
    }


    public function getClasses($conn) {
        $sql = "SELECT * FROM tblclasses";
        $result = $conn->query($sql);

        $classes = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $classes[] = $row; // Each row is an associative array
            }
        }

    return $classes;
    }

}
?>