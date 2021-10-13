<?php
include('connection.php');
$novelID = $_GET['novelID'];

$sql = "DELETE FROM novel WHERE NovelID = $novelID";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    }
    echo "<script>";
    echo "alert(\"ลบนิยายสำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
?>