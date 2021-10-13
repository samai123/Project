<?php session_start(); ?>
<?php
include('connection.php');
$penID = $_GET['penID'];
$type = $_GET['type'];
$accountID = $_SESSION['UserID'];

if ($type==0) {
    $sql = "DELETE from penname
        where PenID = $penID";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "<script>";
        echo "alert(\"ลบนามปากกาสำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
} else {
    $newpenname = $_POST['PenName'];
    $sql = "UPDATE penname SET PenName = '$newpenname'
    WHERE PenID = $penID";
    $query_run = mysqli_query($con, $sql);
    if ($query_run) {
        echo "<script>";
        echo "alert(\"แก้ไขนามปากกาสำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
    }
}

?> 