<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
require_once('../config/conn.php');

// รับค่าจาก DataTables
$limit = $_POST['length'];  // จำนวนแถวที่จะแสดง
$start = $_POST['start'];   // จุดเริ่มต้นของแถวที่จะแสดง
$order_column = $_POST['order'][0]['column'];  // คอลัมน์ที่จะใช้ในการจัดเรียง
$order_dir = $_POST['order'][0]['dir'];  // ทิศทางการจัดเรียง (asc หรือ desc)
$search_value = $_POST['search']['value']; // ค่าค้นหาที่ถูกป้อนใน DataTables

// แปลงคอลัมน์ที่จะใช้ในการจัดเรียงตาม DataTables index
$columns = [
    "id",
    "UserID",
    "FirstName",
    "LastName",
    "phone",
    "BranchName",
    "FacultyName",
    "LevelName"
];
$order_column = $columns[$order_column];

// คำสั่ง SQL สำหรับดึงข้อมูลพร้อมการแบ่งหน้า
$sql = "
    SELECT 
        u.id,
        u.UserID, 
        u.FirstName, 
        u.LastName, 
        u.phone, 
        b.BranchName, 
        f.FacultyName, 
        l.LevelName 
    FROM users u
    LEFT JOIN branch b ON u.BranchID = b.BranchID
    LEFT JOIN faculty f ON u.FacultyID = f.FacultyID
    LEFT JOIN level l ON u.Level_ID = l.Level_ID
";

// ตรวจสอบว่ามีการค้นหาหรือไม่
if (!empty($search_value)) {
    $sql .= " WHERE (u.UserID LIKE '%$search_value%' 
                OR u.FirstName LIKE '%$search_value%' 
                OR u.LastName LIKE '%$search_value%' 
                OR u.phone LIKE '%$search_value%' 
                OR b.BranchName LIKE '%$search_value%' 
                OR f.FacultyName LIKE '%$search_value%' 
                OR l.LevelName LIKE '%$search_value%')";
}

// เพิ่มเงื่อนไขการจัดเรียงและการแบ่งหน้า
$sql .= " ORDER BY $order_column $order_dir LIMIT $start, $limit";

// รันคำสั่ง SQL
$query = mysqli_query($conn, $sql);

// เก็บข้อมูลที่ได้จากฐานข้อมูล
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $row['edit'] = '<a href="member.php?id=' . $row['id'] . '&act=edit" class="btn btn-warning">แก้ไข</a>';
    $row['delete'] = '<a href="#" class="btn btn-danger" onclick="confirmDelete(' . $row['id'] . '); return false;">ลบ</a>';
    $data[] = $row;
}

// นับจำนวนข้อมูลทั้งหมดก่อนการกรอง
$sql_total = "SELECT COUNT(*) as total FROM users";
$query_total = mysqli_query($conn, $sql_total);
$total_records = mysqli_fetch_assoc($query_total)['total'];

// นับจำนวนข้อมูลหลังจากการกรอง (ถ้ามี)
if (!empty($search_value)) {
    $sql_filtered = "
        SELECT COUNT(*) as total 
        FROM users u
        LEFT JOIN branch b ON u.BranchID = b.BranchID
        LEFT JOIN faculty f ON u.FacultyID = f.FacultyID
        LEFT JOIN level l ON u.Level_ID = l.Level_ID
        WHERE (u.UserID LIKE '%$search_value%' 
                OR u.FirstName LIKE '%$search_value%' 
                OR u.LastName LIKE '%$search_value%' 
                OR u.phone LIKE '%$search_value%' 
                OR b.BranchName LIKE '%$search_value%' 
                OR f.FacultyName LIKE '%$search_value%' 
                OR l.LevelName LIKE '%$search_value%')";
    $query_filtered = mysqli_query($conn, $sql_filtered);
    $filtered_records = mysqli_fetch_assoc($query_filtered)['total'];
} else {
    $filtered_records = $total_records;
}

// ส่งข้อมูลกลับไปยัง DataTables ในรูปแบบ JSON
$response = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $total_records,
    "recordsFiltered" => $filtered_records,
    "data" => $data
];

echo json_encode($response);

// ปิดการเชื่อมต่อ
mysqli_close($conn);
