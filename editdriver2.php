<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo "<h1> จัดการข้อมูลคนขับ </h1>";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $lname = $_GET["lname"];
    $OT = $_GET["OT"];

    $sql = "UPDATE driver SET dri_name='$name' , dri_lname='$lname' , OT='$OT' WHERE dri_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขข้อมูลเรียบร้อยแล้ว  <a href='editdriver.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


if (isset($_GET["id_stop"])) {
    $id = $_GET["id_stop"];
    $sta = 0;

    $sql = "UPDATE driver SET STA='$sta' WHERE dri_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขสถานะคนขับเรียบร้อยแล้ว  <a href='editdriver.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET["id_start"])) {
    $id = $_GET["id_start"];
    $sta = 1;

    $sql = "UPDATE driver SET STA='$sta' WHERE dri_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขสถานะขับเรียบร้อยแล้ว  <a href='editdriver.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET["id_add"])) {
    $id = $_GET["id_add"];
    $name = $_GET["name_add"];
    $lname = $_GET["lname_add"];
    $ot = $_GET["OT_add"];
    $sta = 1;
    
    $sql = "INSERT INTO `driver` (`DRI_ID`, `DRI_NAME`, `DRI_LNAME`, `OT`, `STA`) VALUES ('$id', '$name', '$lname', '$ot', '$sta');";
    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลคนขับเรียบร้อยแล้ว  <a href='editdriver.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

include('footer.php');
