<?php
include('inc/db.php');
include('header.php');
include('menu.php');

$sql2 = "SELECT DISTINCT(car_type) AS car_type FROM car";
$result2 = $conn->query($sql2);
$cartypelist = '';
while($row2 = $result2->fetch_assoc()){
    $cartypelist .= '<option value="' . $row2['car_type'] .'">' . $row2['car_type'] .'</option>';

}
echo '
<h1>ค้นหารถที่ว่าง</h1>

<br>

<form action="findcar2.php" method="get">
วันเริ่มต้น<input type="date" name="start_date" value="' .date("Y-m-d") .'">
<br>
สิ้นสุด<input type="date" name="end_date" value="' .date("Y-m-d") .'">
<br>
ประเภทรถ
<select name="car_type">
'. $cartypelist .'
</select>
<br>
<button type="submit" class="btn btn-primary">
ค้นหา
<buton
</form>
';

include('footer.php');
