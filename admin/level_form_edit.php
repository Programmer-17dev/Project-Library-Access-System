<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {


    $stmt = $conn->prepare("SELECT * FROM level WHERE Level_ID = ?");

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
                    <h1>แก้ไขข้อมูลคณะ</h1>
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
                                        <label class="col-md-2">ชื่อคณะ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="LevelName" class="form-control" required placeholder="ชื่อคณะ" value="<?php echo $row['LevelName']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <input type="hidden" name="Level_ID" value="<?php echo $row['Level_ID']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                            <a href="level.php" class="btn btn-danger">ยกเลิก</a>
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
                                isset($_POST['LevelName']) &&
                                isset($_POST['Level_ID']) // ตรวจสอบว่ามี Level_ID ด้วย
                            ) {
                                // รับค่าจากฟอร์ม
                                $LevelName = $_POST['LevelName'];
                                $Level_ID = $_POST['Level_ID']; // รับค่า Level_ID จากฟอร์ม
                            
                                // เตรียมคำสั่ง SQL สำหรับการอัปเดตข้อมูล
                                $stmt = $conn->prepare("UPDATE level SET LevelName = ? WHERE Level_ID = ?");
                            
                                // ผูกพารามิเตอร์กับคำสั่ง SQL
                                $stmt->bind_param("si", $LevelName, $Level_ID);
                            
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
                                                window.location.href = 'level.php';
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