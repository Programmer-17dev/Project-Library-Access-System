<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {


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
                    <h1>แก้ไขข้อมูลผู้ดูแลระบบ</h1>
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
                                            <input type="text" name="admin_username" class="form-control" required placeholder="Username" value="<?php echo $row['admin_username']; ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-md-2">Password</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="admin_password" class="form-control" required placeholder="Password" value="<?php echo $row['admin_password']; ?>">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-md-2">ชื่อผู้ดูแลระบบ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="admin_name" class="form-control" required placeholder="ชื่อผู้ดูแลระบบ" value="<?php echo $row['admin_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">สังกัดที่อยู่</label>
                                        <div class="col-sm-4">
                                            <select name="status" id="status" class="form-control select2" required>
                                                <option value="">-- เลือกสังกัดที่อยู่ --</option>
                                                <option value="1" <?php echo ($row['status'] == '1') ? 'selected' : ''; ?>>ศูนย์ในเมือง</option>
                                                <option value="2" <?php echo ($row['status'] == '2') ? 'selected' : ''; ?>>ศูนย์สามพร้าว</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <input type="hidden" name="admin_id" value="<?php echo $row['admin_id']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                            <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
</div>
<!-- /.col-->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
                            if (
                                isset($_POST['admin_username']) &&
                                isset($_POST['admin_name']) &&
                                isset($_POST['status']) &&
                                isset($_POST['admin_id']) // ตรวจสอบว่ามี admin_id ด้วย
                            ) {
                                // รับค่าจากฟอร์ม
                                $admin_username = $_POST['admin_username'];
                                $admin_name = $_POST['admin_name'];
                                $status = $_POST['status'];
                                $admin_id = $_POST['admin_id']; // รับค่า admin_id จากฟอร์ม
                            
                                // เตรียมคำสั่ง SQL สำหรับการอัปเดตข้อมูล
                                $stmt = $conn->prepare("UPDATE admin SET admin_username = ?, admin_name = ?, status = ? WHERE admin_id = ?");
                            
                                // ผูกพารามิเตอร์กับคำสั่ง SQL
                                $stmt->bind_param("sssi", $admin_username, $admin_name, $status, $admin_id);
                            
                                // ประมวลผลคำสั่ง SQL
                                if ($stmt->execute()) {
                                    // ถ้าอัปเดตสำเร็จ
                                    echo "
                                    <script>
                                        Swal.fire({
                                            title: 'อัปเดตข้อมูลสำเร็จ',
                                            text: 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว',
                                            icon: 'success',
                                            confirmButtonText: 'ตกลง'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'admin.php';
                                            }
                                        });
                                    </script>";
                                } else {
                                    // ถ้าเกิดข้อผิดพลาดในการอัปเดต
                                    echo "
                                    <script>
                                        Swal.fire({
                                            title: 'เกิดข้อผิดพลาด',
                                            text: 'ไม่สามารถอัปเดตข้อมูลได้',
                                            icon: 'error',
                                            confirmButtonText: 'ลองอีกครั้ง'
                                        });
                                    </script>";
                                }
                            
                                // ปิดการเชื่อมต่อฐานข้อมูล
                                $stmt->close();
                                $conn->close();
                            }
                            
                            ?>