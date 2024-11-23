<?php
$servername = "localhost"; // ชื่อโฮสต์ของ MySQL
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "lib_udru"; // ชื่อฐานข้อมูลที่ใช้

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Connected successfully";
    // ตั้งค่าชุดตัวอักษรให้เป็น utf8
    mysqli_set_charset($conn, "utf8");
}

// ปิดการเชื่อมต่อ
// $conn->close();
?>
