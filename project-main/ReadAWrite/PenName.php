<?php
session_start();
include('connection.php');
$accountID = $_SESSION['UserID'];
$penname = mysqli_real_escape_string($con, $_POST['PenName']);

$sql="INSERT INTO penname
	VALUES ( NULL, '$accountID','$penname')";
if (!mysqli_query($con,$sql)) {
	die('Error: ' . mysqli_error($con));
}
echo "<script>";
echo "alert(\"Success\");";
echo "window.history.back()";
echo "</script>";

mysqli_close($con);
?>
