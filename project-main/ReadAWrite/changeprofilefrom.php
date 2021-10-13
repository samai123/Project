<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANGEPROFILE</title>
    <link rel = "stylesheet" href ="CSS/Home.css">
    <link rel = "stylesheet" href ="CSS/editprofile.css">
    
</style>    
</head>
<body>

<?php session_start();?>
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
                    <a style="position:absolute; top:13px; right:10px;" class="dropbtn"><a style="position:absolute; top:13px; right:10px;" class="dropbtn"><a style="position:absolute; top:13px; right:10px;" class="dropbtn">
                <?php
              include('connection.php');
              $id = $_SESSION["UserID"];
              $sql = "SELECT ProfileImage,Balance FROM account WHERE AccountID = '$id'";
              $sth = $con->query($sql);
              $row = mysqli_fetch_array($sth);
              echo '<img  style="border-radius:50%;width:32px;height:32px;" src="data:image/jpg;base64,' . base64_encode($row['ProfileImage']) . '"/>';
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






<div class = "alldata">
<div class = "title"><br><lable>Edit Profile</lable></div>       
<div class = "pic">    

<?php
    include('connection.php');
    $id = $_SESSION["UserID"];
    $sql = "SELECT ProfileImage FROM account WHERE AccountID = '$id'";
	$sth = $con -> query($sql);
	$row = mysqli_fetch_array($sth);
    echo '<img  style="width: 150px; height: 150px" src="data:image/jpg;base64,'.base64_encode( $row['ProfileImage'] ).'"/>';
 ?> 
</div>   
<div class="btnup">
<form action = "profilepic.php" method = "post" enctype="multipart/form-data">
    <br><input type = "file" name = "pfimg" id = "pfimg">
    <input type="submit"  name="upload"  value="upload" /><br><br>
</form>
</div>
<form id = "dataupdate" action = "dataupdate.php" method = "post" enctype="multipart/form-data">
    <div class = "simpledata">
    <div class = "text"><lable>Showname    </lable></div>
    <input type=text name=showname placeholder=""/><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>Email    </lable></div>
    <input type=text name=email placeholder=""/><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>Firstname    </lable></div>
    <input type=text name=firstname placeholder=""/><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>Lastname    </lable></div>
    <input type=text name=lastname placeholder=""/><br></div>

    <div class = "simpledata">
    <div class = "text_birth"><lable>Birthday    </lable></div>
    <input type="datetime-local" id="birthday" name=""><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>Sex   </lable></div>
     <select id="sex" name="sex">
        <option disabled selected value> -- select an option -- </option>
        <option value="M">M</option>
        <option value="F">F</option>
        <option value="other">other</option>
    </select></div>

    <div class = "simpledata">
    <div class = "text"><lable>Telephone    </lable></div>
    <input type="text" name="Telephone" placeholder=""><br></div>

    <!-- banking -->
    <p>Banking for receive donations </p>
    <div class = "simpledata">
    <div class = "text"><lable>Bank    </lable></div>
    <input type="text" name="Bank" placeholder="กรุงไทย"><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>BankNumber    </lable></div>
    <input type=int name=BankNumber placeholder=""/><br></div>

    <div class = "simpledata">
    <div class = "text"><lable>Name    </lable></div>
    <input type="text" name="BankName" placeholder="สุทิดา นางฟ้า"><br></div>
    <br>
    <!-- button -->

    <div class = "simpledata">
    <br><input type="submit"  name="update"  value="update data" /><br></div>
</form>

<form action = "changepassword.php" method = "post" enctype="multipart/form-data">
        <div class = "button"> 
        <div class = "simpledata">
        <input type="submit"  name="changepassword"  value="change password" /><br></div></div>
</form>

        <div class = "simpledata">
        <a href="checkstatusv.php">Verification</a></strong></p></div>
        <br><br>
        <div class = "simpledata">
        

</body>
</html>