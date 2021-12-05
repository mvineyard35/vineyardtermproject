<!DOCTYPE html>
<html>
    <head>
        <title>Drop Table</title>
    </head>
<body>
<?php
    $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');
    //$db = mysqli_connect('localhost', 'root', 'mysql', 'prjterm');
    //drop tables
    $dropStudents = "DROP TABLE student";
    $dropLocation = "DROP TABLE destination";
    $dropTransportation = "DROP TABLE transportation";

    //execute commands
    $db->query($dropTransportation);
    $db->query($dropLocation);
    $db->query($dropStudents);

    header('location:index.php');
?>
