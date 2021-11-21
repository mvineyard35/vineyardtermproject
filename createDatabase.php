<!DOCTYPE html>
<html>
    <head>
        <title>Create Database</title>
    </head>
<body>
<?php
    $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', '	p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');

    //drop tables
    $dropStudents = "DROP TABLE students";

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
    //populate student table
    $dbS = "INSERT INTO student (student_name, graduation_date, attending) VALUES
    ('Steve Bollick', '06/01/2022', 'true'),
    ('Marie Pollick', '06/01/2022', 'false'),
    ('Marcus Arellius', '06/01/2022', 'true'),
    ('Danielle Goodwin', '06/01/2022', 'true')";
    //populate destination table
    $dbL = "INSERT INTO destination (hotel, s_id) VALUES
    ('Hilton', (SELECT student_id FROM student WHERE student_name = 'Steve Bollick')),
    ('none', (SELECT student_id FROM student WHERE student_name = 'Marie Pollick')),
    ('Beaches', (SELECT student_id FROM student WHERE student_name = 'Marcus Arellius')),
    ('Hilton', (SELECT student_id FROM student WHERE student_name = 'Danielle Goodwin'))";
    //populate transportation table
    $dbT = "INSERT INTO transportation (method, t_id) VALUES
    ('plane', (SELECT student_id FROM student WHERE student_name = 'Steve Bollick')),
    ('none', (SELECT student_id FROM student WHERE student_name = 'Marie Pollick')),
    ('plane', (SELECT student_id FROM student WHERE student_name = 'Marcus Arellius')),
    ('boat', (SELECT student_id FROM student WHERE student_name = 'Danielle Goodwin'))";
    //execute commands
    $db->query($dbS);
    $db->query($dbL);
    $db->query($dbT);
?>

<a href = "index.php">Back</a>
</body>
</html>