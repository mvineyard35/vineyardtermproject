<!DOCTYPE html>
<html>
    <head>
        <title>Drop Table</title>
    </head>
<body>
<?php
    $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', '	p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');

    //drop tables
    $dropStudents = "DROP TABLE students";
    $dropLocation = "DROP TABLE destination";
?>
<a href = "index.php">Back</a>
</body>
</html>