<?php
    session_start();
    include('connection.php');
    date_default_timezone_set("Asia/Bangkok");
    $accountID = $_SESSION['UserID'];
    $novelID = $_GET['novelID'];
    $datetime = date("Y-m-d H:i:s");
    $query = "SELECT DISTINCT s.AccountID,s.NovelID
    FROM account a,shelfhistory s,novel n where n.NovelID = s.NovelID 
    and n.NovelID = '$novelID' and s.accountID = $accountID";
    $result1 = mysqli_query($con, $query);
    if($result1->num_rows > 0){
        $sql = "DELETE from shelfhistory
            where NovelID = '$novelID' and AccountID = '$accountID'";
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
        }
    }
    else{
        $sql = "INSERT INTO shelfhistory
            VALUES($accountID,$novelID,'$datetime')";
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
        }
      }   
?>
<script type="text/javascript">
history.go(-1);
</script>