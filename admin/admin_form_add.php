<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>เพิ่มข้อมูลผู้ดูแลระบบ</h1>
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
                                            <input type="text" name="admin_username" class="form-control" required placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Password</label>
                                        <div class="col-sm-4">
                                            <input type="password" name="admin_password" class="form-control" required placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">ชื่อผู้ดูแลระบบ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="admin_name" class="form-control" required placeholder="ชื่อผู้ดูแลระบบ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">สังกัดที่อยู่</label>
                                        <div class="col-sm-4">
                                            <select name="status" id="status" class="form-control select2" required>
                                                <option value="">-- เลือกสังกัดที่อยู่ --</option>
                                                <option value="1">ศูนย์ในเมือง</option>
                                                <option value="2">ศูนย์สามพร้าว</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
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

<!-- เพิ่มข้อมูล -->
<?php 
                                // echo "<pre>";
                                // print_r($_POST);
                                // exit();
                             
                                if (
                                    isset($_POST['admin_username']) &&
                                    isset($_POST['admin_password']) &&
                                    isset($_POST['admin_name']) &&
                                    isset($_POST['status'])
                                ) {
                                    // รับค่าจากฟอร์ม
                                    $admin_username = $_POST['admin_username'];
                                    $admin_password = $_POST['admin_password'];
                                    $admin_name = $_POST['admin_name'];
                                    $status = $_POST['status'];
                                
                                    // ตรวจสอบว่ามี admin_id ซ้ำหรือไม่
                                    $check_sql = "SELECT admin_id FROM admin WHERE admin_username = ?";
                                    $stmt_check = mysqli_prepare($conn, $check_sql);
                                
                                    if ($stmt_check) {
                                        mysqli_stmt_bind_param($stmt_check, "s", $admin_username);
                                        mysqli_stmt_execute($stmt_check);
                                        mysqli_stmt_store_result($stmt_check);
                                
                                        if (mysqli_stmt_num_rows($stmt_check) > 0) {
                                            // หากพบว่ามี admin_username ซ้ำ
                                            echo '<script>
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "ชื่อผู้ใช้นี้มีอยู่แล้วในระบบ",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {
                                                    window.location = "admin.php";
                                                });
                                            </script>';
                                        } else {
                                            // หากไม่มี admin_username ซ้ำ ทำการเพิ่มข้อมูลใหม่
                                            $insert_sql = "INSERT INTO admin (admin_username, admin_password, admin_name, status) 
                                                           VALUES (?, ?, ?, ?)";
                                            $stmt_insert = mysqli_prepare($conn, $insert_sql);
                                
                                            if ($stmt_insert) {
                                                mysqli_stmt_bind_param($stmt_insert, "ssss", $admin_username, $admin_password, $admin_name, $status);
                                
                                                if (mysqli_stmt_execute($stmt_insert)) {
                                                    echo '<script>
                                                        Swal.fire({
                                                            position: "center",
                                                            icon: "success",
                                                            title: "เพิ่มข้อมูลสำเร็จ",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        }).then(function() {
                                                            window.location = "admin.php";
                                                        });
                                                    </script>';
                                                } else {
                                                    echo '<script>
                                                        Swal.fire({
                                                            position: "center",
                                                            icon: "error",
                                                            title: "เกิดข้อผิดพลาด",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        }).then(function() {
                                                            window.location = "admin.php";
                                                        });
                                                    </script>';
                                                }
                                
                                                mysqli_stmt_close($stmt_insert);
                                            } else {
                                                echo '<script>
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "error",
                                                        title: "เกิดข้อผิดพลาด",
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    }).then(function() {
                                                        window.location = "admin.php";
                                                    });
                                                </script>';
                                            }
                                        }
                                
                                        mysqli_stmt_close($stmt_check);
                                    } else {
                                        echo '<script>
                                            Swal.fire({
                                                position: "center",
                                                icon: "error",
                                                title: "เกิดข้อผิดพลาด",
                                                showConfirmButton: false,
                                                timer: 1500
                                            }).then(function() {
                                                window.location = "admin.php";
                                            });
                                        </script>';
                                    }
                                } else {
                                    // echo '<script>
                                    //     Swal.fire({
                                    //         position: "center",
                                    //         icon: "error",
                                    //         title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                                    //         showConfirmButton: false,
                                    //         timer: 1500
                                    //     }).then(function() {
                                    //         window.location = "admin.php";
                                    //     });
                                    // </script>';
                                }
                            ?>