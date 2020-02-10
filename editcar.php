<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo '
<h1>แก้ไขข้อมูลรถ</h1>
';


$sqlmax = "SELECT MAX(car_id) as max FROM car";
$resultmax = $conn->query($sqlmax);
$rowmax = $resultmax->fetch_assoc();
$next_id =  $rowmax['max'] + 1;
$sql2 = "SELECT DISTINCT(car_type) AS car_type FROM car";
$result2 = $conn->query($sql2);
$cartypelist = '';
while($row2 = $result2->fetch_assoc()){
    $cartypelist .= '<option value="' . $row2['car_type'] .'">' . $row2['car_type'] .'</option>';

}

$sql3 = "SELECT car_status_detail , car_status FROM car_status_detail";
$result3 = $conn->query($sql3);
$carstadetail = '';
while ($row3 = $result3->fetch_assoc()){
    $carstadetail .= '<option value="' . $row3['car_status'] .'">' . $row3['car_status_detail'] .'</option>';
}

$sql = "SELECT car_id , car_type , car_price , car_number_p , car_seat_max , car.car_status , car_service_charge , car_status_detail.car_status_detail FROM car
inner join car_status_detail 
on car.car_status = car_status_detail.car_status
";
$result = $conn->query($sql);
echo '<table width="90%" border="0">
<tr>
    <td> ลำดับ </td>
    <td> ประเภทรภ </td>
    <td> ราคาค่าบริการ/km </td>
    <td> ป้ายทะเบียน</td>
    <td> จำนวนที่นั่ง</td>
    <td> สถานะรถ</td>
    <td> ค่าธรรมเนียม</td>
    <td>         
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModaladd">
    เพิ่มรถ
  </button> 
  </td>
</tr>
';
$modelnumber = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['car_status'] != 4) {
        echo '
        <tr>
            <td> ' . $row['car_id'] . ' </td> 
            
            <td> ' . $row['car_type'] . ' </td>
            <td> ' . $row['car_price'] . ' </td> 
            <td> ' . $row['car_number_p'] . ' </td> 
            <td> ' . $row['car_seat_max'] . ' </td> 
            <td> ' . $row['car_status_detail'] . ' </td> 
            <td> ' . $row['car_service_charge'] . ' </td> 
            <td> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
            แก้ไขข้อมูล
          </button> 
          </td>
        </tr>
            ';
    } else {
        echo '
        <tr>
            <td> ' . $row['car_id'] . ' </td> 
            
            <td> ' . $row['car_type'] . ' </td>
            <td> ' . $row['car_price'] . ' </td> 
            <td> ' . $row['car_number_p'] . ' </td> 
            <td> ' . $row['car_seat_max'] . ' </td> 
            <td> ' . $row['car_status_detail'] . ' </td> 
            <td> ' . $row['car_service_charge'] . ' </td> 
            <td> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
            แก้ไขข้อมูล
          </button> 
          </td>
        </tr>
            ';
    }
    echo '
    <!-- Modal -->
<div class="modal fade" id="exampleModaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModaladdLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModaladdLabel">เพิ่มคนขับ ss</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form method="get" action="editcar2.php">
     ลำดับ <input type="text" name="id_add" value="' . $next_id . '" hidden> ' . $next_id . ' <br>
     ประเภทของรถ   <select name="car_type">
     ' . $cartypelist .'
   </select> <br>
     ราคาค่าบริการ/km  <input type="text" name="car_price" > <br>
     ป้ายทะเบียน <input type="text" name="car_number_p"> <br>
     จำนวนที่นั่ง <input type="text" name="car_seat_max"> <br>
     สถานะรถ <select name="car_status">
     '. $carstadetail .'
     </select> <br>
     ค่าธรรมเนียม <input type="text" name="car_service_charge"> <br>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  </form>
</div>
</div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal' . $modelnumber . '" tabindex="-1" role="dialog" aria-labelledby="exampleModal' . $modelnumber . 'Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal' . $modelnumber . 'Label">แก้ไขข้อมูลรถ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="editcar2.php">
         ลำดับ ' . $row['car_id'] . ' <input type="text" name="car_id" value=' . $row['car_id'] . ' hidden><br>
         ประเภทของรถ   <select name="car_type">
         ' . $cartypelist .'
       </select> <br>
         ราคาค่าบริการ/km  <input type="text" name="car_price" value=' . $row['car_price'] . '> <br>
         ป้ายทะเบียน <input type="text" name="car_number_p" value=' . $row['car_number_p'] . '> <br>
         จำนวนที่นั่ง <input type="text" name="car_seat_max" value=' . $row['car_seat_max'] . '> <br>
         สถานะรถ <select name="car_status">
         '. $carstadetail .'
         </select> <br>
         ค่าธรรมเนียม <input type="text" name="car_service_charge" value=' . $row['car_service_charge'] . '> <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
';
    $modelnumber++;
}

echo '
</table>

';
include('footer.php');
