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
        //attending will be radio buttons
        //or it will be the date input
        $dbS = "INSERT INTO student (student_name, graduation_date, attending) VALUES
        ('Steve Bollick', '2022-06-01', true), 
        ('Marie Pollick', '2022-06-01', false),
        ('Marcus Arellius', '2022-06-01', true),
        ('Danielle Goodwin', '2022-06-01', true)";
        //populate destination table
        //hotels will be drop down menu
        $dbL = "INSERT INTO destination (hotel, s_id) VALUES
        ('Hilton', (SELECT student_id FROM student WHERE student_name = 'Steve Bollick')),
        ('none', (SELECT student_id FROM student WHERE student_name = 'Marie Pollick')),
        ('Beaches', (SELECT student_id FROM student WHERE student_name = 'Marcus Arellius')),
        ('Hilton', (SELECT student_id FROM student WHERE student_name = 'Danielle Goodwin'))";
        //populate transportation table
        //method will be checkboxes
        $dbT = "INSERT INTO transportation (method, t_id) VALUES
        ('Plane', (SELECT student_id FROM student WHERE student_name = 'Steve Bollick')),
        ('None', (SELECT student_id FROM student WHERE student_name = 'Marie Pollick')),
        ('Plane', (SELECT student_id FROM student WHERE student_name = 'Marcus Arellius')),
        ('Boat', (SELECT student_id FROM student WHERE student_name = 'Danielle Goodwin'))";
        //execute commands
        $db->query($dbS);
        $db->query($dbL);
        $db->query($dbT);

        $studentList = mysqli_query($db, "SELECT * FROM student");
        $destinationList = mysqli_query($db, "SELECT * FROM destination");
        $transportationList = mysqli_query($db, "SELECT * FROM transportation");
        if(isset($_GET['color'])){
            $color = $_GET['color'];
        }
         
        if(isset($_POST['btn-submit'])) {
            $name = $_POST['name'];
            $date = $_POST['gradDate'];
            $attending = $_POST['opt-attending'];
            if($attending == 'yes') {
                $attending = true;
            }
            else {
                $attending = false;
            }
            $hotel = $_POST['lst-hotel'];
            $method = $_POST['chk-method'];

           $addS =  mysqli_query($db, "INSERT INTO student (student_name, graduation_date, attending) VALUES ('$name', '$date', '$attending')");
           $addD =  mysqli_query($db, "INSERT INTO destination (hotel, s_id) VALUES ('$hotel', (SELECT student_id FROM student WHERE student_name = '$name'))");
           $addM =  mysqli_query($db, "INSERT INTO transportation (method, t_id) VALUES ('$method', (SELECT student_id FROM student WHERE student_name = '$name'))");

            if($addM) {
                header("location:index.php");
            }
        }
        


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
                   echo "<th>Student Name</th>";
                   echo "<th>Graduation Date</th>";
                    echo "<th>Attending</th>";
               echo "</tr>";
                
                    //import student information
                    while($studentArray = $studentList->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" .$studentArray['student_name'] ."</td>";
                        echo "<td>" .$studentArray['graduation_date'] ."</td>";
                        if($studentArray['attending'] === '1') {
                            echo "<td>" ."Yes" ."</td>";
                        }
                        else {
                            echo "<td>" ."No" ."</td>";
                        }
                        echo "</tr>";
                    }
                
            echo "</table>";
           echo "<table>";
                echo "<h2>Hotel</h2>";
               echo "<tr>";
                   echo "<th>Student Name</th>";
                    echo "<th>Hotel</th>";
               echo "</tr>";
                
                    //import hotel information
                    while($destinationArray = $destinationList->fetch_assoc()) {
                        $s_id = $destinationArray['s_id'];
                        $qry = mysqli_query($db, "SELECT student_name FROM student WHERE student_id = '$s_id'");
                        $info = $qry->fetch_array();
                        echo "<tr>";
                        echo "<td>" .$info['student_name'] ."</td>";
                        echo "<td>" .$destinationArray['hotel'] ."</td>";
                        echo "</tr>";
                    }
            
            echo "</table>";
           echo "<table>";
               echo "<h2>Transportation Method</h2>";
               echo "<tr>";
                   echo "<th>Student Name</th>";
                   echo "<th>Method</th>";
                echo "</tr>";
                
                    //import transportation information
                    while($transportationArray = $transportationList->fetch_assoc()) {
                        $t_id = $transportationArray['t_id'];
                        $qry = mysqli_query($db, "SELECT student_name FROM student WHERE student_id = '$t_id'");
                        $info = $qry->fetch_array();
                        echo "<tr>";
                        echo "<td>" .$info['student_name'] ."</td>";
                        echo "<td>" .$transportationArray['method'] ."</td>";
                        echo "</tr>";
                    }
           echo "</table>";
                }
                ?>

        </div>
        <form method = "GET">
        <input type="color" name = "color" id="colorPick" value="white" onchange="this.form.submit()"/>
        </form>
        <div class = "form" style = "color: <?php echo $color ?>">
            <fieldset style = "width: 30vw;">
                <h3>New participant</h3>
                <form method = "POST">
                    <input type = "text" name = "name" id = "studentName" value = "name" placeholder="Enter Name"/>
                    <label for="gradDate">Graduation Date</label>
                    <input type = "date" name = "gradDate" id="graduation" value="2021-06-01"/>
                    <p style = "text-align: left">will you be attending?</p>
                    <input type = "radio" name = "opt-attending" id="opt-attendingY" value="yes"/>
                    <label for="opt-attendingY">Yes</label>
                    <input type = "radio" name = "opt-attending" id="opt-attendingN" value="no"/>
                    <label for="opt-attendingN">No</label></br></br>
                    <label for="lst-hotel">Choose a Hotel</label>
                    <select name = "lst-hotel" id="lst-hotel" value="none">
                        <option value = "Hilton">Hilton</option>
                        <option value="Beaches">Beaches</option>
                        <option value="Mariott">Mariott</option>
                        <option value="Holiday Inn">Holiday Inn</option>
                        <option value="None">None</option>
                    </select></br>
                    
                    <p style = "text-align: left">Method of travel</p>
                    <input type="checkbox" name="chk-method" id="chk-plane" value="Plane">
                    <label for="chk-plane">Plane</label>
                    <input type="checkbox" name='chk-method' id="chk-boat" value="Boat">
                    <label for="chk-boat">Boat</label>
                    <input type="checkbox" name="chk-method" id="chk-none" value="None"/>
                    <label for="chk-none">None</label></br>
                    <input type="submit" name="btn-submit" id = "btn-submit" value="Submit"/>
                </form>
            </fieldset>
        </div>
    </body>
</html>