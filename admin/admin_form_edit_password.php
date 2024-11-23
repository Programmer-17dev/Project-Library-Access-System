<?php
if (isset($_GET['id']) && $_GET['act'] == 'editPwd') {


    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = ?");

    // ผูกพารามิเตอร์และประมวลผลคำสั่ง SQL
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Debug: แสดงค่าที่ดึงมาจากฐานข้อมูล
    // echo '<pre>';
    // print_r($row);
    // exit();


    // exit();
    // ถ้าไม่มีข้อมูล ให้กลับไปหน้า index
    if ($result->num_rows != 1) {

        exit();
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลรหัสผ่านผู้ดูแลระบบ</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-2">Username</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="admin_username" class="form-control"
                                                placeholder="Username" value="<?php echo $row['admin_username']; ?>"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">ชื่อผู้ดูแลระบบ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="admin_name" class="form-control"
                                                placeholder="ชื่อผู้ดูแลระบบ" value="<?php echo $row['admin_name']; ?> "
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">New Password</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="NewPassword" class="form-control" required
                                                placeholder="รหัสผ่านใหม่">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Confirm Password</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="ConfirmPassword" class="form-control" required
                                                placeholder="ยืนยันรหัสผ่าน">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <input type="hidden" name="admin_id"
                                                value="<?php echo $row['admin_id']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                            <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            //     echo "<pre>";
                            //     print_r($_POST);
                            //     exit();
                            // 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
</div>
<!-- /.content-wrapper -->

<?php
if (
    isset($_POST['admin_id']) && // ตรวจสอบว่ามี admin_id ด้วย
    isset($_POST['NewPassword']) &&
    isset($_POST['ConfirmPassword'])
) {
    // รับค่าจากฟอร์ม
    $admin_id = $_POST['admin_id'];
    $NewPassword = $_POST['NewPassword'];
    $ConfirmPassword = $_POST['ConfirmPassword'];

    if ($NewPassword != $ConfirmPassword) {
        // รหัสผ่านไม่ตรงกัน
        echo '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "รหัสผ่านไม่ตรงกัน",
                    text: "กรุณากรอกรหัสผ่านใหม่อีกครั้ง",
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = "admin.php?id=' . $admin_id . '&act=editPwd";
                });
              </script>';
    } else {
        // เตรียมคำสั่ง SQL สำหรับการอัปเดตข้อมูล
        $stmt = $conn->prepare("UPDATE admin SET admin_password = ? WHERE admin_id = ?");

        // เข้ารหัสรหัสผ่านก่อนบันทึก
        $hashedPassword = ($NewPassword);

        // ผูกพารามิเตอร์กับคำสั่ง SQL
        $stmt->bind_param("si", $hashedPassword, $admin_id);

        // ประมวลผลคำสั่ง SQL
        if ($stmt->execute()) {
            // อัปเดตสำเร็จ
            echo "
                <script>
                    Swal.fire({
                        title: 'แก้ไขรหัสผ่านสำเร็จ',
                        text: 'รหัสผ่านถูกอัปเดตเรียบร้อยแล้ว',
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin.php';
                        }
                    });
                </script>";
        } else {
            // เกิดข้อผิดพลาดในการอัปเดต
            echo "
                <script>
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถแก้ไขรหัสผ่านได้',
                        icon: 'error',
                        confirmButtonText: 'ลองอีกครั้ง'
                    });
                </script>";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        $stmt->close();
        $conn->close();
    }
}





//     // เตรียมคำสั่ง SQL สำหรับการอัปเดตข้อมูล
//     $stmt = $conn->prepare("UPDATE admin SET admin_password = ? WHERE admin_id = ?");

//     // ผูกพารามิเตอร์กับคำสั่ง SQL
//     $stmt->bind_param("sssi", $admin_username, $admin_name, $status, $admin_id);

//     // ประมวลผลคำสั่ง SQL
//     if ($stmt->execute()) {
//         // ถ้าอัปเดตสำเร็จ
//         echo "
//         <script>
//             Swal.fire({
//                 title: 'อัปเดตข้อมูลสำเร็จ',
//                 text: 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว',
//                 icon: 'success',
//                 confirmButtonText: 'ตกลง'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     window.location.href = 'admin.php';
//                 }
//             });
//         </script>";
//     } else {
//         // ถ้าเกิดข้อผิดพลาดในการอัปเดต
//         echo "
//         <script>
//             Swal.fire({
//                 title: 'เกิดข้อผิดพลาด',
//                 text: 'ไม่สามารถอัปเดตข้อมูลได้',
//                 icon: 'error',
//                 confirmButtonText: 'ลองอีกครั้ง'
//             });
//         </script>";
//     }

//     // ปิดการเชื่อมต่อฐานข้อมูล
//     $stmt->close();
//     $conn->close();
// }

?>