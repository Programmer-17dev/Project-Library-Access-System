<?php
session_start(); // เริ่ม session

// ลบ session ทั้งหมด
$_SESSION = array();

// ทำลาย session
session_destroy();

// ส่งผู้ใช้กลับไปยังหน้า login
header("location: ../login.php");
exit;
?>
