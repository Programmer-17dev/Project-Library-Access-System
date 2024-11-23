
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
                            <table id="table_checkin" class="table table-hover table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>รหัสผู้ใช้</th>
                                        <th width="10%" >ชื่อผู้ใช้</th>
                                        <th width="10%" >นามสกุลผู้ใช้</th>
                                        <th>เวลาเข้าใช้บริการ</th>
                                        <th>สาขา</th>
                                        <th width="20%">คณะ</th>
                                        <th width="10%">ระดับ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ข้อมูลจะถูกดึงจาก DataTables -->
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
  $(document).ready(function () {
    $('#table_checkin').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "fetch_users_checkin.php", // ดึงข้อมูลจากไฟล์ fetch_users_checkin.php
        "type": "POST"
      },
      "columns": [
        { "data": null, "render": function(data, type, row, meta) { return meta.row + 1; } },
        { "data": "UserID" },
        { "data": "FirstName" },
        { "data": "LastName" },
        { "data": "CheckInTime" },
        { "data": "BranchName" },
        { "data": "FacultyName" },
        { "data": "LevelName" }
      ],
      
      "language": {
        "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
        "zeroRecords": "ไม่พบข้อมูล",
        "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
        "infoEmpty": "ไม่มีข้อมูล",
        "infoFiltered": "(กรองข้อมูลจากทั้งหมด _MAX_ รายการ)",
        "search": "ค้นหา:",
        "paginate": {
          "next": "ถัดไป",
          "previous": "ก่อนหน้า"
        }
      },
      "dom": 'Bfrltip',  // ส่วนของ dom สำหรับจัดการ layout ปุ่ม
      "lengthMenu": [[10,25, 50, 100, 200], [10,25, 50, 100, 200]], // ตัวเลือก 25, 50, 100, 200
      "buttons": [
        {
          extend: 'excel',
          exportOptions: {
            columns: ':visible' // ส่งออกเฉพาะคอลัมน์ที่มองเห็น
          }
        },
        {
          extend: 'pdf',
          exportOptions: {
            columns: ':visible' // ส่งออกเฉพาะคอลัมน์ที่มองเห็น
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: ':visible' // ส่งออกเฉพาะคอลัมน์ที่มองเห็น
          }
        },
        'colvis' // ปุ่มแสดง/ซ่อนคอลัมน์
      ]
    });
  });
</script>


