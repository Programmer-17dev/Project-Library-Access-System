<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>เพิ่มข้อมูลสมาชิก</h1>
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
                                        <label class="col-md-2">รหัสสมาชิก</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="UserID" class="form-control" required placeholder="รหัสสมาชิก">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">คำนำหน้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="Prefix" class="form-control" required placeholder="คำนำหน้า">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">ชื่อ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="FirstName" class="form-control" required placeholder="ชื่อ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="LastName" class="form-control" required placeholder="นามสกุล">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">เบอร์โทรศัพท์</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">คณะ</label>
                                        <div class="col-sm-4">
                                            <select name="FacultyID" id="FacultyID" class="form-control select2" required>
                                                <option value="">-- เลือกคณะ --</option>
                                                <option value="1">คณะครุศาสตร์</option>
                                                <option value="2">คณะพยาบาลศาสตร์</option>
                                                <option value="3">คณะมนุษยศาสตร์และสังคมศาสตร์</option>
                                                <option value="4">คณะวิทยาการจัดการ</option>
                                                <option value="5">คณะวิทยาศาสตร์</option>
                                                <option value="6">คณะเทคโนโลยี</option>
                                                <option value="7">บัณฑิตวิทยาลัย</option>
                                                <option value="8">สำนักส่งเสริมวิชาการและงานทะเบียน</option>
                                                <option value="9">สำนักวิชาศึกษาทั่วไป</option>
                                                <option value="10">บุคคลภายนอก</option>
                                                <option value="11">โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="12">พนักงานมหาวิทยาลัย</option>
                                                <option value="13">อาจารย์</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">ระดับ</label>
                                        <div class="col-sm-4">
                                            <select name="BranchID" id="BranchID" class="form-control select2" required>
                                                <option value="">-- เลือกสาขา --</option>
                                                <option value="1">การเงิน</option>
                                                <option value="2">การจัดการ</option>
                                                <option value="3">การจัดการการท่องเที่ยว</option>
                                                <option value="4">การจัดการการท่องเที่ยวและการบริการ</option>
                                                <option value="5">การจัดการการท่องเที่ยวและอีเวนต์</option>
                                                <option value="6">การจัดการการโรงแรม</option>
                                                <option value="7">การจัดการทรัพยากรธรรมชาติและสิ่งแวดล้อม</option>
                                                <option value="8">การจัดการทั่วไป</option>
                                                <option value="9">การจัดการอสังหาริมทรัพย์และเทคโนโลยีอาคาร</option>
                                                <option value="10">การจัดการอุตสาหกรรม</option>
                                                <option value="11">การตลาด</option>
                                                <option value="12">การตลาด(สหกิจ)</option>
                                                <option value="13">การบริหารการศึกษา</option>
                                                <option value="14">การบริหารทรัพยากรมนุษย์</option>
                                                <option value="15">การบัญชี</option>
                                                <option value="16">การบัญชีบัณฑิต</option>
                                                <option value="17">การประถมศึกษา</option>
                                                <option value="18">การพัฒนาสังคม</option>
                                                <option value="19">การแพทย์แผนไทย</option>
                                                <option value="20">การเรียนล่วงหน้าเพื่อสะสมหน่วยกิต</option>
                                                <option value="21">การวิจัยและประเมินผล</option>
                                                <option value="22">การวิจัยและประเมินผลการศึกษา</option>
                                                <option value="23">การศึกษาปฐมวัย</option>
                                                <option value="24">การศึกษาพิเศษ</option>
                                                <option value="25">การสอนภาษาจีน</option>
                                                <option value="26">การสอนภาษาอังกฤษสำหรับผู้พูดภาษาอื่น</option>
                                                <option value="27">การสอนวิทยาศาสตร์(เคมี)</option>
                                                <option value="28">การสอนวิทยาศาสตร์(ชีววิทยา)</option>
                                                <option value="29">การสอนวิทยาศาสตร์(ฟิสิกส์)</option>
                                                <option value="30">การสื่อสารการตลาด</option>
                                                <option value="31">เกษตรศาสตร์</option>
                                                <option value="32">คณิตศาสตร์</option>
                                                <option value="33">คณิตศาสตรศึกษา</option>
                                                <option value="34">คอมพิวเตอร์ธุรกิจ</option>
                                                <option value="35">คอมพิวเตอร์ศึกษา</option>
                                                <option value="36">เคมี(เคมี)</option>
                                                <option value="37">เคมี(เคมีอุตสาหกรรม)</option>
                                                <option value="38">เคมี(เน้นสหวิทยาการเคมี)</option>
                                                <option value="39">เคมี(อุตสาหกรรมเคมี)</option>
                                                <option value="40">เครื่องกล</option>
                                                <option value="41">ชีววิทยา(จุลชีววิทยา)</option>
                                                <option value="42">ชีววิทยา(ชีววิทยาทั่วไป)</option>
                                                <option value="43">ดนตรี</option>
                                                <option value="44">ดนตรีศึกษา</option>
                                                <option value="45">ทัศนศิลป์</option>
                                                <option value="46">ทัศนศิลป์(แขนงทัศนศิลป์)</option>
                                                <option value="47">ทัศนศิลป์(แขนงออกแบบนิเทศศิลป์)</option>
                                                <option value="48">ทัศนศิลป์และการออกแบบ(แขนงทัศนศิลป์)</option>
                                                <option value="49">ทัศนศิลป์และการออกแบบ(แขนงออกแบบนิเทศศิลป์)</option>
                                                <option value="50">เทคนิคการสัตวแพทย์</option>
                                                <option value="51">เทคนิคการสัตวแพทย์และการพยาบาลสัตว์</option>
                                                <option value="52">เทคโนโลยีการผลิตสัตว์</option>
                                                <option value="53">เทคโนโลยีการสื่อสาร</option>
                                                <option value="54">เทคโนโลยีชีวภาพ</option>
                                                <option value="55">เทคโนโลยีและนวัตกรรมการผลิตพืช</option>
                                                <option value="56">เทคโนโลยีสารสนเทศ</option>
                                                <option value="57">เทคโนโลยีอาหารและโภชนาการ</option>
                                                <option value="58">ธุรกิจการเกษตร</option>
                                                <option value="59">นาฏศิลป์ศึกษา</option>
                                                <option value="60">นิติศาสตร์</option>
                                                <option value="61">นิเทศศาสตร์(การประชาสัมพันธ์และสื่อสารองค์กร)</option>
                                                <option value="62">นิเทศศาสตร์(การประชาสัมพันธ์และสื่อองค์กร)</option>
                                                <option value="63">นิเทศศาสตร์(เน้นการประชาสัมพันธ์)</option>
                                                <option value="64">นิเทศศาสตร์(เน้นวารสารสนเทศ)</option>
                                                <option value="65">นิเทศศาสตร์(เน้นวิทยุกระจายเสียงและวิทยุโทรทัศน์)</option>
                                                <option value="66">นิเทศศาสตร์(วารสารสนเทศและสื่อใหม่)</option>
                                                <option value="67">นิเทศศาสตร์(วิทยุกระจายเสียงและวิทยุโทรทัศน์ดิจิตอล)</option>
                                                <option value="68">นิเทศศาสตร์(วิทยุและโทรทัศน์ดิจิตอล)</option>
                                                <option value="69">บริหารธุรกิจบัณฑิต</option>
                                                <option value="70">บริหารธุรกิจบัณฑิต(แขนงนวัตกรรมการสื่อสารเพื่อธุรกิจ)</option>
                                                <option value="71">บริหารธุรกิจบัณฑิต(แขนงระบบสารสนเทศและคอมพิวเตอร์ธุรกิจ)</option>
                                                <option value="72">บริหารธุรกิจมหาบัณฑิต</option>
                                                <option value="73">บัญชีบัณฑิต</option>
                                                <option value="74">พยาบาลศาสตรบัณฑิต</option>
                                                <option value="75">พระพุทธศาสนา</option>
                                                <option value="76">พลศึกษาและสุขศึกษา</option>
                                                <option value="77">พุทธศาสนศึกษา</option>
                                                <option value="78">ฟิสิกส์</option>
                                                <option value="79">ภาษาจีน</option>
                                                <option value="80">ภาษาไทย</option>
                                                <option value="81">ภาษาไทยเพื่อการสื่อสาร</option>
                                                <option value="82">ภาษาเวียดนามและภาษาอังกฤษ</option>
                                                <option value="83">ภาษาอังกฤษ</option>
                                                <option value="84">ภาษาอังกฤษธุรกิจ</option>
                                                <option value="85">ภาษาอังกฤษธุรกิจ(หลักสูตรนานาชาติ)</option>
                                                <option value="86">ภูมิสารสนเทศเพื่อการพัฒนา</option>
                                                <option value="87">ยุทธศาสตร์การพัฒนา</option>
                                                <option value="88">โยธาสถาปัตยกรรม</option>
                                                <option value="89">รัฐประศาสนศาสตร์</option>
                                                <option value="90">รัฐประศาสนศาสตรมหาบัณฑิต</option>
                                                <option value="91">รัฐประสาสนศาสตร์</option>
                                                <option value="92">วิทยาการข้อมูลและเทคโนโลยีสารสนเทศ</option>
                                                <option value="93">วิทยาการคอมพิวเตอร์</option>
                                                <option value="94">วิทยาศาสตร์</option>
                                                <option value="95">วิทยาศาสตร์(เคมี)</option>
                                                <option value="96">วิทยาศาสตร์(เน้นฟิสิกส์)</option>
                                                <option value="97">วิทยาศาสตร์(ฟิสิกส์)</option>
                                                <option value="98">วิทยาศาสตร์การกีฬา</option>
                                                <option value="99">วิทยาศาสตร์ทั่วไปและเคมี</option>
                                                <option value="100">วิทยาศาสตร์ทั่วไปและชีววิทยา</option>
                                                <option value="101">วิทยาศาสตร์ทั่วไปและฟิสิกส์</option>
                                                <option value="102">วิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                                                <option value="103">วิทยาศาสตร์ศึกษา</option>
                                                <option value="104">วิทยาศาสตร์ศึกษา(เคมี)</option>
                                                <option value="105">วิทยาศาสตร์ศึกษา(ชีววิทยา)</option>
                                                <option value="106">วิทยาศาสตร์ศึกษา(ฟิสิกส์)</option>
                                                <option value="107">วิทยาศาสตร์สิ่งแวดล้อม</option>
                                                <option value="108">วิศวกรรมคอมพิวเตอร์และการสื่อสาร</option>
                                                <option value="109">วิศวกรรมเครื่องกล</option>
                                                <option value="110">วิศวกรรมพลังงาน</option>
                                                <option value="111">วิศวกรรมไฟฟ้า</option>
                                                <option value="112">วิศวกรรมแมคคาทรอนิกส์และหุ่นยนต์</option>
                                                <option value="113">วิศวกรรมหุ่นยนต์และระบบอัตโนมัติ</option>
                                                <option value="114">วิศวกรรมอิเล็กทรอนิกส์และระบบอัตโนมัติ</option>
                                                <option value="115">ศิลปกรรมพื้นถิ่น</option>
                                                <option value="116">ศิลปศึกษา</option>
                                                <option value="117">ศิลปะการแสดง</option>
                                                <option value="118">ศิลปะการแสดง(การแสดงพื้นบ้านอีสาน)</option>
                                                <option value="119">ศิลปะอีสาน</option>
                                                <option value="120">เศรษฐกิจดิจิทัล</option>
                                                <option value="121">เศรษฐศาสตร์ธุรกิจ</option>
                                                <option value="122">สหวิทยาการเพื่อการพัฒนา</option>
                                                <option value="123">สังคมศึกษา</option>
                                                <option value="124">สัตวศาสตร์</option>
                                                <option value="125">สาธารณสุขศาสตร์</option>
                                                <option value="126">สาธารณสุขศาสตรมหาบัณฑิต</option>
                                                <option value="127">สารสนเทศศาสตร์</option>
                                                <option value="128">สารสนเทศศาสตร์และบรรณารักษศาสตร์์</option>
                                                <option value="129">หลักสูตรและการเรียนการสอน</option>
                                                <option value="130">หลักสูตรและการสอน</option>
                                                <option value="131">ออกแบบผลิตภัณฑ์(เน้นคอมพิวเตอร์กราฟิก)</option>
                                                <option value="132">ออกแบบผลิตภัณฑ์(เน้นออกแบบแฟชั่น)</option>
                                                <option value="133">อาชีวอนามัยและความปลอดภัย</option>
                                                <option value="134">อาหารและบริการ</option>
                                                <option value="135">อิเล็กทรอนิกส์อัจฉริยะและยานยนต์ไฟฟ้า</option>
                                                <option value="136">บุคคลภายนอก</option>
                                                <option value="137">โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="138">พนักงานมหาวิทยาลัย</option>
                                                <option value="139">อาจารย์</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">ระดับ</label>
                                        <div class="col-sm-4">
                                            <select name="Level_ID" id="Level_ID" class="form-control select2" required>
                                                <option value="">-- เลือกระดับการศึกษา --</option>
                                                <option value="1">ปริญญาตรี</option>
                                                <option value="2">ปริญญาโท</option>
                                                <option value="3">ปริญญาเอก</option>
                                                <option value="4">พนักงานมหาวิทยาลัย</option>
                                                <option value="5">อาจารย์</option>
                                                <option value="6">บุคคลภายนอก</option>
                                                <option value="7">โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="8">ไม่มีบัตร</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                                            <a href="member.php" class="btn btn-danger">ยกเลิก</a>
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

