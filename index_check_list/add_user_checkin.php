<?php
include('../config/conn.php');

// เริ่ม session
session_start();

// รับข้อมูลจากฟอร์ม
if (isset($_POST['userID']) && isset($_POST['status_place'])) {
    $userID = $_POST['userID'];
    $status_place = $_POST['status_place']; // ค่า status ที่รับมาจากฟอร์ม
    $CheckInTime = date('Y-m-d H:i:s'); // กำหนด CheckInTime ตามเวลาที่ต้องการ

    // ตรวจสอบว่า userID มีอยู่ในตาราง Users หรือไม่
    $checkUserSql = "SELECT * 
                     FROM `users`
                     LEFT JOIN branch ON users.BranchID = branch.BranchID
                     LEFT JOIN faculty ON users.FacultyID = faculty.FacultyID
                     LEFT JOIN level ON users.Level_ID = level.Level_ID
                     WHERE userID = ?";
    $stmt = $conn->prepare($checkUserSql);
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $checkUserResult = $stmt->get_result();

    if ($checkUserResult->num_rows > 0) {
        // ดึงข้อมูลผู้ใช้
        $user = $checkUserResult->fetch_assoc();
        $_SESSION['userID'] = $userID;
        $_SESSION['firstName'] = $user['FirstName'];
        $_SESSION['lastName'] = $user['LastName'];
        $_SESSION['branch'] = $user['BranchName'];
        $_SESSION['faculty'] = $user['FacultyName'];
        $_SESSION['level'] = $user['LevelName'];

        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO checkin (UserID, FirstName, LastName, BranchID, FacultyID, Level_ID, CheckInTime, status_place) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $userID, $user['FirstName'], $user['LastName'], $user['BranchID'], $user['FacultyID'], $user['Level_ID'], $CheckInTime, $status_place);

        if ($stmt->execute()) {
            // ส่งผู้ใช้กลับไปยังหน้า index.php โดยไม่ส่งผ่าน URL
            $_SESSION['latestCheckIn'] = $stmt->insert_id;
            $_SESSION['status_place'] = $status_place; // ตั้งค่า session status ให้เป็นค่าที่รับมาจากฟอร์ม
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // ถ้าไม่มี userID ในตาราง Users
        $_SESSION['error'] = "ไม่มีรหัสผู้ใช้ในระบบ";
        header("Location: index.php");
        exit();
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
