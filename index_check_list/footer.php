<script>
        function updateTime() {
            const currentTime = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('currentTime').textContent = `เวลาปัจจุบัน : ${currentTime.toLocaleTimeString('en-GB', options)}`;
        }

        // เรียกฟังก์ชัน updateTime ทุกๆ 1 วินาที
        setInterval(updateTime, 1000);

        // เรียกฟังก์ชัน updateTime ครั้งแรกเพื่อแสดงเวลาทันที
        updateTime();

        // ตั้งเวลาให้ซ่อนองค์ประกอบที่มี id เป็น checkInformation หลังจาก 10 วินาที
        setTimeout(function() {
            const checkInformationElement = document.getElementById('checkInformation');
            if (checkInformationElement) {
                checkInformationElement.style.display = 'none';
            }
        }, 20000); // 20000 milliseconds = 20 seconds

        function updateDateTime() {
            const now = new Date();

            // แปลงเดือนเป็นข้อความภาษาไทย
            const monthNamesThai = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ];
            const day = now.getDate();
            const month = monthNamesThai[now.getMonth()];
            const year = now.getFullYear();

            // แสดงวันที่ในรูปแบบ "วัน เดือน ปี"
            const dateString = `วันที่ ${day} ${month} ${year}`;
            document.getElementById("Datetime").textContent = dateString;
        }

        // เรียกใช้ฟังก์ชันเมื่อโหลดหน้าเสร็จ
        window.onload = updateDateTime;
    </script>


    <script>
        document.getElementById('showFormButton').addEventListener('click', function() {
            // รับค่า admin_name จาก PHP ผ่านการแทรกใน JavaScript
            var admin_username = "<?php echo $_SESSION['admin_username']; ?>";

            Swal.fire({
                title: 'กรุณาใส่รหัสผ่านเพื่อเข้าสู่หน้าจัดการข้อมูล',
                html: '<form id="loginForm" action="check_login_admin2.php" method="post">' +
                    '<div class="password-toggle">' +
                    '<input type="hidden" name="admin_username" value="' + admin_username + '" required>' +
                    '<input type="password" name="admin_password" id="passwordField" placeholder="Password" required>' +
                    '<button type="button" id="toggleButton" onclick="togglePasswordVisibility()">' +
                    '<i class="fa-regular fa-eye-slash"></i>' +
                    '</button>' +
                    '</div>' +
                    '<input type="submit" value="Login">' +
                    '</form>',
                showConfirmButton: false,
                customClass: {
                    popup: 'swal2-popup-custom',
                    title: 'swal2-title-custom',
                    htmlContainer: 'swal2-html-container-custom'
                }
            });
        });

        // JavaScript function to toggle password visibility
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordField");
            var toggleButton = document.getElementById("toggleButton");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = '<i class="far fa-eye"></i>';
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
            }
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>