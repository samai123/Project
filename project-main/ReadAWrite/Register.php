 <?php
	include('connection.php');
	$showname = mysqli_real_escape_string($con, $_POST['Showname']);
	$username= mysqli_real_escape_string($con, $_POST['Username']);
	$password= mysqli_real_escape_string($con, $_POST['Password']);
	$email= mysqli_real_escape_string($con, $_POST['Email']);
	$firstname = mysqli_real_escape_string($con, $_POST['FirstName']);
	$lastname = mysqli_real_escape_string($con, $_POST['LastName']);
	$sex= mysqli_real_escape_string($con, $_POST['Sex']);
	$file = addslashes(file_get_contents("image_nav/tiny.jpg"));

	$query = "SELECT UserName from account where UserName = '$username'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	if(isset($row["UserName"]))
	{
		echo "<script>";
        echo "alert(\"Username ซ้ำ\");";
        echo "</script>";
		echo "<script type='text/javascript'>history.go(-1);</script>";
	}
	else{
		if(empty($_POST['Telephone'])){
			$sql="INSERT INTO Account (ShowName, UserName, PassWord, AccountEmail, FirstName, LastName, Sex, class, ProfileImage,Balance)
			VALUES ('$showname', '$username', '$password', '$email', '$firstname', '$lastname', '$sex', 'M', '$file',0)";
		}else{
			$telephone = mysqli_real_escape_string($con, $_POST['Telephone']);
			$sql="INSERT INTO Account (ShowName, UserName, PassWord, AccountEmail, FirstName, LastName, Sex, Telephone, class, ProfileImage,Balance)
			VALUES ('$showname', '$username', '$password', '$email', '$firstname', '$lastname', '$sex', '$telephone' ,'M', '$file',0)";
		}
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
		echo "<script>";
		echo "alert(\"Success\");";
		echo "location.href='LoginForm.php'";
		echo "</script>";
	}
mysqli_close($con);
?>