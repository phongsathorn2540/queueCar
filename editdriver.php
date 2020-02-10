<?php
include('inc/db.php');
include('header.php');
include('menu.php');
echo '
<h1>แก้ไขข้อมูลคนขับรถ</h1>
';


$sqlmax = "SELECT MAX(dri_id) as max FROM driver";
$resultmax = $conn->query($sqlmax);
$rowmax = $resultmax->fetch_assoc();
$next_id =  $rowmax['max'] + 1;

$sql = "SELECT dri_id , dri_name , dri_lname , OT , sta  FROM driver";
$result = $conn->query($sql);
echo '<table width="90%" border="0">
<tr>
    <td> ลำดับ </td>
    <td> ชื่อ </td>
    <td> นามสกุล </td>
    <td> ค่าโอที</td>
    <td>         
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModaladd">
    เพิ่มคนขับ
  </button> 
  </td>
</tr>
';
$modelnumber = 0;
while ($row = $result->fetch_assoc()) {
    if($row['sta'] != 0){
        echo '
        <tr>
            <td style="width:10%;"> ' . $row['dri_id'] . ' </td> 
            
            <td style="width:20%;"> ' . $row['dri_name'] . ' </td>
            <td style="width:20%;"> ' . $row['dri_lname'] . ' </td> 
            <td style="width:20%;"> ' . $row['OT'] . ' </td> 
            
            <td> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
            แก้ไขข้อมูล
          </button> 
          </td>
          <td>
          <form method="get" action="editdriver2.php">
          <input type="text" name="id_stop" value=' . $row['dri_id'] . ' hidden>
          <button type="submit" class="btn btn-danger">
          หยุดปฏิบัติงาน
        </button> 
        </form>
          </td>
        </tr>
        ';
    }else {
            echo '
            <tr>
                <td style="width:10%;"> ' . $row['dri_id'] . ' </td> 
                
                <td style="width:20%;"> ' . $row['dri_name'] . ' </td>
                <td style="width:20%;"> ' . $row['dri_lname'] . ' </td> 
                <td style="width:20%;"> ' . $row['OT'] . ' </td> 
                
                <td> 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' . $modelnumber . '">
                แก้ไขข้อมูล
              </button> 
              </td>
              <td>
              <form method="get" action="editdriver2.php">
              <input type="text" name="id_start" value=' . $row['dri_id'] . ' hidden>
              <button type="submit" class="btn btn-success">
              เริ่มปฏิบัติงาน
            </button> 
            </form>
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
    <h5 class="modal-title" id="exampleModaladdLabel">เพิ่มคนขับ</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form method="get" action="editdriver2.php">
     ลำดับ <input type="text" name="id_add" value="'. $next_id .'" hidden> '.$next_id.' <br>
     ชื่อ <input type="text" name="name_add"> <br>
     นามสกุล <input type="text" name="lname_add"> <br>
     OT <input type="text" name="OT_add"> 
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
        <h5 class="modal-title" id="exampleModal' . $modelnumber . 'Label">แก้ไขข้อมูลคนขับ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="editdriver2.php">
         ลำดับ ' . $row['dri_id'] . ' <input type="text" name="id" value=' . $row['dri_id'] . ' hidden><br>
         ชื่อ <input type="text" name="name" value=' . $row['dri_name'] . '> <br>
         นามสกุล <input type="text" name="lname" value=' . $row['dri_lname'] . '> <br>
         OT <input type="number" name="OT" value=' . $row['OT'] . '> 
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
