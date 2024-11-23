<?php

session_start(); // เริ่ม session
// ตรวจสอบว่ามี session ของผู้ใช้หรือไม่
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){

    // สามารถเพิ่มลิงก์ไปยังหน้าอื่นๆ หรือฟังก์ชั่นอื่นๆ ตามต้องการ
}else{
    // ถ้าไม่มี session ของผู้ใช้
    header("location:../login.php"); 
    exit;
}


?>



