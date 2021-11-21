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
        include 'createDatabase.php';
        include 'drop.php';

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
        <a href="/Graphic/layout.png"><img src="/Graphic/layout.png"></a>
        <a href = "/Graphic/database.png"><img src="/Graphic/database.png"></a>
        <!--<a href="/termProject/Graphic/layout.png"><img src="/termProject/Graphic/layout.png"></a>
        <a href = "/termProject/Graphic/database.png"><img src="/termProject/Graphic/database.png"></a>-->
        </div>
        <div class = "tables">
            <table>
                <h2>Students</h2>
                <tr>
                    <td>Student id</td>
                    <td>Student Name</td>
                    <td>Graduation Date</td>
                    <td>Attending</td>
                </tr>
                <?php
                    //import student information
                    while($studentArray = $studentList->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" .$studentArray['student_id'] ."</td>";
                        echo "<td>" .$studentArray['student_name'] ."</td>";
                        echo "<td>" .$studentArray['graduation_date'] ."</td>";
                        echo "<td>" .$studentArray['attending'] ."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <table>
                <h2>Hotel</h2>
                <tr>
                    <td>Student id</td>
                    <td>Hotel</td>
                </tr>
                <?php
                    //import hotel information
                    while($destinationArray = $destinationList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" .$destinationArray['s_id'] ."</td>";
                        echo "<td>" .$destinationArray['hotel'] ."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <table>
                <h2>Transportation Method</h2>
                <tr>
                    <td>Student id</td>
                    <td>Method</td>
                </tr>
                <?php 
                    //import transportation information
                    while($transportationArray = $transportationList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" .$transportationArray['t_id'] ."</td>";
                        echo "<td>" .$transportationArray['method'] ."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>

        </div>
    </body>
</html>