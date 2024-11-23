
<style>
/* จัดตำแหน่งปุ่มให้ลอยอยู่ที่มุมขวาล่าง */
.scroll-btn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 50%;
  padding: 10px;
  cursor: pointer;
  font-size: 18px;
  z-index: 1000;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
}

.scroll-btn:hover {
  background-color: #0056b3;
}

.scroll-btn:focus {
  outline: none;
}


</style>
 <!-- ปุ่มเลื่อน -->
 <button id="scrollBtn" class="scroll-btn"  >
          <i id="scrollIcon" class="fas fa-arrow-down"></i>
        </button>

<script>
// รับปุ่มและไอคอนจาก DOM
var scrollBtn = document.getElementById("scrollBtn");
var scrollIcon = document.getElementById("scrollIcon");

// ฟังก์ชันสำหรับเลื่อนขึ้นหรือลงตามตำแหน่งปัจจุบัน
function scrollToTopBottom() {
  // ตรวจสอบว่าตอนนี้อยู่ที่ด้านล่างสุดของหน้าเว็บหรือไม่
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1) {
    // ถ้าอยู่ที่ด้านล่างสุดของหน้า เลื่อนไปด้านบน
    window.scrollTo({ top: 0, behavior: 'smooth' });
  } else {
    // ถ้าไม่อยู่ที่ด้านล่าง เลื่อนไปด้านล่างสุด
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
  }
}

// ตรวจจับเมื่อมีการเลื่อนหน้า
window.onscroll = function() {
  // ตรวจสอบว่าหน้าเว็บอยู่ที่ล่างสุดหรือไม่
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 1) {
    // ถ้าอยู่ที่ล่างสุดของหน้า ให้เปลี่ยนเป็นไอคอนลูกศรขึ้น
    scrollIcon.classList.remove('fa-arrow-down');
    scrollIcon.classList.add('fa-arrow-up');
  } else {
    // ถ้ายังไม่ถึงล่างสุด ให้แสดงเป็นลูกศรลง
    scrollIcon.classList.remove('fa-arrow-up');
    scrollIcon.classList.add('fa-arrow-down');
  }
};

// กำหนดให้ปุ่มเลื่อนทำงานเมื่อถูกกด
scrollBtn.addEventListener('click', scrollToTopBottom);

</script>