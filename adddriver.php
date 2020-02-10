<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo "<h1> เพิ่มข้อมูลคนขับ </h1>";
if(isset($_GET["ids"])){
    $id = $_GET["ids"];
    $name = $_GET["names"];
    $lname = $_GET["lnames"];
    $OT = $_GET["OTs"];

    $sql = "UPDATE driver SET dri_name='$name' , dri_lname='$lname' , OT='$OT' WHERE dri_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลเรียบร้อยแล้ว  <a href='editdriver.php'> กลับไปหน้าที่แล้ว </a>" ;
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
}


include('footer.php');
