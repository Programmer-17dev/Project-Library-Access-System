
<div class="banner">
    <div class="icon">
        <div class="icon-udru">
        </div>
        <div class="Library"> LIBRARY UDRU <span>บันทึกสถิติผู้เข้าใช้บริการห้องสมุด</span></div>
    </div>
</div>

<div class="content-time-date">
    <div class="current-time" id="currentTime">
        <!-- JavaScript สำหรับแสดงเวลาปัจจุบัน -->
    </div>
    <div class="Date-time" id="Datetime"></div>
    <div class="count-user">
        
        <?php
        echo  "จำนวน " . $count['count_chk'] . " คน ";
        ?>
    </div>
    <!-- ปุ่มล็อคอินผู้ดูแลระบบ -->
    <a class="control" id="showFormButton" title="เข้าใช้ระบบ" style="cursor: pointer;">Control</a>
    <!-- <button id="showFormButton">Login</button> -->
</div>

