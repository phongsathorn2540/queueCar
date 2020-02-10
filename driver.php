<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo '
<h1>ข้อมูลคนขับรถ</h1>
<table width="90%">
<tr>
<td> ชื่อคนขับ </td>
<td> นามสกุล </td>
<td> ค่าร OT </td>
</tr>
';
$sql = "SELECT dri_name , dri_lname , ot FROM driver";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    echo '
    <tr>
    <td> ' . $row['dri_name'] . ' </td>
    <td> ' . $row['dri_lname'] . ' </td>
    <td> ' . $row['ot'] . ' </td>
    ';
}
echo '</table>';

include('footer.php');
