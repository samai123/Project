<?php session_start();?>
<?php $novelID = $_GET['novelID']; ?>
<!DOCTYPE html>
<html>
<body>
<link rel = "stylesheet" type = "text/css" href ="CSS/Home.css">
<link rel = "stylesheet" type = "text/css" href ="CSS/donate.css">

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

</div>
</div>
<div class=detail>
<div id="trueamount">
    <div class="donatetop"><br><label>Donate</label></div>
    <form action = "Donate.php?novelID=<?php echo $novelID ?>" method = "post" enctype="multipart/form-data">
    <br>
    <div class="inputfield">
    <label>Amount</label>
    <input type=text name=amountcoins required  placeholder=""/><br></div>
    <div class="sbtn">
    <input action = "Donate.php?novelID=<?php echo $novelID ?>" type="submit"  name="submittrue"  value="Submit" /><br></div>
    <div class="textf">
    <label>--  THANK YOU  --</label><br><br></div>
    </form>
</div>
</div>
<div class="backbtn"><a href="#">Back</a></div>
</body>
</html>
