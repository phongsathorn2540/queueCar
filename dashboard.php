<?php

echo '

<div class="row">            
<div class="col-xl-3 col-md-6 mb-3">
<div class="card border-left-warning shadow h-100 py-2">
  <div class="card-body">
    <div class="row no-gutters align-items-center">
      <div class="col mr-2">
        <div class="text-x font-weight-bold text-warning text-uppercase mb-1">
          คิวที่กำลังอยู่ในระหว่างการพิจารณา</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
      </div>
      <div class="col-auto">
        <i class="fas fa-comments fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-success shadow h-100 py-2">
  <div class="card-body">
    <div class="row no-gutters align-items-center">
      <div class="col mr-2">
        <div class="text-x font-weight-bold text-success text-uppercase mb-1">คิวที่พิจารณาแล้ว</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
      </div>
      <div class="col-auto">
        <i class="fas fa-calendar fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
</div>
</div>

</div>


<h1 class="h3 mb-4 text-gray-800">ปฏิธินการใช้งานรถ</h1>
<div id="wrap">

<div id="calendar"></div>

<div style="clear:both"></div>
</div>
';
$mounth = '11';
$year = '2019';
if (isset($_GET["mounth"])) {
  $mounth = $_GET["mounth"];
}

function build_calendar($month, $year)
{
    include('inc/db.php');
    $color = array("primary", "success", "info");
    $daysOfWeek = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $calendar = "<table class='calendar table table-condensed table-bordered' height='700'>";
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }
    $currentDay = 1;
    $calendar .= "</tr><tr>";
    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
    }
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $sql = "SELECT start_date , end_date , end_time , user_id , start_time , car_id FROM `queues` WHERE START_DATE = '$date'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $queueofday[] = $row['start_date'];
                $start_time[] = $row['start_time'];
                $end_date[] = $row['end_date'];
                $sql2 = 'SELECT user_name FROM USERS WHERE USER_ID = ' . $row['user_id']. '';
                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_assoc()) {
                    $user_name[] = $row2['user_name'];
                }
                $sql3 = 'SELECT car_number_p FROM car WHERE CAR_ID = ' . $row['car_id']. '';
                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                    $car_number_p[] = $row3['car_number_p'];
                }
            }
            $iofday = 0;
            $calendar .= "<td class='day' rel='$date' style='width:14%' valign='top'>
            <p align='right'>$currentDay</p>";
            while ($iofday < count($queueofday)) {

                $calendar .= ' <div class="bg-' . $color[$iofday] . ' text-white text-left">&nbsp; <i class="fas fa-play"></i> '. $start_time[$iofday] . '  '  . $user_name[$iofday] . ' '.$car_number_p[$iofday] .'</div>';
                $iofday++;
            }
            $calendar .= "</td>";
        }else{
            $calendar .= "<td class='day' rel='$date' style='width:14%'><p align='right'>$currentDay</p></td>";
        }

        $currentDay++;
        $dayOfWeek++;
    }
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
    }
    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}
echo " <h1>เดือน   $mounth ปี $year </h1> ";
if($mounth <= 13)
{
  echo '
  
  ';
}
$calendar = build_calendar($mounth, $year);
$calendar = '<div style="width:100%;">' . $calendar . '</div>';
$calendar .= '<style type="text/css">table tbody tr td, table tbody tr th { text-align: center; }</style>';


echo $calendar;
echo 'Thank a <a href="https://gist.github.com/Xeoncross/9552088" target="_blank">Xeoncross</a>';
