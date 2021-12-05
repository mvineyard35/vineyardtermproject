<?php 
    $db = mysqli_connect('jtb9ia3h1pgevwb1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'p081dv8hvgthri1x', 'djo0l25dt7qekz8f', 'zktddrg0kdg1cz31');
    //$db = mysqli_connect('localhost', 'root', 'mysql', 'prjterm');
    $sql = "CALL getStudentList()";
    $list = $db->query($sql);
    while($result = $list->fetch_array()) {
        echo $result['student_name'] ."</br>";
        echo $result['graduation_date'] ."</br>";
        echo $result['attending'] ."</br>";
    }
    echo "<a href = 'index.php'>Back</a>"
?>