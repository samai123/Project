<?php
    session_start();
    include('connection.php');
    date_default_timezone_set("Asia/Bangkok");
    $accountID = $_SESSION['UserID'];
    $novelID = $_GET['novelID'];
    $chapnum = $_GET['chapnum'];
    $content = mysqli_real_escape_string($con, $_POST['comment']);
    $Publish = date("Y-m-d H:i:s");
   
    $sql = "INSERT INTO comment
            VALUES(NULL,$chapnum,$novelID,$accountID,'$content','$Publish')";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }
    Header("Location: chapter.php?chapnum=" . $chapnum . "&novelID=" . $novelID);
?>