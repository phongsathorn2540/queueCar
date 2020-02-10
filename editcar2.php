<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo "<h1> จัดการข้อมูลรถ </h1>";
if (isset($_GET["car_id"])) {
    $car_id = $_GET["car_id"];
    $car_type = $_GET["car_type"];
    $car_price = $_GET["car_price"];
    $car_number_p = $_GET["car_number_p"];
    $car_seat_max = $_GET["car_seat_max"];
    $car_status = $_GET["car_status"];
    $car_service_charge = $_GET["car_service_charge"];
    $sql = "UPDATE car SET car_type='$car_type' , car_price='$car_price' , car_number_p='$car_number_p' , car_seat_max='$car_seat_max' , car_status='$car_status' , car_service_charge='$car_service_charge' WHERE car_id = $car_id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขข้อมูลรถเรียบร้อยแล้ว  <a href='editcar.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}


if (isset($_GET["id_stop"])) {
    $id = $_GET["id_stop"];
    $sta = 0;

    $sql = "UPDATE car SET car_status='$sta' WHERE car_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขสถานะรถเรียบร้อยแล้ว  <a href='editcar.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET["id_start"])) {
    $id = $_GET["id_start"];
    $sta = 1;

    $sql = "UPDATE car SET car_status='$sta' WHERE car_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "แก้ไขสถานะรถเรียบร้อยแล้ว  <a href='editcar.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET["id_add"])) {
    $car_id = $_GET["id_add"];
    $car_type = $_GET["car_type"];
    $car_price = $_GET["car_price"];
    $car_number_p = $_GET["car_number_p"];
    $car_seat_max = $_GET["car_seat_max"];
    $car_status = $_GET["car_status"];
    $car_service_charge = $_GET["car_service_charge"];
    
    $sql = "INSERT INTO `car` (`car_id`, `car_type`, `car_price`, `car_number_p`, `car_seat_max` , `car_status` , `car_service_charge`) 
    VALUES ('$car_id', '$car_type', '$car_price', '$car_number_p', '$car_seat_max' , '$car_status' , '$car_service_charge');";
    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มข้อมูลรถเรียบร้อยแล้ว  <a href='editcar.php'> กลับไปหน้าที่แล้ว </a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

include('footer.php');
