<?php

// Query สำหรับการดึงข้อมูลการเช็คอินพร้อมกับรายละเอียดผู้ใช้และแบ่งหน้า แสดงใน Table
$sql_checkin_table = "SELECT 
                        checkin.CheckIn_ID,
                        checkin.CheckInTime,
                        checkin.UserID,
                        checkin.FirstName,
                        checkin.LastName,
                        checkin.BranchID,
                        checkin.FacultyID,
                        checkin.Level_ID,
                        branch.BranchName,
                        faculty.FacultyName,
                        level.LevelName
                      FROM 
                        checkin
                      JOIN 
                        branch ON checkin.BranchID = branch.BranchID
                      JOIN 
                        faculty ON checkin.FacultyID = faculty.FacultyID
                      JOIN 
                        level ON checkin.Level_ID = level.Level_ID
                      $where_clause
                      ORDER BY checkin.CheckInTime DESC";

$result_checkin_table = mysqli_query($conn, $sql_checkin_table);

$data_table = [];
while ($row_table = mysqli_fetch_assoc($result_checkin_table)) {
    $data_table[] = $row_table;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ตารางการเข้าใช้บริการ</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-hover table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>รหัสผู้ใช้</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>นามสกุลผู้ใช้</th>
                                        <th>เวลาเข้าใช้บริการ</th>
                                        <th>สาขา</th>
                                        <th>คณะ</th>
                                        <th>ระดับ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?> <!-- ตรวจสอบให้แน่ใจว่ามีค่าเริ่มต้น -->
                                    <?php foreach ($data_table as $row_table) : ?>
                                        <tr>
                                            <td class="text-center" ><?php echo $count++; ?></td>
                                            <td><?php echo isset($row_table['UserID']) ? htmlspecialchars($row_table['UserID']) : ''; ?></td>
                                            <td><?php echo isset($row_table['FirstName']) ? htmlspecialchars($row_table['FirstName']) : ''; ?></td>
                                            <td><?php echo isset($row_table['LastName']) ? htmlspecialchars($row_table['LastName']) : ''; ?></td>
                                            <td width="14%"><?php echo isset($row_table['CheckInTime']) ? htmlspecialchars($row_table['CheckInTime']) : ''; ?></td>
                                            <td width="20%"><?php echo isset($row_table['BranchName']) ? htmlspecialchars($row_table['BranchName']) : ''; ?></td>
                                            <td><?php echo isset($row_table['FacultyName']) ? htmlspecialchars($row_table['FacultyName']) : ''; ?></td>
                                            <td><?php echo isset($row_table['LevelName']) ? htmlspecialchars($row_table['LevelName']) : ''; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->