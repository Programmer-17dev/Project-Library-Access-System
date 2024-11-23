<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>จัดการข้อมูลผู้ดูแลระบบ</h1>
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
              <a href="admin.php?act=add" class=" btn btn-success ">+ เพิ่มข้อมูล</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover table-sm table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>ชื่อผู้ใช้</th>
                      <th>รหัสผู้ใช้</th>
                      <th>สังกัดที่อยู่</th>
                      <th class="text-center">รหัส</th>
                      <th class="text-center">แก้ไข</th>
                      <th class="text-center">ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Query for fetching user details with a limit of 7 records
                    $sql_checkin_table = "SELECT * From admin order by admin_id desc LIMIT 7";

                    $result_checkin_table = mysqli_query($conn, $sql_checkin_table);

                    $count = 1;
                    while ($row_table = mysqli_fetch_assoc($result_checkin_table)) : ?>
                      <tr>
                        <td width="5%" class="text-center"><?php echo $count++; ?></td> 
                        <!-- <td width="5%" class="text-center"><?php echo htmlspecialchars($row_table['admin_id']); ?></td> -->
                        <td width="40%"><?php echo htmlspecialchars($row_table['admin_name']); ?></td>
                        <td width="10%"><?php echo htmlspecialchars($row_table['admin_username']); ?></td>
                        <td width="10%"><?php echo $row_table['status'] == 1 ? "ศูนย์ในเมือง" : "ศูนย์สามพร้าว"; ?></td>
                        <td align="center" class="operator" width="10%"> <a href="admin.php?id=<?=$row_table['admin_id'];?>&act=editPwd" class="btn btn-primary">แก้ไขรหัส</a></td>
                        <td class="operator " width="5%"><a href="admin.php?id=<?=$row_table['admin_id'];?>&act=edit" class="btn btn-warning">แก้ไข</a></td>
                        <td class="operator" width="5%">
                          <a href="#" class="btn btn-danger" onclick="confirmDelete(<?=$row_table['admin_id'];?>); return false;">ลบ</a>
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
        window.location.href = 'admin.php?id=' + id + '&act=delete';
      }
    });
  }
</script>