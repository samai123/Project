<?php session_start();?>
<?php
    include('connection.php');
    $id = $_SESSION["UserID"];
    $sql = "SELECT ProfileImage FROM account WHERE AccountID = '$id'";
	$sth = $con -> query($sql);
	$row = mysqli_fetch_array($sth);
    echo '<img  style="width: 200px; height: 200px" src="data:image/jpg;base64,'.base64_encode( $row['ProfileImage'] ).'"/>';
 ?>    

