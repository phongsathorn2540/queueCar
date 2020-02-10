<?php 
include('inc/db.php');
include('header.php');
include('menu.php');
$sqlmax = "SELECT MAX(QUEUES_ID) as max FROM queues";
$resultmax = $conn->query($sqlmax);
$rowmax = $resultmax->fetch_assoc();
$next_id =  $rowmax['max'] + 1;

$sqlname = "SELECT user_name , user_rank from users where user_id = '1'";
$resultname = $conn->query($sqlname);
$rowname = $resultname->fetch_assoc();
$name = $rowname['user_name'];
$rank = $rowname['user_rank'];

$sql2 = "SELECT car_type , car_id , car_number_p FROM car";
$result2 = $conn->query($sql2);
$cartypelist = '';
$carplist = '';
while($row2 = $result2->fetch_assoc()){
    $cartypelist .= '<option value="' . $row2['car_id'] .'">' . $row2['car_type'] .'</option>';
    $carplist .= '<option value="' . $row2['car_id'] .'">' . $row2['car_number_p'] .'</option>';
}

$sql3 = "SELECT dri_id , dri_name , dri_lname FROM driver";
$result3 = $conn->query($sql3);
$drilist = '';
while($row3 = $result3->fetch_assoc()){
    $drilist .= '<option value="' . $row3['dri_id'] .'">' . $row3['dri_name'] .' &nbsp;'. $row3['dri_lname'] .'</option>';
}
echo '
<h1 class="h3 mb-4 text-gray-800">บันทึกข้อความ</h1>
          <form action="borrow2.php" method="get">
            <input type="text" name="numqueue" hidden value="'. $next_id .'">
            <br>
            ผู้เดินทาง
            <br>
            <input type="text" name="f-name" placeholder="ชื่อ" value="'.$name.'" disabled>
            <input type="text" name="rank" placeholder="ตำแหน่ง" value="'.$rank.'" disabled>
            <br>
            <input type="number" name="numseat" placeholder="จำนวนคนเดินทาง" required>
            <br>
            <br>
            หมายเลขทะเบียนรถ  <select name="car_id">
            ' . $carplist .'
            </select> <br> 
            คนขับรถ   <select name="dri_id">
            ' . $drilist .'
            </select> <br>

            <br>
            <br>
            <input type="text" name="n-project" placeholder="เหตุผลที่ขอใช้รถ" required>
            <input type="text" name="localtion" placeholder="สถานที่" required>
            <input type="text" name="distance" placeholder="ระยะทาง" required>
            <br>
            <br>
            เดินทางไป
            <input type="date" name="day-start" value="' .date("Y-m-d") .'">
            <input type="time" name="time-start" value="' . date("h:i") .'">
            เดินทางกลับ
            <input type="date" name="day-end" value="' .date("Y-m-d") .'">
            <input type="time" name="time-end" value="' . date("h:i") .'">
            <br>
            <br>
            <button type="submit" class="btn btn-primary">
              จองคิว
            </button> 
          </form>
';
include('footer.php');
