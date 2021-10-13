<?php session_start();?>
<?php
      include('connection.php');
      $id = $_SESSION["UserID"];
      if(isset($_POST['change'])){
      $newpass = $_POST['newpass'];    
      $old_data = "SELECT * FROM account WHERE AccountID = '$id'";
      $result = mysqli_query($con, $old_data);
	  $row = mysqli_fetch_array($result);
      if(($row['PassWord'] != $_POST['oldpass']) && (!empty($_POST['oldpass'])) && (!empty($newpass))){
        echo "<script>";
        echo "alert(\"Password ไม่ตรง\");";
        echo "</script>";
       }
       else if(empty($_POST['oldpass']) || empty($newpass)){
            echo "<script>";
            echo "alert(\"กรอกรหัสไม่ครบ\");";
            echo "</script>";
       } 
       else{
        $sql = "UPDATE account SET PassWord = '$newpass' WHERE AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
        if($query_run){
            echo "<script>";
            echo "alert(\"แก้ไขรหัสผ่านสำเร็จ\");";
            echo "</script>";
        }
        else{
            echo "<script>";
            echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ\");";
            echo "window.history.back()";
            echo "</script>";
        }
      }
    }  

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANGEPASSWORD</title>
    <link rel = "stylesheet" href ="CSS/Home.css">
    <link rel = "stylesheet" href ="CSS/changepass.css">
</head>
<body>

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
						$sql = "SELECT ProfileImage FROM account WHERE AccountID = '$id'";
						$sth = $con -> query($sql);
						$row = mysqli_fetch_array($sth);
						echo '<img  style="border-radius:50%;width:32px;height:32px;" src="data:image/jpg;base64,'.base64_encode( $row['ProfileImage'] ).'"/>';					
					?>
					Profile</a>
					<div class="dropdown-content" st>
						<a href="MyPage.php">My Page</a>
						<a href="MyPenname.php">My Penname</a>
						<a href="changeprofilefrom.php">Edit Profile</a>
						<a href="topupform.php">Topup</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</nav>
     <div class="alldata"> 
     <br>  
     <div class="top">        
    <lable>Change password</lable><br>
    </div>
    <form action = "" method = "post" enctype="multipart/form-data">
    <div class="inputdata">
    <lable>Old   password</lable>
    <input type=text name=oldpass placeholder=""/><br></div>
    <div class="inputnew">
    <lable>New password</lable>
    <input type=text name=newpass placeholder=""/><br></div>
    <div class="btn">
    <input type="submit"  name="change"  value="Change" /><br></div>
    <div class="backbtn">    
    <a href="changeprofilefrom.php">Back</a></strong></p><br></div>
    </div>
</body>
</html>