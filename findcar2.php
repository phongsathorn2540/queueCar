<?php
include('inc/db.php');
include('header.php');
include('menu.php');



echo '
<h1>ค้นหารถที่ว่าง</h1> <br>

';
if (isset($_GET["start_date"])) {
    $start = $_GET['start_date'];
    $end = $_GET['end_date'];
    $type = $_GET['car_type'];
    echo '
        <h3>ระหว่างวันที่ ' . $start . ' - ' . $end . ' </h3>
    ';
    $sql = "SELECT car_id FROM queues WHERE START_DATE BETWEEN '$start' and '$end'";
    $result = $conn->query($sql);
    $arrcarfree[] = null;
    $arrcartype[] = null;
    $arrcarprice[] = null;
    $arrcarnump[] = null;
    $arrcarseatmax[] = null;
    $arrcarcharge[] = null;
    echo '
    <table width="90%" border="0">
        <tr>
            <td>หมายเลขทะเบียน</td>
            <td>ประเภทรถ</td>
            <td>จำนวนที่นั่ง</td>
            <td>ค่าบริการ / km </td>
            <td>ค่าธรรมเนียม</td>
        </tr>
';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $caruse = $row['car_id'];
            $sqlcar = "SELECT car_id , car_type , car_price , car_number_p , car_seat_max , car_service_charge from car where car_id != '$caruse' and car_type='$type'";
            $resultcar = $conn->query($sqlcar);
            while ($rowcar = $resultcar->fetch_assoc()) {
                echo '
                <tr>
                <td> ' . $rowcar['car_number_p'] . ' </td>
                <td> ' . $rowcar['car_type'] . ' </td>
                <td> ' . $rowcar['car_seat_max'] . ' </td>
                <td> ' . $rowcar['car_price'] . ' </td>
                <td> ' . $rowcar['car_service_charge'] . ' </td>
                </tr>
                ';
                $arrcarfree[] = $rowcar['car_id'];
                $arrcartype[] = $rowcar['car_type'];
                $arrcarprice[] = $rowcar['car_price'];
                $arrcarnump[] = $rowcar['car_number_p'];
                $arrcarseatmax[] = $rowcar['car_seat_max'];
                $arrcarcharge[] = $rowcar['car_service_charge'];
            }
        }
    } else {
        $sqlcar = "SELECT car_id , car_type , car_price , car_number_p , car_seat_max , car_service_charge from car where car_type='$type'";
        $resultcar = $conn->query($sqlcar);
        while ($rowcar = $resultcar->fetch_assoc()) {
            echo '
            <tr>
            <td> ' . $rowcar['car_number_p'] . ' </td>
            <td> ' . $rowcar['car_type'] . ' </td>
            <td> ' . $rowcar['car_seat_max'] . ' </td>
            <td> ' . $rowcar['car_price'] . ' </td>
            <td> ' . $rowcar['car_service_charge'] . ' </td>
            </tr>
            ';
            $arrcarfree[] = $rowcar['car_id'];
            $arrcartype[] = $rowcar['car_type'];
            $arrcarprice[] = $rowcar['car_price'];
            $arrcarnump[] = $rowcar['car_number_p'];
            $arrcarseatmax[] = $rowcar['car_seat_max'];
            $arrcarcharge[] = $rowcar['car_service_charge'];
        }
    }
    echo '</table>';
}
include('footer.php');
