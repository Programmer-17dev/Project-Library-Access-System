<?php

// นับจำนวนผู้เข้าใช้บริการ (Check-ins)
$stmt = $conn->prepare("SELECT COUNT(*) as totalCheckins FROM `checkin`");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$checkinsCount = $result->fetch_assoc();

$totalcheckinsCount = $checkinsCount['totalCheckins'];

// การจัดกลุ่มตัวเลข
$formattedcheckinsCount = number_format($totalcheckinsCount);

// นับจำนวนสมาชิกทั้งหมด (Users)
$stmt = $conn->prepare("SELECT COUNT(*) as totalUsers FROM `users`;");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$usersCount = $result->fetch_assoc();

$totalUsers = $usersCount['totalUsers'];

// การจัดกลุ่มตัวเลข
$formattedUsersCount = number_format($totalUsers);


// นับจำนวนผู้ดูแลระบบ (Admins)
$stmt = $conn->prepare("SELECT COUNT(*) as totalCheckinRole FROM `checkin` $where_clause ;");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$checkinsCountRole = $result->fetch_assoc();

// นับจำนวน FacultyID ที่ไม่ซ้ำกัน
$stmt = $conn->prepare("SELECT COUNT(DISTINCT FacultyID) as totalFaculties FROM `checkin`;");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$facultiesCount = $result->fetch_assoc();

// นับจำนวน BranchID ที่ไม่ซ้ำกัน
$stmt = $conn->prepare("SELECT COUNT(DISTINCT BranchID) as totalBranches FROM `checkin`;");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$branchesCount = $result->fetch_assoc();

// นับจำนวน Level_ID ที่ไม่ซ้ำกัน
$stmt = $conn->prepare("SELECT COUNT(DISTINCT Level_ID) as totalLevels FROM `checkin`;");
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Fetch the single row
$levelsCount = $result->fetch_assoc();




