<?php
include('inc/db.php');
include('header.php');
include('menu.php');

echo "<h1> จัดการข้อมูลรถ </h1>";
if (isset($_GET["numqueue"])) {
    $q_id = $_GET["numqueue"];
    $user_id = "1";
    $dri_id = $_GET['dri_id'];
    $car_id = $_GET['car_id'];
    $numseat = $_GET['numseat'];
    $localtion = $_GET['localtion'];
    $distance = $_GET["distance"];
    $startdate = $_GET["day-start"];
    $timestart = $_GET["time-start"];
    $enddate = $_GET["day-end"];
    $timeend = $_GET["time-end"];
    $n_project = $_GET["n-project"];
    $sql = "INSERT INTO `queues` (`QUEUES_ID`, `START_DATE`, `START_TIME`,  `END_DATE`, `END_TIME`, `Q_LOCATION` , `NUM_SEAT` , `DISTANCE` , `USER_ID` , `CAR_ID` , `DRI_ID` , `QUEUES_STA_ID`) 
    VALUES ('$q_id', '$startdate', '$timestart', '$enddate', '$timeend' , '$localtion' , '$numseat' , '$distance' , '$user_id' , '$car_id' , '$dri_id' , '1');";
    $sql2 ="INSERT INTO queues_user (`QUEUES_ID` , `USER_ID`) VALUES ('$q_id' , '1');";
    $sql3 ="INSERT INTO queues_detail (`queues_id` , `queues_detail_text`) VALUES ('$q_id' , '$n_project');";

    if ($conn->query($sql) === TRUE) {
        echo "จองคิวร้อยแล้ว  <a href='borrow.php'> กลับไปหน้าที่แล้ว </a>";
        if($conn->query($sql2) === TRUE) {
        }
        if($conn->query($sql3) === TRUE) {
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}



include('footer.php');