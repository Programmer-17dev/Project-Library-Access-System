<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Library UDRU</title>

	<link rel="stylesheet" href="assets/login.css">

	<link rel="shortcut icon" href="assets/images/UDRU.png" type="image/x-icon">
	<!-- <link rel="stylesheet" href="style2.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	

</head>

<body>
	<div class="container right-panel right-panel-active" id="container">
		<div class="form-container sign-up-container">
			<form action="check_login_admin.php" method="post">
			<div class="icon-container">
                    <!-- <p class="admin-login">มหาวิทยาลัยราชภัฏอุดรธานี</p> -->
					 <img src="assets/images/LgUDRU.png" alt="">
                </div>
				<input type="text" name="admin_username" placeholder="Username" required>
				<div class="password-toggle">
					<input type="password" name="admin_password" id="passwordField" placeholder="Password" required>
					<button type="button" id="toggleButton" onclick="togglePasswordVisibility()">
						<i class="fa-regular fa-eye-slash"></i>
					</button>
				</div>
				<input type="submit" value="Login">
				<div class="back-home">
					<a href="login.php" title="กลับไปหน้าหลัก"><img src="assets/images/down.png" alt=""></a>
				</div>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<img src="assets/images/icon1.png" />
					<p>ยินดีต้อนรับ ศูนย์วิทยบริการสำนักวิทยบริการและเทคโนโลยีสารสนเทศมหาวิทยาลัยราชภัฏอุดรธานี</p>
				</div>
			</div>
		</div>
	</div>
	<script>
		// JavaScript function to toggle password visibility
		function togglePasswordVisibility() {
			var passwordInput = document.getElementById("passwordField");
			var toggleButton = document.getElementById("toggleButton");

			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
			} else {
				passwordInput.type = "password";
				toggleButton.innerHTML = '<i class="far fa-eye"></i>';
			}
		}
	</script>


</body>

</html>