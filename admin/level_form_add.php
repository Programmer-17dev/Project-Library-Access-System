<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>เพิ่มข้อมูลระดับ</h1>
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
                                        <label class="col-md-2">ชื่อระดับ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="LevelName" class="form-control" required placeholder="ชื่อระดับ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
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

<!-- เพิ่มข้อมูล -->
<?php 
                                // echo "<pre>";
                                // print_r($_POST);
                                // exit();
                             
                                if (isset($_POST['LevelName'])) {
                                    // รับค่าจากฟอร์ม
                                    $LevelName = $_POST['LevelName'];
                                    
                                    // ตรวจสอบว่ามี LevelName ซ้ำหรือไม่
                                    $check_sql = "SELECT level_ID FROM level WHERE LevelName = ?";
                                    $stmt_check = mysqli_prepare($conn, $check_sql);
                                    
                                    if ($stmt_check) {
                                        mysqli_stmt_bind_param($stmt_check, "s", $LevelName);
                                        mysqli_stmt_execute($stmt_check);
                                        mysqli_stmt_store_result($stmt_check);
                                    
                                        if (mysqli_stmt_num_rows($stmt_check) > 0) {
                                            // หากพบว่ามี LevelName ซ้ำ
                                            echo '<script>
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "ชื่อนี้มีอยู่แล้วในระบบ",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {
                                                    window.location = "level.php";
                                                });
                                            </script>';
                                        } else {
                                            // หากไม่มี LevelName ซ้ำ ทำการเพิ่มข้อมูลใหม่
                                            $insert_sql = "INSERT INTO level (LevelName) VALUES (?)";
                                            $stmt_insert = mysqli_prepare($conn, $insert_sql);
                                    
                                            if ($stmt_insert) {
                                                mysqli_stmt_bind_param($stmt_insert, "s", $LevelName);
                                    
                                                if (mysqli_stmt_execute($stmt_insert)) {
                                                    echo '<script>
                                                        Swal.fire({
                                                            position: "center",
                                                            icon: "success",
                                                            title: "เพิ่มข้อมูลสำเร็จ",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        }).then(function() {
                                                            window.location = "level.php";
                                                        });
                                                    </script>';
                                                } else {
                                                    echo '<script>
                                                        Swal.fire({
                                                            position: "center",
                                                            icon: "error",
                                                            title: "เกิดข้อผิดพลาดในการเพิ่มข้อมูล",
                                                            showConfirmButton: false,
                                                            timer: 1500
                                                        }).then(function() {
                                                            window.location = "level.php";
                                                        });
                                                    </script>';
                                                }
                                    
                                                mysqli_stmt_close($stmt_insert);
                                            } else {
                                                echo '<script>
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "error",
                                                        title: "เกิดข้อผิดพลาดในการเตรียมข้อมูล",
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    }).then(function() {
                                                        window.location = "level.php";
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
                                                title: "เกิดข้อผิดพลาดในการตรวจสอบข้อมูล",
                                                showConfirmButton: false,
                                                timer: 1500
                                            }).then(function() {
                                                window.location = "level.php";
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
                                    //         window.location = "level.php";
                                    //     });
                                    // </script>';
                                }
                                
                                
                                
                            ?>