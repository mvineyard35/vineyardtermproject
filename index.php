<!DOCTYPE html>
<html>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href = "style.css">
        <!-- index.php 
        Michael Vineyard
        vineyarm@csp.edu
        Term Project
        11/11/2021
        -->
    <head>
        <title>Term Project</title>
    </head>
    <body>
        <?php
        $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');
        //populate student table
        $dbS = "INSERT INTO student (student_name, graduation_date, attending) VALUES
        ('Steve Bollick', '2022-06-01', 'true'),
        ('Marie Pollick', '2022-06-01', 'false'),
        ('Marcus Arellius', '2022-06-01', 'true'),
        ('Danielle Goodwin', '2022-06-01', 'true')";
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

        $studentList = mysqli_query($db, "SELECT * FROM student");
        $destinationList = mysqli_query($db, "SELECT * FROM destination");
        $transportationList = mysqli_query($db, "SELECT * FROM transportation");

        ?>
    <div class = "nav">
            <div id = "buttons">
                <button><a href = "readME.html">Read Me</a></button> | <button><a href = "https://vineyardtermproject.herokuapp.com/">Website</a></button> | <button><a href = "drop.php">Drop tables</a></button> | <button><a href = "createDatabase.php">Create</a></button>
            </div>
        </div>
        <div class = "images">
            <h3>Images for project</h3>
        
        <a href="https://vineyardtermproject.herokuapp.com/Graphic/layout.png"><img src="https://vineyardtermproject.herokuapp.com/Graphic/layout.png"></a>
        <a href = "https://vineyardtermproject.herokuapp.com/Graphic/database.png"><img src="https://vineyardtermproject.herokuapp.com/Graphic/database.png"></a>
        </div>
        <?php 
            if($studentList === false) {
                echo "plesae create some tables";
            }
            else {
        echo "<div class = 'tables'>";
           echo "<table>";
                echo "<h2>Students</h2>";
               echo "<tr>";
                  echo "<td>Student id</td>";
                   echo "<td>Student Name</td>";
                   echo "<td>Graduation Date</td>";
                    echo "<td>Attending</td>";
               echo "</tr>";
                
                    //import student information
                    while($studentArray = $studentList->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" .$studentArray['student_id'] ."</td>";
                        echo "<td>" .$studentArray['student_name'] ."</td>";
                        echo "<td>" .$studentArray['graduation_date'] ."</td>";
                        echo "<td>" .$studentArray['attending'] ."</td>";
                        echo "</tr>";
                    }
                
            echo "</table>";
           echo "<table>";
                echo "<h2>Hotel</h2>";
               echo "<tr>";
                   echo "<td>Student id</td>";
                    echo "<td>Hotel</td>";
               echo "</tr>";
                
                    //import hotel information
                    while($destinationArray = $destinationList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" .$destinationArray['s_id'] ."</td>";
                        echo "<td>" .$destinationArray['hotel'] ."</td>";
                        echo "</tr>";
                    }
            
            echo "</table>";
           echo "<table>";
               echo "<h2>Transportation Method</h2>";
               echo "<tr>";
                   echo "<td>Student id</td>";
                   echo "<td>Method</td>";
                echo "</tr>";
                
                    //import transportation information
                    while($transportationArray = $transportationList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" .$transportationArray['t_id'] ."</td>";
                        echo "<td>" .$transportationArray['method'] ."</td>";
                        echo "</tr>";
                    }
           echo "</table>";
                }
                ?>

        </div>
    </body>
</html>