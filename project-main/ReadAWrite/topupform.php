<?php session_start();?>
<!DOCTYPE html>
<html>
<body>
<link rel = "stylesheet" type = "text/css" href ="CSS/Home.css">
<link rel = "stylesheet" type = "text/css" href ="CSS/topup.css">

<nav class="navbar">
				<div style="position:absolute; left:10px">
					<ul>
						<li><a href="user_homepage.php">Home</a></li>
						<li><a href="Category.php">Category</a></li>
						<li><a href="MyShelf.php">My shelf</a></li>
					</ul>
				</div>
				<div>
					<ul>
						<li><a href="user_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
					</ul>
				</div>
				<div class="dropdown" style="margin-bottom:80px;">
					<a style="position:absolute; top:13px; right:10px;" class="dropbtn">
					<?php 
						include('connection.php');
						$id = $_SESSION["UserID"];
						$sql = "SELECT ProfileImage,Balance FROM account WHERE AccountID = '$id'";
						$sth = $con -> query($sql);
						$row = mysqli_fetch_array($sth);
						echo '<img  style="border-radius:50%;width:32px;height:32px;" src="data:image/jpg;base64,'.base64_encode( $row['ProfileImage'] ).'"/>';					
					?>
					Profile</a>
					<div class="dropdown-content" st>
            <a>Balance : <?php echo $row['Balance'] ?></a>
						<a href="MyPage.php">My Page</a>
						<a href="MyPenname.php">My Penname</a>
						<a href="changeprofilefrom.php">Edit Profile</a>
						<a href="topupform.php">Topup</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</nav>

<div class="box">
<div class="top"><p>TOPUP</p></div>
<div class="type">
<label for="myCheck">Online Banking:</label> 
<input type="checkbox" id="onlinebank" onclick="myFunction1()">
<label for="myCheck2">True Wallet:</label> 
<input type="checkbox" id="truemoney" onclick="myFunction2()"><br>
</div>
</div>
<div class=detail>
<div id="bankamount" style="display:none">
    <form action = "topup.php" method = "post" enctype="multipart/form-data">
    <br>
    <div class="inputfield">
    <label>Bank</label>  
    <select id="bankname" required name="bankname">
        <option disabled selected value> -- Bank options -- </option>
        <option value="เขียว">Green</option>
        <option value="เหลือง">Yellow</option>
        <option value="ม่วง">Puple</option>
        <option value="น้ำเงิน">Blue</option>
    </select><br></div>
    <div class="inputfield">
    <label>Amount</label>
    <input type=text name=amountcoins required placeholder=""/><br></div>
    <div class="sbtn">
    <input action = "topup.php" type="submit"  name="submitbank"  value="Submit" /><br></div>
    <div class="textf">
    <label>--  กดเติมเงินแล้วระบบจะส่งยอดไปที่หน้าแอปแล้วเติมอัตโนมัติ  --</label><br><br></div>
    </form>
</div>
<div id="trueamount" style="display:none">
    <form action = "topup.php" method = "post" enctype="multipart/form-data">
    <br>
    <div class="inputfield">
    <label>Amount</label>
    <input type=text name=amountcoinstrue required  placeholder=""/><br></div>
    <div class="inputfieldt">
    <label>Telephone</label>
    <input type=text name=telephone required placeholder=""/><br></div>
    <div class="sbtn">
    <input action = "topup.php" type="submit"  name="submittrue"  value="Submit" /><br></div>
    <div class="textf">
    <label>--  กดเติมแล้วระบบจะส่ง OTP ยืนยันแล้วตัดเงินในบัญชี  --</label><br><br></div>
    </form>
</div>
</div>



<script>
function myFunction1() {
  var checkBox = document.getElementById("onlinebank");
  var text = document.getElementById("bankamount");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<script>
function myFunction2() {
  var checkBox = document.getElementById("truemoney");
  var text = document.getElementById("trueamount");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>


</body>
</html>