// PHP: ดึงข้อมูลจากฐานข้อมูลและแปลงชื่อวันเป็นภาษาไทย
$stmt = $conn->prepare("SELECT DATE_FORMAT(`CheckInTime`, '%d/%m/%Y') as checkinDate, DAYNAME(`CheckInTime`) as dayOfWeek, COUNT(*) as dailyCheckins 
FROM `checkin` 
GROUP BY DATE_FORMAT(CheckInTime, '%Y%m%d')
ORDER BY DATE_FORMAT(CheckInTime, '%Y%m%d') DESC
LIMIT 7");
$stmt->execute();
$result = $stmt->get_result();

$dates = array();
$report_data = array();
while ($rs = $result->fetch_assoc()) {
    $dayOfWeek = $rs['dayOfWeek'];
    switch ($dayOfWeek) {
        case 'Sunday': $dayOfWeek = 'วันอาทิตย์'; break;
        case 'Monday': $dayOfWeek = 'วันจันทร์'; break;
        case 'Tuesday': $dayOfWeek = 'วันอังคาร'; break;
        case 'Wednesday': $dayOfWeek = 'วันพุธ'; break;
        case 'Thursday': $dayOfWeek = 'วันพฤหัสบดี'; break;
        case 'Friday': $dayOfWeek = 'วันศุกร์'; break;
        case 'Saturday': $dayOfWeek = 'วันเสาร์'; break;
    }
    
    $dates[] = '"'.$rs['checkinDate'].' ('.$dayOfWeek.')"'; // เตรียมข้อมูลชื่อวัน
    $report_data[] = '
    {
        name: "'.$rs['checkinDate'].'",
        y: '.$rs['dailyCheckins'].',
        drilldown: "'.$rs['checkinDate'].'"
    }';
}

$dates = implode(",", $dates);
$report_data = implode(",", $report_data);

// แสดงข้อมูลที่จัดรูปแบบแล้ว
// echo "<pre>";
// echo print_r($report_data);
// echo "</pre>";

// เตรียมคำสั่ง SQL เพื่อดึงข้อมูลการเข้าใช้บริการรายเดือน
$stmt = $conn->prepare("
    SELECT DATE_FORMAT(`CheckInTime`, '%Y-%m') as monthYear, MONTHNAME(`CheckInTime`) as monthNames, COUNT(*) as totalByMonth
    FROM `checkin` 
    GROUP BY MONTH(CheckInTime), YEAR(CheckInTime)
    ORDER BY DATE_FORMAT(CheckInTime, '%Y%m') DESC
    LIMIT 12
");
$stmt->execute();
$result = $stmt->get_result();

$months = array();
$report_data_month = array();
while ($rsCM = $result->fetch_assoc()) {
    $monthNames = $rsCM['monthNames'];
    
    // แปลงชื่อเดือนเป็นภาษาไทย
    switch ($monthNames) {
        case 'January': $monthNames = 'มกราคม'; break;
        case 'February': $monthNames = 'กุมภาพันธ์'; break;
        case 'March': $monthNames = 'มีนาคม'; break;
        case 'April': $monthNames = 'เมษายน'; break;
        case 'May': $monthNames = 'พฤษภาคม'; break;
        case 'June': $monthNames = 'มิถุนายน'; break;
        case 'July': $monthNames = 'กรกฎาคม'; break;
        case 'August': $monthNames = 'สิงหาคม'; break;
        case 'September': $monthNames = 'กันยายน'; break;
        case 'October': $monthNames = 'ตุลาคม'; break;
        case 'November': $monthNames = 'พฤศจิกายน'; break;
        case 'December': $monthNames = 'ธันวาคม'; break;
    }
    
    $months[] = '"'.$rsCM['monthYear'].' ('.$monthNames.')"'; // เตรียมข้อมูลชื่อเดือน
    $report_data_month[] = '
    {
        name: "'.$rsCM['monthYear'].'",
        y: '.$rsCM['totalByMonth'].',
        drilldown: "'.$rsCM['monthYear'].'"
    }';
}

$months = implode(",", $months);
$report_data_month = implode(",", $report_data_month);

// ส่งค่าตัวแปรเพื่อใช้ในกราฟ
echo "<script>
    var months = [$months];
    var reportData = [$report_data_month];
</script>";




// เตรียมคำสั่ง SQL เพื่อดึงข้อมูลการเข้าใช้บริการรายปี
$stmt_year = $conn->prepare("
    SELECT YEAR(`CheckInTime`) as years, COUNT(*) as totalByYear
    FROM `checkin`
    GROUP BY YEAR(CheckInTime)
    ORDER BY YEAR(CheckInTime) DESC
");
$stmt_year->execute();
$result_year = $stmt_year->get_result();

// จัดเก็บข้อมูลการเข้าใช้บริการรายปีในตัวแปร
$years = array();
$report_data_year = array();
while ($rsYear = $result_year->fetch_assoc()) {
    $years[] = '"' . $rsYear['years'] . '"'; // เก็บปีในรูปแบบ JSON
    $report_data_year[] = '
    {
        name: "' . $rsYear['years'] . '",
        y: ' . $rsYear['totalByYear'] . ',
        drilldown: "' . $rsYear['years'] . '"
    }';
}

$years = implode(",", $years);
$report_data_year = implode(",", $report_data_year);

// ส่งค่าตัวแปรเพื่อใช้ในกราฟ
echo "<script>
    var years = [$years];
    var reportDataYear = [$report_data_year];
</script>";


// echo "<pre>";
// echo print_r($report_data_year);
// echo "</pre>";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard/รายงานภาพรวม</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Small boxes (Stat box) -->
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3><?php echo $formattedcheckinsCount; ?></h3>

                                            <p>จำนวนผู้เข้าใช้บริการทั้งหมด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="checkin.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3><?php echo $formattedUsersCount; ?></h3>

                                            <p>จำนวนสมาชิกทั้งหมด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-stalker"></i>
                                        </div>
                                        <a href="member.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3><?php echo $checkinsCountRole['totalCheckinRole']; ?></h3>

                                            <p>ผู้เข้าใช้บริการ <?php echo $status == 1 ? "ศูนย์ในเมือง" : "ศูนย์สามพร้าว"; ?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person"></i>
                                        </div>
                                        <a href="checkin_role.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                        <h3><?php echo $facultiesCount['totalFaculties']; ?></h3>

                                            <p>จำนวนผู้เข้าใช้แต่ละคณะ</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="faculty.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                        <h3><?php echo $branchesCount['totalBranches']; ?></h3>

                                            <p>จำนวนผู้เข้าใช้แต่ละสาขา</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="branch.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                        <h3><?php echo $levelsCount['totalLevels']; ?></h3>

                                            <p>จำนวนผู้เข้าใช้แต่ละ ระดับ</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="level.php" class="small-box-footer">ข้อมูลเพิ่มเติม <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                        <p class="highcharts-description">.</p>
                                    </figure>
                                    <script>
                                    // Create the chart
                                    Highcharts.chart('container', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'จำนวนการเข้าใช้บริการตามวัน'
                                        },
                                        subtitle: {
                                            text: 'รวมทั้งสิ้น <?php echo $checkinsCount['totalCheckins']; ?> ครั้ง '
                                        },
                                        accessibility: {
                                            announceNewData: {
                                                enabled: true
                                            }
                                        },
                                        xAxis: {
                                            categories: [
                                                <?php echo $dates; ?>
                                            ], // ป้ายชื่อวันในสัปดาห์และวันที่
                                            title: {
                                                text: 'วันที่'
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'จำนวนการเข้าใช้บริการ'
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '{point.y:.0f} ครั้ง'
                                                }
                                            }
                                        },
                                        tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                        },
                                        series: [{
                                            name: "จำนวนการเข้าใช้บริการ",
                                            colorByPoint: true,
                                            data: [<?php echo $report_data; ?>]
                                        }]
                                    });
                                    </script>
                                </div>

                                <div class="col-sm-8">
                                    <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                        <p class="highcharts-description">.</p>
                                    </figure>
                                    <script>
                                    // Create the chart
                                    Highcharts.chart('container2', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'จำนวนการเข้าใช้บริการตามเดือน'
                                        },
                                        subtitle: {
                                            text: 'รวมทั้งสิ้น <?php echo $checkinsCount['totalCheckins']; ?> ครั้ง '
                                        },
                                        accessibility: {
                                            announceNewData: {
                                                enabled: true
                                            }
                                        },
                                        xAxis: {
                                            categories: [<?php echo $months; ?>], // ป้ายชื่อเดือนและปี
                                            title: {
                                                text: 'เดือน'
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'จำนวนการเข้าใช้บริการ'
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '{point.y:.0f} ครั้ง'
                                                }
                                            }
                                        },
                                        tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                        },
                                        series: [{
                                            name: "จำนวนการเข้าใช้บริการ",
                                            colorByPoint: true,
                                            data: [<?php echo $report_data_month; ?>]
                                        }]
                                    });
                                    </script>
                                </div>
                                <div class="col-sm-4">
                                    <figure class="highcharts-figure">
                                        <div id="container3"></div>
                                        <p class="highcharts-description">.</p>
                                    </figure>
                                    <script>
                                    // Create the chart
                                    Highcharts.chart('container3', {
                                        chart: {
                                            type: 'column'
                                        },
                                        title: {
                                            text: 'จำนวนการเข้าใช้บริการตามปี'
                                        },
                                        subtitle: {
                                            text: 'รวมทั้งสิ้น <?php echo $checkinsCount['totalCheckins']; ?> ครั้ง '
                                        },
                                        accessibility: {
                                            announceNewData: {
                                                enabled: true
                                            }
                                        },
                                        xAxis: {
                                            categories: years, // ใช้ตัวแปร years ที่เตรียมไว้
                                            title: {
                                                text: 'ปี'
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'จำนวนการเข้าใช้บริการ'
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '{point.y:.0f} ครั้ง'
                                                }
                                            }
                                        },
                                        tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
                                        },
                                        series: [{
                                            name: "จำนวนการเข้าใช้บริการ",
                                            colorByPoint: true,
                                            data: [<?php echo $report_data_year; ?>]
                                        }]
                                    });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->