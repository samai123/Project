<?php
session_start();
	if(isset($_POST['Username'])){
		include('connection.php');
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$sql = "SELECT AccountID,ShowName FROM account WHERE UserName='".$Username."' and PassWord='".$Password."' ";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result)==1){
			$row = mysqli_fetch_array($result);
			$_SESSION["UserID"] = $row["AccountID"];
			$_SESSION["User"] = $row["ShowName"];
			Header("Location: user_homepage.php");
		}else{
			echo "<script>";
			echo "alert(\"Username หรือ Password ไม่ถูกต้อง\");";
			echo "window.history.back()";
			echo "</script>";
		}
	}else{
		Header("Location: LoginForm.php");
	}
?>