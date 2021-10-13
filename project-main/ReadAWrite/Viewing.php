<?php
    session_start();
    include('connection.php');
    date_default_timezone_set("Asia/Bangkok");
    if(empty($_SESSION['UserID'])) $accountID = 0; else $accountID = $_SESSION['UserID'];
    $chapnum = $_GET['chapnum'];
    $novelID = $_GET['novelID'];
    $datetime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO viewing
    VALUES(NULL,$novelID,$chapnum,$accountID,'$datetime') ";
    if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
    }   
    Header("Location: Chapter.php?chapnum=" . $chapnum ."&novelID=".$novelID);
?>