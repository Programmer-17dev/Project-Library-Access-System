<?php

if (isset($_GET['id']) && $_GET['act'] == 'delete') {
    $id = $_GET['id'];
    // echo $id;
    // ทำการลบข้อมูล
    $sql_delete = "DELETE FROM users WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    // echo 'จำนวนที่ลบ'. $stmt_delete->affected_rows;
    $conn = null; // close connect db

    if ($stmt_delete->affected_rows == 1) {
        // ลบข้อมูลสำเร็จ
        echo "
        <script>
            Swal.fire({
                title: 'ลบข้อมูลสำเร็จ',
                text: 'ข้อมูลผู้ใช้ถูกลบเรียบร้อยแล้ว',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'member.php';
                }
            });
        </script>";
        exit();
    } else {
        // ลบข้อมูลไม่สำเร็จ
        echo "
        <script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถลบข้อมูลได้',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'member.php';
                }
            });
        </script>";
        exit();
    }
}
