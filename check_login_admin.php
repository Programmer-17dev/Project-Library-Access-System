<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>

<body>
<?php
include('config/conn.php');
session_start(); // เริ่ม session

// ตรวจสอบว่ามีการส่งข้อมูลผ่านแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีข้อมูล username และ password ถูกส่งมาหรือไม่
    if (isset($_POST['admin_username']) && isset($_POST['admin_password'])) {

        // นำเข้าข้อมูลและทำการ escape เพื่อป้องกันการทำ SQL Injection
        $username = $conn->real_escape_string($_POST['admin_username']);
        $password = $conn->real_escape_string($_POST['admin_password']);

        // คำสั่ง SQL สำหรับการตรวจสอบข้อมูลผู้ใช้
        $sql = "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'";

        // ทำการ query ข้อมูล
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีผลลัพธ์ที่สอดคล้องหรือไม่
        if ($result->num_rows == 1) {
            // ดึงข้อมูลแถวที่ตรงกัน
            $row = $result->fetch_assoc();
            
            // เก็บ session และเชื่อมต่อผู้ใช้เข้าสู่ระบบ
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_name'] = $row['admin_name']; // เก็บชื่อผู้ดูแลใน session
            $_SESSION['admin_username'] = $row['admin_username']; // เก็บชื่อผู้ดูแลใน session
            $_SESSION['status'] = $row['status']; // เก็บสถานะใน session

            // ใช้ SweetAlert2 เพื่อแสดงข้อความเมื่อเข้าสู่ระบบสำเร็จ
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ!',
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                    window.location.href = 'index_check_list/index.php'; // เปลี่ยนเส้นทางไปหน้า index.php
                });
            </script>";
        } else {
            // ใช้ SweetAlert2 เพื่อแสดงข้อความเมื่อไม่พบข้อมูลผู้ใช้
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่พบข้อมูลผู้ใช้',
                    text: 'กรุณาตรวจสอบ username และ password ของคุณ',
                }).then(function() {
                    window.location.href = 'login.php';
                });
            </script>";
        }
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
</body>
</html>
