<?php
require_once('../config/conn.php');

$admin_name = $_SESSION['admin_name'];
$admin_username = $_SESSION['admin_username'];
$status = isset($_SESSION['status']) ? $_SESSION['status'] : 0;
//  $status = 1;
$where_clause1 = "";
if ($status == 1) {
    $where_clause1 = "WHERE checkin.status_place = 1";
} else {
    $where_clause1 = "WHERE checkin.status_place = 2";
}

$sql_num = "SELECT 
            COUNT(checkin.CheckIn_ID) as count_chk ,
            checkin.CheckIn_ID,
            checkin.CheckInTime
        FROM 
            checkin
            $where_clause1 AND DATE(checkin.CheckInTime) = CURDATE()
            ORDER BY checkin.CheckInTime DESC";

$result_num = mysqli_query($conn, $sql_num);
$count = $result_num->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library UDRU</title>

    <!-- Style.css -->
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Icon Webpage -->
    <link rel="shortcut icon" href="../assets/images/UDRU.png" type="image/x-icon">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

</head>

<body>

    <div class="container"></div>