<?php
    session_start();
    include('connection.php');
    $query = "SELECT AccountID from verification 
    where AgeVerification is null";
    $result = mysqli_query($con, $query);
    foreach( $result as $row )  {
            if(isset($_POST[$row [ 'AccountID' ]])){
            $Value = $_POST[$row [ 'AccountID' ]];
            $accID = $row['AccountID'];
            $sql = "UPDATE verification
            set AgeVerification = $Value
            where AccountID = '$accID'";
            if (!mysqli_query($con,$sql)) {
                die('Error: ' . mysqli_error($con));
            } 
        }
    }
    // $test = $_POST['5'];
    Header("Location: Adminform.php");
?>