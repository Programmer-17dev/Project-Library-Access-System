<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>จัดการข้อมูลสมาชิก</h1>
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
            <div class="card-header">
              <a href="member.php?act=add" class=" btn btn-success ">+ เพิ่มข้อมูล</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover table-sm table-striped">
                <thead>
                  <tr>
                    <th>รหัสผู้ใช้</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>นามสกุลผู้ใช้</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สาขา</th>
                    <th>คณะ</th>
                    <th>ระดับ</th>
                    <th>แกไข</th>
                    <th>ลบ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query for fetching user details with a limit of 7 records
                  $sql_checkin_table = "
                                        SELECT 
    u.*, 
    b.BranchName, 
    f.FacultyName, 
    l.LevelName
FROM users u
LEFT JOIN branch b ON u.BranchID = b.BranchID
LEFT JOIN faculty f ON u.FacultyID = f.FacultyID
LEFT JOIN level l ON u.Level_ID = l.Level_ID ";

                  $result_checkin_table = mysqli_query($conn, $sql_checkin_table);
                  while ($row_table = mysqli_fetch_assoc($result_checkin_table)) : ?>
                    <tr>
                      <td width="10%"><?php echo htmlspecialchars($row_table['UserID']); ?></td>
                      <td width="15%"><?php echo htmlspecialchars($row_table['FirstName']); ?></td>
                      <td width="15%"><?php echo htmlspecialchars($row_table['LastName']); ?></td>
                      <td width="5%"><?php echo htmlspecialchars($row_table['phone']); ?></td>
                      <td width="15%"><?php echo htmlspecialchars($row_table['BranchName']); ?></td>
                      <td width="15%"><?php echo htmlspecialchars($row_table['FacultyName']); ?></td>
                      <td width="15%"><?php echo htmlspecialchars($row_table['LevelName']); ?></td>
                      <td class="operator" width="5%">
                        <a href="member.php?id=<?php echo $row_table['id']; ?>&act=edit"
                          class="btn btn-warning">แก้ไข</a>
                      </td>
                      <td class="operator" width="5%">
                        <a href="#" class="btn btn-danger" onclick="confirmDelete(<?php echo $row_table['id']; ?>); return false;">ลบ</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>

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
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'คุณแน่ใจหรือว่าต้องการลบผู้ใช้นี้?',
      text: "การกระทำนี้ไม่สามารถย้อนกลับได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ใช่, ลบเลย!',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to admin.php with delete action
        window.location.href = 'member.php?id=' + id + '&act=delete';
      }
    });
  }
</script>