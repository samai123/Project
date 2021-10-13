<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" href="CSS/Login.css">
	</head>
	<body>
		<div class="login">
			<div class="login_header">
				<a href="unknown_homepage.php"><img class="logo" src="image_nav/readawrite-logo-black-svg.svg"></a>
			</div>
			<div>
				<form name="loginfrm" method="post" action="Login.php">
				<h3>Username</h3>
				<input class="box" type="text" id="Username" name="Username" required>
				<h3>Password</h3>
				<div><input class="box" type="password" id="changeme" name="Password" required>
				<img src="image_login/open.png" width="35px" id="box1" class="showbtn" onclick="showpass()">
				<img src="image_login/eye.png" width="35px" id="box2" class="showbtn"  onclick="hidepass()" style="display:none;"></div>
				<br><button type="submit" class="otherbutton">LOGIN</button>
				</form>
				<p>New Reader? <a href="RegisterForm.php">Register!</a></p>
			</div>
		</div>
	<script>
		function showpass(){
			var show = document.getElementById("box1");
			var hide = document.getElementById("box2");
			var pass = document.getElementById("changeme");
			show.style.display = "none";
			hide.style.display = "inline";
			pass.type = "text";
		}
		function hidepass(){
			var show = document.getElementById("box1");
			var hide = document.getElementById("box2");
			var pass = document.getElementById("changeme");
			show.style.display = "inline";
			hide.style.display = "none";
			pass.type = "password";
		}
	</script>
	</body>
</html>