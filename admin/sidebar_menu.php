  <?php
  include 'check_login.php';
  // $admin_name = $_SESSION['admin_name'];

  // สร้างเงื่อนไขฐานข้อมูลตาม $status
  $status = isset($_SESSION['status']) ? $_SESSION['status'] : 1;
  $where_clause = "";
  if ($status == 1) {
    $where_clause = "WHERE status_place = 1";
  } else {
    $where_clause = "WHERE status_place = 2";
  }
  ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../assets/images/UDRU.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
        <?php echo $status == 1 ? "ศูนย์ในเมือง" : "ศูนย์สามพร้าว"; ?>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="" class="nav-link" onclick="confirmMove(); return false;">
              <i class="far fa-address-card nav-icon"></i>
              <p>
                หน้าหลัก
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="checkin.php" class="nav-link">
              <i class="fas fa-table nav-icon"></i>
              <p>การเข้าใช้บริการทั้งหมด</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="checkin_role.php" class="nav-link">
              <i class="fas fa-table nav-icon"></i>
              <p>ข้อมูลการเข้าใช้บริการ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="fas fa-pen nav-icon"></i>
              <p>จัดการข้อมูลผู้ดูแลระบบ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="member.php" class="nav-link">
              <i class="fas fa-pen nav-icon"></i>
              <p>จัดการข้อมูลสมาชิก</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="faculty.php" class="nav-link">
              <i class="fas fa-pen nav-icon"></i>
              <p>จัดการข้อมูลคณะ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="branch.php" class="nav-link">
              <i class="fas fa-pen nav-icon"></i>
              <p>จัดการข้อมูลสาขา</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="level.php" class="nav-link">
              <i class="fas fa-pen nav-icon"></i>
              <p>จัดการข้อมูลระดับ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link" onclick="confirmLogout(); return false;">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                ออกจากระบบ
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <script>
    function confirmMove() {
      Swal.fire({
        title: 'คุณแน่ใจหรือว่าต้องการกลับไปหน้าเข้าใช้บริการ',
        icon: 'question', // แก้ไขจาก 'quastion' เป็น 'question'
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to admin.php with delete action
          window.location.href = '../index_check_list/index.php';
        }
      });
    }

    function confirmLogout() {
      Swal.fire({
        title: 'ต้องการออกจากระบบหรือไม่',
        icon: 'question', // แก้ไขจาก 'quastion' เป็น 'question'
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to admin.php with delete action
          window.location.href = 'logout.php';
        }
      });
    }
  </script>