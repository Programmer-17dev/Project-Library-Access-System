<style>
  @media print { 
    /* ซ่อนคอลัมน์ "แก้ไข" และ "ลบ" ในหน้าเว็บ */
    .table td:nth-child(8), /* "แก้ไข" */
    .table th:nth-child(8), /* "แก้ไข" */
    .table td:nth-child(9), /* "ลบ" */
    .table th:nth-child(9)  /* "ลบ" */
    {
      display: none;
    }
  }
</style>

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
              <table id="tables" class="table table-hover table-sm table-striped">
                <thead>
                  <tr>
                    <th>รหัสผู้ใช้</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>นามสกุลผู้ใช้</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สาขา</th>
                    <th>คณะ</th>
                    <th>ระดับ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                  </tr>
                </thead>
                <tbody>
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
  $('#tables').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "fetch_users.php", // ดึงข้อมูลจากไฟล์ fetch_users.php
      "type": "POST"
    },
    "columns": [
      { "data": "UserID" },
      { "data": "FirstName" },
      { "data": "LastName" },
      { "data": "phone" },
      { "data": "BranchName" },
      { "data": "FacultyName" },
      { "data": "LevelName" },
      { 
        "data": "edit", 
        "orderable": false, 
        "searchable": false 
      },
      { 
        "data": "delete", 
        "orderable": false, 
        "searchable": false 
      }
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
          columns: ':not(:last-child)' // ไม่รวมคอลัมน์สุดท้าย (ลบ)
        }
      },
      {
        extend: 'pdf',
        exportOptions: {
          columns: ':not(:last-child)' // ไม่รวมคอลัมน์สุดท้าย (ลบ)
        }
      },
      {
        extend: 'print',
        exportOptions: {
          columns: ':not(:last-child)' // ไม่รวมคอลัมน์สุดท้าย (ลบ)
        }
      },
      'colvis' // ปุ่มแสดง/ซ่อนคอลัมน์
    ]
  });
});


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
        window.location.href = 'member.php?id=' + id + '&act=delete';
      }
    });
  }
</script>
