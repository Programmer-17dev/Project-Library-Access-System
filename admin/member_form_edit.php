<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {


    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");

    // ผูกพารามิเตอร์และประมวลผลคำสั่ง SQL
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Debug: แสดงค่าที่ดึงมาจากฐานข้อมูล
    // echo '<pre>';
    // print_r($row);
    // exit();


    // exit();
    // ถ้าไม่มีข้อมูล ให้กลับไปหน้า index
    if ($result->num_rows != 1) {

        exit();
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>แก้ไขข้อมูลสมาชิก</h1>
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
                                            <input type="text" name="UserID" class="form-control" required placeholder="รหัสสมาชิก" value="<?php echo $row['UserID']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">คำนำหน้า</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="Prefix" class="form-control" required placeholder="คำนำหน้า" value="<?php echo $row['Prefix']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">ชื่อ</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="FirstName" class="form-control" required placeholder="ชื่อ" value="<?php echo $row['FirstName']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="LastName" class="form-control" required placeholder="นามสกุล" value="<?php echo $row['LastName']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">เบอร์โทรศัพท์</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์" value="<?php echo $row['phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">คณะ</label>
                                        <div class="col-sm-4">
                                            <select name="FacultyID" id="FacultyID" class="form-control select2" required>
                                                <option value="">-- เลือกคณะ --</option>
                                                <option value="1" <?php echo ($row['FacultyID'] == '1') ? 'selected' : ''; ?>>คณะครุศาสตร์</option>
                                                <option value="2" <?php echo ($row['FacultyID'] == '2') ? 'selected' : ''; ?>>คณะพยาบาลศาสตร์</option>
                                                <option value="3" <?php echo ($row['FacultyID'] == '3') ? 'selected' : ''; ?>>คณะมนุษยศาสตร์และสังคมศาสตร์</option>
                                                <option value="4" <?php echo ($row['FacultyID'] == '4') ? 'selected' : ''; ?>>คณะวิทยาการจัดการ</option>
                                                <option value="5" <?php echo ($row['FacultyID'] == '5') ? 'selected' : ''; ?>>คณะวิทยาศาสตร์</option>
                                                <option value="6" <?php echo ($row['FacultyID'] == '6') ? 'selected' : ''; ?>>คณะเทคโนโลยี</option>
                                                <option value="7" <?php echo ($row['FacultyID'] == '7') ? 'selected' : ''; ?>>บัณฑิตวิทยาลัย</option>
                                                <option value="8" <?php echo ($row['FacultyID'] == '8') ? 'selected' : ''; ?>>สำนักส่งเสริมวิชาการและงานทะเบียน</option>
                                                <option value="9" <?php echo ($row['FacultyID'] == '9') ? 'selected' : ''; ?>>สำนักวิชาศึกษาทั่วไป</option>
                                                <option value="10" <?php echo ($row['FacultyID'] == '10') ? 'selected' : ''; ?>>บุคคลภายนอก</option>
                                                <option value="11" <?php echo ($row['FacultyID'] == '11') ? 'selected' : ''; ?>>โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="12" <?php echo ($row['FacultyID'] == '12') ? 'selected' : ''; ?>>พนักงานมหาวิทยาลัย</option>
                                                <option value="13" <?php echo ($row['FacultyID'] == '13') ? 'selected' : ''; ?>>อาจารย์</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">สาขา</label>
                                        <div class="col-sm-4">
                                            <select name="BranchID" id="BranchID" class="form-control select2" required>
                                                <option value="">-- เลือกสาขา --</option>
                                                <option value="1" <?php echo ($row['BranchID'] == '1') ? 'selected' : ''; ?>>การเงิน</option>
                                                <option value="2" <?php echo ($row['BranchID'] == '2') ? 'selected' : ''; ?>>การจัดการ</option>
                                                <option value="3" <?php echo ($row['BranchID'] == '3') ? 'selected' : ''; ?>>การจัดการการท่องเที่ยว</option>
                                                <option value="4" <?php echo ($row['BranchID'] == '4') ? 'selected' : ''; ?>>การจัดการการท่องเที่ยวและการบริการ</option>
                                                <option value="5" <?php echo ($row['BranchID'] == '5') ? 'selected' : ''; ?>>การจัดการการท่องเที่ยวและอีเวนต์</option>
                                                <option value="6" <?php echo ($row['BranchID'] == '6') ? 'selected' : ''; ?>>การจัดการการโรงแรม</option>
                                                <option value="7" <?php echo ($row['BranchID'] == '7') ? 'selected' : ''; ?>>การจัดการทรัพยากรธรรมชาติและสิ่งแวดล้อม</option>
                                                <option value="8" <?php echo ($row['BranchID'] == '8') ? 'selected' : ''; ?>>การจัดการทั่วไป</option>
                                                <option value="9" <?php echo ($row['BranchID'] == '9') ? 'selected' : ''; ?>>การจัดการอสังหาริมทรัพย์และเทคโนโลยีอาคาร</option>
                                                <option value="10" <?php echo ($row['BranchID'] == '10') ? 'selected' : ''; ?>>การจัดการอุตสาหกรรม</option>
                                                <option value="11" <?php echo ($row['BranchID'] == '11') ? 'selected' : ''; ?>>การตลาด</option>
                                                <option value="12" <?php echo ($row['BranchID'] == '12') ? 'selected' : ''; ?>>การตลาด(สหกิจ)</option>
                                                <option value="13" <?php echo ($row['BranchID'] == '13') ? 'selected' : ''; ?>>การบริหารการศึกษา</option>
                                                <option value="14" <?php echo ($row['BranchID'] == '14') ? 'selected' : ''; ?>>การบริหารทรัพยากรมนุษย์</option>
                                                <option value="15" <?php echo ($row['BranchID'] == '15') ? 'selected' : ''; ?>>การบัญชี</option>
                                                <option value="16" <?php echo ($row['BranchID'] == '16') ? 'selected' : ''; ?>>การบัญชีบัณฑิต</option>
                                                <option value="17" <?php echo ($row['BranchID'] == '17') ? 'selected' : ''; ?>>การประถมศึกษา</option>
                                                <option value="18" <?php echo ($row['BranchID'] == '18') ? 'selected' : ''; ?>>การพัฒนาสังคม</option>
                                                <option value="19" <?php echo ($row['BranchID'] == '19') ? 'selected' : ''; ?>>การแพทย์แผนไทย</option>
                                                <option value="20" <?php echo ($row['BranchID'] == '20') ? 'selected' : ''; ?>>การเรียนล่วงหน้าเพื่อสะสมหน่วยกิต</option>
                                                <option value="21" <?php echo ($row['BranchID'] == '21') ? 'selected' : ''; ?>>การวิจัยและประเมินผล</option>
                                                <option value="22" <?php echo ($row['BranchID'] == '22') ? 'selected' : ''; ?>>การวิจัยและประเมินผลการศึกษา</option>
                                                <option value="23" <?php echo ($row['BranchID'] == '23') ? 'selected' : ''; ?>>การศึกษาปฐมวัย</option>
                                                <option value="24" <?php echo ($row['BranchID'] == '24') ? 'selected' : ''; ?>>การศึกษาพิเศษ</option>
                                                <option value="25" <?php echo ($row['BranchID'] == '25') ? 'selected' : ''; ?>>การสอนภาษาจีน</option>
                                                <option value="26" <?php echo ($row['BranchID'] == '26') ? 'selected' : ''; ?>>การสอนภาษาอังกฤษสำหรับผู้พูดภาษาอื่น</option>
                                                <option value="27" <?php echo ($row['BranchID'] == '27') ? 'selected' : ''; ?>>การสอนวิทยาศาสตร์(เคมี)</option>
                                                <option value="28" <?php echo ($row['BranchID'] == '28') ? 'selected' : ''; ?>>การสอนวิทยาศาสตร์(ชีววิทยา)</option>
                                                <option value="29" <?php echo ($row['BranchID'] == '29') ? 'selected' : ''; ?>>การสอนวิทยาศาสตร์(ฟิสิกส์)</option>
                                                <option value="30" <?php echo ($row['BranchID'] == '30') ? 'selected' : ''; ?>>การสื่อสารการตลาด</option>
                                                <option value="31" <?php echo ($row['BranchID'] == '31') ? 'selected' : ''; ?>>เกษตรศาสตร์</option>
                                                <option value="32" <?php echo ($row['BranchID'] == '32') ? 'selected' : ''; ?>>คณิตศาสตร์</option>
                                                <option value="33" <?php echo ($row['BranchID'] == '33') ? 'selected' : ''; ?>>คณิตศาสตรศึกษา</option>
                                                <option value="34" <?php echo ($row['BranchID'] == '34') ? 'selected' : ''; ?>>คอมพิวเตอร์ธุรกิจ</option>
                                                <option value="35" <?php echo ($row['BranchID'] == '35') ? 'selected' : ''; ?>>คอมพิวเตอร์ศึกษา</option>
                                                <option value="36" <?php echo ($row['BranchID'] == '36') ? 'selected' : ''; ?>>เคมี(เคมี)</option>
                                                <option value="37" <?php echo ($row['BranchID'] == '37') ? 'selected' : ''; ?>>เคมี(เคมีอุตสาหกรรม)</option>
                                                <option value="38" <?php echo ($row['BranchID'] == '38') ? 'selected' : ''; ?>>เคมี(เน้นสหวิทยาการเคมี)</option>
                                                <option value="39" <?php echo ($row['BranchID'] == '39') ? 'selected' : ''; ?>>เคมี(อุตสาหกรรมเคมี)</option>
                                                <option value="40" <?php echo ($row['BranchID'] == '40') ? 'selected' : ''; ?>>เครื่องกล</option>
                                                <option value="41" <?php echo ($row['BranchID'] == '41') ? 'selected' : ''; ?>>ชีววิทยา(จุลชีววิทยา)</option>
                                                <option value="42" <?php echo ($row['BranchID'] == '42') ? 'selected' : ''; ?>>ชีววิทยา(ชีววิทยาทั่วไป)</option>
                                                <option value="43" <?php echo ($row['BranchID'] == '43') ? 'selected' : ''; ?>>ดนตรี</option>
                                                <option value="44" <?php echo ($row['BranchID'] == '44') ? 'selected' : ''; ?>>ดนตรีศึกษา</option>
                                                <option value="45" <?php echo ($row['BranchID'] == '45') ? 'selected' : ''; ?>>ทัศนศิลป์</option>
                                                <option value="46" <?php echo ($row['BranchID'] == '46') ? 'selected' : ''; ?>>ทัศนศิลป์(แขนงทัศนศิลป์)</option>
                                                <option value="47" <?php echo ($row['BranchID'] == '47') ? 'selected' : ''; ?>>ทัศนศิลป์(แขนงออกแบบนิเทศศิลป์)</option>
                                                <option value="48" <?php echo ($row['BranchID'] == '48') ? 'selected' : ''; ?>>ทัศนศิลป์และการออกแบบ(แขนงทัศนศิลป์)</option>
                                                <option value="49" <?php echo ($row['BranchID'] == '49') ? 'selected' : ''; ?>>ทัศนศิลป์และการออกแบบ(แขนงออกแบบนิเทศศิลป์)</option>
                                                <option value="50" <?php echo ($row['BranchID'] == '50') ? 'selected' : ''; ?>>เทคนิคการสัตวแพทย์</option>
                                                <option value="51" <?php echo ($row['BranchID'] == '51') ? 'selected' : ''; ?>>เทคนิคการสัตวแพทย์และการพยาบาลสัตว์</option>
                                                <option value="52" <?php echo ($row['BranchID'] == '52') ? 'selected' : ''; ?>>เทคโนโลยีการผลิตสัตว์</option>
                                                <option value="53" <?php echo ($row['BranchID'] == '53') ? 'selected' : ''; ?>>เทคโนโลยีการสื่อสาร</option>
                                                <option value="54" <?php echo ($row['BranchID'] == '54') ? 'selected' : ''; ?>>เทคโนโลยีชีวภาพ</option>
                                                <option value="55" <?php echo ($row['BranchID'] == '55') ? 'selected' : ''; ?>>เทคโนโลยีและนวัตกรรมการผลิตพืช</option>
                                                <option value="56" <?php echo ($row['BranchID'] == '56') ? 'selected' : ''; ?>>เทคโนโลยีสารสนเทศ</option>
                                                <option value="57" <?php echo ($row['BranchID'] == '57') ? 'selected' : ''; ?>>เทคโนโลยีอาหารและโภชนาการ</option>
                                                <option value="58" <?php echo ($row['BranchID'] == '58') ? 'selected' : ''; ?>>ธุรกิจการเกษตร</option>
                                                <option value="59" <?php echo ($row['BranchID'] == '59') ? 'selected' : ''; ?>>นาฏศิลป์ศึกษา</option>
                                                <option value="60" <?php echo ($row['BranchID'] == '60') ? 'selected' : ''; ?>>นิติศาสตร์</option>
                                                <option value="61" <?php echo ($row['BranchID'] == '61') ? 'selected' : ''; ?>>นิเทศศาสตร์(การประชาสัมพันธ์และสื่อสารองค์กร)</option>
                                                <option value="62" <?php echo ($row['BranchID'] == '62') ? 'selected' : ''; ?>>นิเทศศาสตร์(การประชาสัมพันธ์และสื่อองค์กร)</option>
                                                <option value="63" <?php echo ($row['BranchID'] == '63') ? 'selected' : ''; ?>>นิเทศศาสตร์(เน้นการประชาสัมพันธ์)</option>
                                                <option value="64" <?php echo ($row['BranchID'] == '64') ? 'selected' : ''; ?>>นิเทศศาสตร์(เน้นวารสารสนเทศ)</option>
                                                <option value="65" <?php echo ($row['BranchID'] == '65') ? 'selected' : ''; ?>>นิเทศศาสตร์(เน้นวิทยุกระจายเสียงและวิทยุโทรทัศน์)</option>
                                                <option value="66" <?php echo ($row['BranchID'] == '66') ? 'selected' : ''; ?>>นิเทศศาสตร์(วารสารสนเทศและสื่อใหม่)</option>
                                                <option value="67" <?php echo ($row['BranchID'] == '67') ? 'selected' : ''; ?>>นิเทศศาสตร์(วิทยุกระจายเสียงและวิทยุโทรทัศน์ดิจิตอล)</option>
                                                <option value="68" <?php echo ($row['BranchID'] == '68') ? 'selected' : ''; ?>>นิเทศศาสตร์(วิทยุและโทรทัศน์ดิจิตอล)</option>
                                                <option value="69" <?php echo ($row['BranchID'] == '69') ? 'selected' : ''; ?>>บริหารธุรกิจบัณฑิต</option>
                                                <option value="70" <?php echo ($row['BranchID'] == '70') ? 'selected' : ''; ?>>บริหารธุรกิจบัณฑิต(แขนงนวัตกรรมการสื่อสารเพื่อธุรกิจ)</option>
                                                <option value="71" <?php echo ($row['BranchID'] == '71') ? 'selected' : ''; ?>>บริหารธุรกิจบัณฑิต(แขนงระบบสารสนเทศและคอมพิวเตอร์ธุรกิจ)</option>
                                                <option value="72" <?php echo ($row['BranchID'] == '72') ? 'selected' : ''; ?>>บริหารธุรกิจมหาบัณฑิต</option>
                                                <option value="73" <?php echo ($row['BranchID'] == '73') ? 'selected' : ''; ?>>บัญชีบัณฑิต</option>
                                                <option value="74" <?php echo ($row['BranchID'] == '74') ? 'selected' : ''; ?>>พยาบาลศาสตรบัณฑิต</option>
                                                <option value="75" <?php echo ($row['BranchID'] == '75') ? 'selected' : ''; ?>>พระพุทธศาสนา</option>
                                                <option value="76" <?php echo ($row['BranchID'] == '76') ? 'selected' : ''; ?>>พลศึกษาและสุขศึกษา</option>
                                                <option value="77" <?php echo ($row['BranchID'] == '77') ? 'selected' : ''; ?>>พุทธศาสนศึกษา</option>
                                                <option value="78" <?php echo ($row['BranchID'] == '78') ? 'selected' : ''; ?>>ฟิสิกส์</option>
                                                <option value="79" <?php echo ($row['BranchID'] == '79') ? 'selected' : ''; ?>>ภาษาจีน</option>
                                                <option value="80" <?php echo ($row['BranchID'] == '80') ? 'selected' : ''; ?>>ภาษาไทย</option>
                                                <option value="81" <?php echo ($row['BranchID'] == '81') ? 'selected' : ''; ?>>ภาษาไทยเพื่อการสื่อสาร</option>
                                                <option value="82" <?php echo ($row['BranchID'] == '82') ? 'selected' : ''; ?>>ภาษาเวียดนามและภาษาอังกฤษ</option>
                                                <option value="83" <?php echo ($row['BranchID'] == '83') ? 'selected' : ''; ?>>ภาษาอังกฤษ</option>
                                                <option value="84" <?php echo ($row['BranchID'] == '84') ? 'selected' : ''; ?>>ภาษาอังกฤษธุรกิจ</option>
                                                <option value="85" <?php echo ($row['BranchID'] == '85') ? 'selected' : ''; ?>>ภาษาอังกฤษธุรกิจ(หลักสูตรนานาชาติ)</option>
                                                <option value="86" <?php echo ($row['BranchID'] == '86') ? 'selected' : ''; ?>>ภูมิสารสนเทศเพื่อการพัฒนา</option>
                                                <option value="87" <?php echo ($row['BranchID'] == '87') ? 'selected' : ''; ?>>ยุทธศาสตร์การพัฒนา</option>
                                                <option value="88" <?php echo ($row['BranchID'] == '88') ? 'selected' : ''; ?>>โยธาสถาปัตยกรรม</option>
                                                <option value="89" <?php echo ($row['BranchID'] == '89') ? 'selected' : ''; ?>>รัฐประศาสนศาสตร์</option>
                                                <option value="90" <?php echo ($row['BranchID'] == '90') ? 'selected' : ''; ?>>รัฐประศาสนศาสตรมหาบัณฑิต</option>
                                                <option value="91" <?php echo ($row['BranchID'] == '91') ? 'selected' : ''; ?>>รัฐประสาสนศาสตร์</option>
                                                <option value="92" <?php echo ($row['BranchID'] == '92') ? 'selected' : ''; ?>>วิทยาการข้อมูลและเทคโนโลยีสารสนเทศ</option>
                                                <option value="93" <?php echo ($row['BranchID'] == '93') ? 'selected' : ''; ?>>วิทยาการคอมพิวเตอร์</option>
                                                <option value="94" <?php echo ($row['BranchID'] == '94') ? 'selected' : ''; ?>>วิทยาศาสตร์</option>
                                                <option value="95" <?php echo ($row['BranchID'] == '95') ? 'selected' : ''; ?>>วิทยาศาสตร์(เคมี)</option>
                                                <option value="96" <?php echo ($row['BranchID'] == '96') ? 'selected' : ''; ?>>วิทยาศาสตร์(เน้นฟิสิกส์)</option>
                                                <option value="97" <?php echo ($row['BranchID'] == '97') ? 'selected' : ''; ?>>วิทยาศาสตร์(ฟิสิกส์)</option>
                                                <option value="98" <?php echo ($row['BranchID'] == '98') ? 'selected' : ''; ?>>วิทยาศาสตร์การกีฬา</option>
                                                <option value="99" <?php echo ($row['BranchID'] == '99') ? 'selected' : ''; ?>>วิทยาศาสตร์ทั่วไปและเคมี</option>
                                                <option value="100" <?php echo ($row['BranchID'] == '100') ? 'selected' : ''; ?>>วิทยาศาสตร์ทั่วไปและชีววิทยา</option>
                                                <option value="101" <?php echo ($row['BranchID'] == '101') ? 'selected' : ''; ?>>วิทยาศาสตร์ทั่วไปและฟิสิกส์</option>
                                                <option value="102" <?php echo ($row['BranchID'] == '102') ? 'selected' : ''; ?>>วิทยาศาสตร์และเทคโนโลยีการอาหาร</option>
                                                <option value="103" <?php echo ($row['BranchID'] == '103') ? 'selected' : ''; ?>>วิทยาศาสตร์ศึกษา</option>
                                                <option value="104" <?php echo ($row['BranchID'] == '104') ? 'selected' : ''; ?>>วิทยาศาสตร์ศึกษา(เคมี)</option>
                                                <option value="105" <?php echo ($row['BranchID'] == '105') ? 'selected' : ''; ?>>วิทยาศาสตร์ศึกษา(ชีววิทยา)</option>
                                                <option value="106" <?php echo ($row['BranchID'] == '106') ? 'selected' : ''; ?>>วิทยาศาสตร์ศึกษา(ฟิสิกส์)</option>
                                                <option value="107" <?php echo ($row['BranchID'] == '107') ? 'selected' : ''; ?>>วิทยาศาสตร์สิ่งแวดล้อม</option>
                                                <option value="108" <?php echo ($row['BranchID'] == '108') ? 'selected' : ''; ?>>วิศวกรรมคอมพิวเตอร์และการสื่อสาร</option>
                                                <option value="109" <?php echo ($row['BranchID'] == '109') ? 'selected' : ''; ?>>วิศวกรรมเครื่องกล</option>
                                                <option value="110" <?php echo ($row['BranchID'] == '110') ? 'selected' : ''; ?>>วิศวกรรมพลังงาน</option>
                                                <option value="111" <?php echo ($row['BranchID'] == '111') ? 'selected' : ''; ?>>วิศวกรรมไฟฟ้า</option>
                                                <option value="112" <?php echo ($row['BranchID'] == '112') ? 'selected' : ''; ?>>วิศวกรรมแมคคาทรอนิกส์และหุ่นยนต์</option>
                                                <option value="113" <?php echo ($row['BranchID'] == '113') ? 'selected' : ''; ?>>วิศวกรรมหุ่นยนต์และระบบอัตโนมัติ</option>
                                                <option value="114" <?php echo ($row['BranchID'] == '114') ? 'selected' : ''; ?>>วิศวกรรมอิเล็กทรอนิกส์และระบบอัตโนมัติ</option>
                                                <option value="115" <?php echo ($row['BranchID'] == '115') ? 'selected' : ''; ?>>ศิลปกรรมพื้นถิ่น</option>
                                                <option value="116" <?php echo ($row['BranchID'] == '116') ? 'selected' : ''; ?>>ศิลปศึกษา</option>
                                                <option value="117" <?php echo ($row['BranchID'] == '117') ? 'selected' : ''; ?>>ศิลปะการแสดง</option>
                                                <option value="118" <?php echo ($row['BranchID'] == '118') ? 'selected' : ''; ?>>ศิลปะการแสดง(การแสดงพื้นบ้านอีสาน)</option>
                                                <option value="119" <?php echo ($row['BranchID'] == '119') ? 'selected' : ''; ?>>ศิลปะอีสาน</option>
                                                <option value="120" <?php echo ($row['BranchID'] == '120') ? 'selected' : ''; ?>>เศรษฐกิจดิจิทัล</option>
                                                <option value="121" <?php echo ($row['BranchID'] == '121') ? 'selected' : ''; ?>>เศรษฐศาสตร์ธุรกิจ</option>
                                                <option value="122" <?php echo ($row['BranchID'] == '122') ? 'selected' : ''; ?>>สหวิทยาการเพื่อการพัฒนา</option>
                                                <option value="123" <?php echo ($row['BranchID'] == '123') ? 'selected' : ''; ?>>สังคมศึกษา</option>
                                                <option value="124" <?php echo ($row['BranchID'] == '124') ? 'selected' : ''; ?>>สัตวศาสตร์</option>
                                                <option value="125" <?php echo ($row['BranchID'] == '125') ? 'selected' : ''; ?>>สาธารณสุขศาสตร์</option>
                                                <option value="126" <?php echo ($row['BranchID'] == '126') ? 'selected' : ''; ?>>สาธารณสุขศาสตรมหาบัณฑิต</option>
                                                <option value="127" <?php echo ($row['BranchID'] == '127') ? 'selected' : ''; ?>>สารสนเทศศาสตร์</option>
                                                <option value="128" <?php echo ($row['BranchID'] == '128') ? 'selected' : ''; ?>>สารสนเทศศาสตร์และบรรณารักษศาสตร์์</option>
                                                <option value="129" <?php echo ($row['BranchID'] == '129') ? 'selected' : ''; ?>>หลักสูตรและการเรียนการสอน</option>
                                                <option value="130" <?php echo ($row['BranchID'] == '130') ? 'selected' : ''; ?>>หลักสูตรและการสอน</option>
                                                <option value="131" <?php echo ($row['BranchID'] == '131') ? 'selected' : ''; ?>>ออกแบบผลิตภัณฑ์(เน้นคอมพิวเตอร์กราฟิก)</option>
                                                <option value="132" <?php echo ($row['BranchID'] == '132') ? 'selected' : ''; ?>>ออกแบบผลิตภัณฑ์(เน้นออกแบบแฟชั่น)</option>
                                                <option value="133" <?php echo ($row['BranchID'] == '133') ? 'selected' : ''; ?>>อาชีวอนามัยและความปลอดภัย</option>
                                                <option value="134" <?php echo ($row['BranchID'] == '134') ? 'selected' : ''; ?>>อาหารและบริการ</option>
                                                <option value="135" <?php echo ($row['BranchID'] == '135') ? 'selected' : ''; ?>>อิเล็กทรอนิกส์อัจฉริยะและยานยนต์ไฟฟ้า</option>
                                                <option value="136" <?php echo ($row['BranchID'] == '136') ? 'selected' : ''; ?>>บุคคลภายนอก</option>
                                                <option value="137" <?php echo ($row['BranchID'] == '137') ? 'selected' : ''; ?>>โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="138" <?php echo ($row['BranchID'] == '138') ? 'selected' : ''; ?>>พนักงานมหาวิทยาลัย</option>
                                                <option value="139" <?php echo ($row['BranchID'] == '139') ? 'selected' : ''; ?>>อาจารย์</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2">ระดับ</label>
                                        <div class="col-sm-4">
                                            <select name="Level_ID" id="Level_ID" class="form-control select2" required>
                                                <option value="">-- เลือกระดับการศึกษา --</option>
                                                <option value="1" <?php echo ($row['Level_ID'] == '1') ? 'selected' : ''; ?>>ปริญญาตรี</option>
                                                <option value="2" <?php echo ($row['Level_ID'] == '2') ? 'selected' : ''; ?>>ปริญญาโท</option>
                                                <option value="3" <?php echo ($row['Level_ID'] == '3') ? 'selected' : ''; ?>>ปริญญาเอก</option>
                                                <option value="4" <?php echo ($row['Level_ID'] == '4') ? 'selected' : ''; ?>>พนักงานมหาวิทยาลัย</option>
                                                <option value="5" <?php echo ($row['Level_ID'] == '5') ? 'selected' : ''; ?>>อาจารย์</option>
                                                <option value="6" <?php echo ($row['Level_ID'] == '6') ? 'selected' : ''; ?>>บุคคลภายนอก</option>
                                                <option value="7" <?php echo ($row['Level_ID'] == '7') ? 'selected' : ''; ?>>โรงเรียนสาธิตมหาวิทยาลัยราชภัฏอุดรธานี</option>
                                                <option value="8" <?php echo ($row['Level_ID'] == '8') ? 'selected' : ''; ?>>ไม่มีบัตร</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <label class="col-md-2"></label>
                                        <div class="col-sm-2">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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

<?php  
                            // echo'<pre>';
                            // print_r($_POST); 

                            if (
                                isset($_POST['id']) && // ตรวจสอบว่ามี id ด้วย
                                isset($_POST['Prefix']) && // ตรวจสอบว่ามี Prefix ด้วย
                                isset($_POST['UserID']) && // ตรวจสอบว่ามี UserID ด้วย
                                isset($_POST['FirstName']) && // ตรวจสอบว่ามี FirstName ด้วย
                                isset($_POST['LastName']) && // ตรวจสอบว่ามี LastName ด้วย
                                isset($_POST['phone']) && // ตรวจสอบว่ามี phone ด้วย
                                isset($_POST['FacultyID']) && // ตรวจสอบว่ามี FacultyID ด้วย
                                isset($_POST['BranchID']) && // ตรวจสอบว่ามี BranchID ด้วย
                                isset($_POST['Level_ID']) // ตรวจสอบว่ามี Level_ID ด้วย
                            ) {
                                // รับค่าจากฟอร์ม
                                $id = $_POST['id']; // รับค่า id จากฟอร์ม
                                $prefix = $_POST['Prefix'];
                                $UserID = $_POST['UserID']; 
                                $FirstName = $_POST['FirstName'];
                                $LastName = $_POST['LastName'];
                                $phone = $_POST['phone'];
                                $facultyID = $_POST['FacultyID'];
                                $branchID = $_POST['BranchID'];
                                $levelID = $_POST['Level_ID'];

                                // echo 'success';
                            
                                // เตรียมคำสั่ง SQL สำหรับการอัปเดตข้อมูล
                                $stmt = $conn->prepare("
                                    UPDATE users 
                                    SET 
                                        Prefix = ?, 
                                        UserID = ?, 
                                        FirstName = ?, 
                                        LastName = ?, 
                                        phone = ?, 
                                        FacultyID = ?, 
                                        BranchID = ?, 
                                        Level_ID = ? 
                                    WHERE id = ?
                                ");
                            
                                // ผูกพารามิเตอร์กับคำสั่ง SQL
                                $stmt->bind_param("ssssssssi", $prefix, $UserID, $FirstName, $LastName, $phone, $facultyID, $branchID, $levelID, $id);
                            
                                // ประมวลผลคำสั่ง SQL
                                if ($stmt->execute()) {
                                    // ถ้าอัปเดตสำเร็จ
                                    echo "
                                        <script>
                                            Swal.fire({
                                                title: 'อัปเดตข้อมูลสำเร็จ',
                                                text: 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว',
                                                icon: 'success',
                                                confirmButtonText: 'ตกลง'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = 'member.php'; // เปลี่ยนหน้าเป็น member.php
                                                }
                                            });
                                        </script>";
                                } else {
                                    // ถ้าเกิดข้อผิดพลาดในการอัปเดต
                                    echo "
                                        <script>
                                            Swal.fire({
                                                title: 'เกิดข้อผิดพลาด',
                                                text: 'ไม่สามารถอัปเดตข้อมูลได้',
                                                icon: 'error',
                                                confirmButtonText: 'ลองอีกครั้ง'
                                            });
                                        </script>";
                                }
                            
                                // ปิดการเชื่อมต่อฐานข้อมูล
                                $stmt->close();
                                $conn->close();
                            }
                            ?>