if (
   
    isset($_POST['Prefix']) && 
    isset($_POST['UserID']) && 
    isset($_POST['FirstName']) && 
    isset($_POST['LastName']) && 
    isset($_POST['FacultyID']) && 
    isset($_POST['BranchID']) && 
    isset($_POST['Level_ID']) && 
    isset($_POST['phone']) // เพิ่มการตรวจสอบ phone
) {
    // รับค่าจากฟอร์ม
    $prefix = $_POST['Prefix'];
    $UserID = $_POST['UserID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $facultyID = $_POST['FacultyID'];
    $branchID = $_POST['BranchID'];
    $levelID = $_POST['Level_ID'];
    $phone = $_POST['phone'];

    // ตรวจสอบว่ามี UserID ซ้ำหรือไม่
    $check_sql = "SELECT id FROM users WHERE UserID = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);

    if ($stmt_check) {
        mysqli_stmt_bind_param($stmt_check, "s", $UserID);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            // มี UserID ซ้ำ
            echo '<script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "มีผู้ใช้นี้ในระบบแล้ว",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = "member.php?act=add";
            });
            </script>';
        } else {
            // เตรียม SQL สำหรับการเพิ่มข้อมูล
            $insert_sql = "INSERT INTO users (UserID, Prefix, FirstName, LastName, phone, BranchID, FacultyID, Level_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $insert_sql);

            // ตรวจสอบว่าการเตรียม statement สำเร็จหรือไม่
            if ($stmt_insert) {
                // ผูกค่าจากฟอร์มเข้ากับ statement
                mysqli_stmt_bind_param($stmt_insert, "ssssssss", $UserID, $prefix, $FirstName, $LastName, $phone, $branchID, $facultyID, $levelID);

                // ดำเนินการคำสั่ง SQL
                if (mysqli_stmt_execute($stmt_insert)) {
                    echo '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "เพิ่มข้อมูลสำเร็จ",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = "member.php";
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
                        window.location = "member.php";
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
                    window.location = "member.php";
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
            window.location = "member.php";
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
    //         window.location = "member.php";
    //     });
    // </script>';
}


?>