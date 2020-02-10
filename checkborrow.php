<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo '
<h1>อนุมัติการยืมรถ</h1>
';


$sqlmax = "SELECT MAX(car_id) as max FROM car";
$resultmax = $conn->query($sqlmax);
$rowmax = $resultmax->fetch_assoc();
$next_id =  $rowmax['max'] + 1;
$sql2 = "SELECT DISTINCT(car_type) AS car_type FROM car";
$result2 = $conn->query($sql2);
$cartypelist = '';
while ($row2 = $result2->fetch_assoc()) {
    $cartypelist .= '<option value="' . $row2['car_type'] . '">' . $row2['car_type'] . '</option>';
}


$sql =
    "SELECT queues.QUEUES_ID as queues_id , START_DATE , START_TIME ,END_DATE , DISTANCE ,END_TIME ,Q_LOCATION , NUM_SEAT , DISTANCE , USER_NAME ,USER_RANK, CAR_TYPE , CAR_NUMBER_P  , DRI_NAME ,QUEUES_STA_ID ,queues_detail.queues_detail_text as queues_details FROM `queues`
inner join queues_detail on queues.QUEUES_ID = queues_detail.queues_id
inner join users on queues.USER_ID = users.USER_ID
inner join car on queues.CAR_ID=car.CAR_ID
inner JOIN driver on queues.DRI_ID = driver.DRI_ID
";
$result = $conn->query($sql);
echo '<table width="90%" border="0">
<tr>
    <td> ลำดับ </td>
    <td> เหตุผลการขอใช้</td>
    <td> ประเภทรถที่ขอยืม </td>
    <td> หมายเลขทะเบียน </td>
    <td> จุดหมาย</td>
    <td> วันที่</td>
    <td> เวลาเริ่ม</td>
    <td> ระยะทาง</td>
    <td> ผู้ยืม</td>
    <td> จำนวนคน</td>
    <td>         
  </td>
</tr>
';
$modelnumber = 0;
$queues = '';
$queueserlist = '';
while ($row = $result->fetch_assoc()) {
    $queuess = $row['queues_id'];
    $sql3 = "SELECT user_name , user_rank FROM queues , users , queues_user WHERE queues.QUEUES_ID = '$queuess' and queues.QUEUES_ID = queues_user.QUEUES_ID and users.USER_ID = queues_user.USER_ID";
    $result3 = $conn->query($sql3);
    while ($row3 = $result3->fetch_assoc()) {
        $queueserlist .= $row3['user_name'] .'&nbsp;'. $row3['user_rank'] .'<br>'; 
    }
    if($row['QUEUES_STA_ID'] != '1' ){
        echo '
        <tr>
        <td> ' . $row['queues_id'] . ' </td> 
        <td> ' . $row['queues_details'] . ' </td>
        <td> ' . $row['CAR_TYPE'] . ' </td> 
        <td> ' . $row['CAR_NUMBER_P'] . ' </td> 
        <td> ' . $row['Q_LOCATION'] . ' </td> 
        <td> ' . $row['START_DATE'] . '-' . $row['END_DATE'] . ' </td> 
        <td> ' . $row['START_TIME'] . '-' . $row['END_TIME'] . ' </td> 
        <td> ' . $row['DISTANCE'] . ' </td> 
        <td> ' . $row['USER_NAME'] . ' </td> 
        <td> ' . $row['NUM_SEAT'] . ' </td> 
        <td> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
        ข้อมูลเพิ่มเติม
      </button> 
      </td>
    </tr>
        
        ';
    }else {
        echo '
        <tr>
        <td> ' . $row['queues_id'] . ' </td> 
        <td> ' . $row['queues_details'] . ' </td>
        <td> ' . $row['CAR_TYPE'] . ' </td> 
        <td> ' . $row['CAR_NUMBER_P'] . ' </td> 
        <td> ' . $row['Q_LOCATION'] . ' </td> 
        <td> ' . $row['START_DATE'] . '-' . $row['END_DATE'] . ' </td> 
        <td> ' . $row['START_TIME'] . '-' . $row['END_TIME'] . ' </td> 
        <td> ' . $row['DISTANCE'] . ' </td> 
        <td> ' . $row['USER_NAME'] . ' </td> 
        <td> ' . $row['NUM_SEAT'] . ' </td> 
        <td> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
            ข้อมูลเพิ่มเติม
      </button> 
      </td>
      <td>
      <form action="checkborrow2.php" method="get">
       <input name="status_q" value='.$row['queues_id'].' hidden>
      <button type="หีิทระ" class="btn btn-success" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
      อนุมัติ
    </button> 
    </form>
      </td>

    </tr>
        ';
    }
    echo '
        <!-- Modal -->
<div class="modal fade" id="exampleModal' . $modelnumber . '" tabindex="-1" role="dialog" aria-labelledby="exampleModal' . $modelnumber . 'Label" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModal' . $modelnumber . 'Label">ข้อมูลการขอใช้รถ</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <b>รายชื่อผู้ร่วมเดินทาง</b> 
    <br>
    ' . $row['USER_NAME'] . ' &nbsp; '. $row['USER_RANK'].' &nbsp; <b> ผู้ยืม </b>
    <br>
    ' . $queueserlist .' 
    <br>
    <b>คนขับรถ </b><br>
    ' . $row['DRI_NAME'] . '
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
            ';
}
echo '
</table>

';
include('footer.php');
