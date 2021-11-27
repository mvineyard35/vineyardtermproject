<!DOCTYPE html>
<html>
    <head>
        <title>Create Database</title>
    </head>
<body>
<?php
    $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');


    //create stduents table
    $createStudents = "CREATE TABLE IF NOT EXISTS student (
        student_id INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY(student_id),
        student_name VARCHAR(50) NOT NULL UNIQUE,
        graduation_date DATE NOT NULL,
        attending BOOLEAN NOT NULL)";
    //create location table
    $createLocation = "CREATE TABLE IF NOT EXISTS destination (
        destination_id INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY(destination_id),
        hotel VARCHAR(20) NOT NULL,
        s_id INT UNSIGNED UNIQUE)";
    //create transportation table
    $createTransport = "CREATE TABLE IF NOT EXISTS transportation (
        trans_id INT UNSIGNED NOT NULL AUTO_INCREMENT, PRIMARY KEY(trans_id),
        method VARCHAR(5),
        t_id INT UNSIGNED UNIQUE)";
    //add foreign key to destination table
    $alterLocation = "ALTER TABLE destination ADD KEY s_id (s_id)";
    $addLocConstraint = "ALTER TABLE destination ADD CONSTRAINT dest_fk FOREIGN KEY(s_id) REFERENCES student(student_id) ON DELETE RESTRICT";
    //add foreign key to transportation table
    $alterTransport = "ALTER TABLE transportation ADD KEY t_id (t_id)";
    $addTranConstraint = "ALTER TABLE transportation ADD CONSTRAINT trans_fk FOREIGN KEY(t_id) REFERENCES student(student_id) ON DELETE RESTRICT";

    //execute all commands
    $db->query($createStudents);
    $db->query($createLocation);
    $db->query($createTransport);
    $db->query($alterLocation);
    $db->query($addLocConstraint);
    $db->query($alterTransport);
    $db->query($addTranConstraint);

    header('location:index.php');
    
?>
