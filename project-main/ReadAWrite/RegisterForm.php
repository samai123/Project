 <?php
$con=mysqli_connect("localhost","root","","project");
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
 <!-- <form class='bor' name="inpfrm" method="post" action="Register.php">
	<table height="18" align="center" >
	<tr>
		<td align="right"></td>
		<td > Register Form </td>
	</tr>
	<tr>
		<td align="right" >Username<span style="color:red">*</span> : </td>
		<td><input name="Username" type="text" id="Username" size="30" value="" maxlength="30" required></td>
	</tr>
	<tr>
		<td align="right" >Password<span style="color:red">*</span> : </td>
		<td><input name="Password" type="text" id="Password" size="30" value="" maxlength="30" required></td>
	</tr>
	<tr>
		<td align="right" >Email<span style="color:red">*</span> : </td>
		<td><input name="Email" type="text" id="Email" size="30" value="" required></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td> Personal Information </td>
	</tr>
	<tr>
		<td align="right" >Showname<span style="color:red">*</span> : </td>
		<td><input name="Showname" type="text" id="Showname" size="30" value="" maxlength="30" required></td>
	</tr>
	<tr>
		<td align="right" >FirstName<span style="color:red">*</span> : </td>
		<td><input name="FirstName" type="text" id="FirstName" size="30" value="" maxlength="30" required></td>
	</tr>
	<tr>
		<td align="right" >LastName<span style="color:red">*</span> : </td>
		<td><input name="LastName" type="text" id="LastName" size="30" value="" maxlength="30" required></td>
	</tr>
	<tr>
		<td align="right" >Sex<span style="color:red">*</span> : </td>
		<td><select name="Sex" id="Sex">
			<option value="M">Male</option>
			<option value="F">Female</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right" >Telephone : </td>
		<td align="left" class="number"><input name="Telephone" type="text" id="Telephone" size="30" value="" maxlength="10"></td>
	</tr>
	</table>
	<p align="center" style="color:red">* = required information</p>
	<p align="center"><input name="Register" type="submit" id="Register" value="Register"></p>
</form> -->
 
<html>
	<head>
	<link rel = "stylesheet" href ="CSS/register.css">
	<link rel="stylesheet" href="CSS/Home.css">	
	</head>
	<body>

	<nav class="navbar">
				<div style="position:absolute; left:10px">
					<ul>
						<li><a href="unknown_homepage.php">Home</a></li>
						<li><a href="Category.php">Category</a></li>
					</ul>
				</div>
				<div>
					<ul>
						<li><a href="unknown_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
					</ul>
				</div>
				<div>
                    <ul>
						<li><a href="LoginForm.php" style="position:absolute; top:13px; right:10px;" class="dropbtn">Login</a></li>
					</ul>
				</div>
			</nav>

		<div class = "wrapper">
			<h1>Register Form</h1>
			<div class="form">
			<form name="Regis" method="post" action="Register.php" enctype="multipart/form-data">
				<div>
					<div class="inputfield">
					<label>Username<span>*</span></label><br>
					<input name="Username" type="text" required><br>
					</div>
					<div class="inputfield">
					<label>Password<span>*</span></label><br> 
					<input name="Password" type="password" id="changeme" required>
						<input type="checkbox" id="box1" onclick="showpass()">Show
						<br>
					</div>
					<div class="inputfield">
					<label>Email-Address<span>*</span></label><br>
					<input name="Email" type="email" required><br>
					</div>
				</div>
				<div>
					<h3>Personal Information</h3>
					<div class="inputfield">
					<label>Show Name:<span>*</span></label><br>
					<input name="Showname" type="text" required><br>
					</div>
					<div class="inputfield">
					<label>Firstname<span>*</span></label><br>
					<input name="FirstName" type="text" required><br>
					</div>
					<div class="inputfield">
					<label>Lastname<span>*</span></label><br>
					<input name="LastName" type="text" required><br>
					</div>
					<div class="inputfield">
					<label>Sex<span>*</span></label><br>
					<select name="Sex" id="Sex" required>
						<option disable selected hidden value=""><span></span></option>
						<option value="M">ชาย</option>
						<option value="F">หญิง</option>
					</select><br>
					</div>
					<div class="inputfield">
					<label>Telephone</label><br>	
					<input name="Telephone" type="text" maxlength="10">
					</div>
				</div>
				<div>
					<div class="inputfield">
					<button type="submit" class = "btn">register</button>
					</div>
				</div>
			</form>
			</div>
			<script>
				function showpass(){
					var box = document.getElementById("box1");
					var pass = document.getElementById("changeme");
					if(box.checked == true ){
						pass.setAttribute("type","text");
					}else{
						pass.setAttribute("type","password");
					}
				}
			</script>
		</div>
	</body>
 </html>