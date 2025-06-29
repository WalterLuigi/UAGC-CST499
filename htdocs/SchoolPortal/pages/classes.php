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
    <title>Class Registration</title>
</head>
<body>
<?php 
include 'master.php';
?>

    <div class="container text-center">
    <h1>Available Classes</h1>
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

    $classes = DatabaseHandler::getHandler()->getClasses($conn);

?>

<body class="bg-light">
    <div class="container p-5 d-flex flex-column align-items-center">
    <form method="post" action="process_selected_classes.php">
    <?php foreach ($classes as $class): ?>
        <div class="class-block">
            <input type="checkbox" name="selected_classes[]" value="<?php echo htmlspecialchars($class['class_id']); ?>">
            <div>
                <?php foreach ($class as $key => $value): ?>
                    <strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?><br>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <input type="submit" value="Submit Selected Classes">
</form>

<?php include 'footer.php';?>
</body>
</html>