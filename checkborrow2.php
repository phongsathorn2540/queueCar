<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo "<h1> จัดการการขอใช้งานรถ </h1>";
if (isset($_GET["status_q"])) {
    $status = $_GET["status_q"];
    $sql = "UPDATE queues SET QUEUES_STA_ID='3' WHERE QUEUES_ID = '$status'";
    if ($conn->query($sql) === TRUE) {
        echo "อนุมัติแล้ว  <a href='checkborrow.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


include('footer.php');
