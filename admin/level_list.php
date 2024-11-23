<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>จัดการข้อมูลระดับ</h1>
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
              <a href="level.php?act=add" class=" btn btn-success ">+ เพิ่มข้อมูล</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover table-sm table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th>ชื่อระดับ</th>
                      <th class="text-center">แก้ไข</th>
                      <th class="text-center">ลบ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Query for fetching user details with a limit of 7 records
                    $sql_checkin_table = "SELECT * From level order by Level_ID desc";

                    $result_checkin_table = mysqli_query($conn, $sql_checkin_table);

                    // $count = 1;
                    while ($row_table = mysqli_fetch_assoc($result_checkin_table)) : ?>
                      <tr>
                        <!-- <td width="5%" class="text-center"><?php echo $count++; ?></td>  -->
                        <td width="5%" class="text-center"><?php echo htmlspecialchars($row_table['Level_ID']); ?></td>
                        <td width="50%"><?php echo htmlspecialchars($row_table['LevelName']); ?></td>
                        <td class="operator " width="5%"><a href="level.php?id=<?=$row_table['Level_ID'];?>&act=edit" class="btn btn-warning">แก้ไข</a></td>
                        <td class="operator" width="5%">
                          <a href="#" class="btn btn-danger" onclick="confirmDelete(<?=$row_table['Level_ID'];?>); return false;">ลบ</a>
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
        // Redirect to level.php with delete action
        window.location.href = 'level.php?id=' + id + '&act=delete';
      }
    });
  }
</script>