<?php
    session_start();
    include('connection.php');
    date_default_timezone_set("Asia/Bangkok");
    $accountID = $_SESSION['UserID'];
    $penID = $_GET['penID'];
    $datetime = date("Y-m-d H:i:s");
    $query = "SELECT DISTINCT f.followID 
    FROM account a,follow f,penname p where f.PenID = p.PenID 
    and p.PenID = '$penID' and f.accountID = $accountID";
    $result1 = mysqli_query($con, $query);
    if($result1->num_rows > 0){
        foreach( $result1 as $row ){
            $followID = $row["followID"];
        }
        $sql = "DELETE from follow
            where FollowID = '$followID'";
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
        }
    }
    else{
        $sql = "INSERT INTO follow
            VALUES(NULL,$penID,$accountID,'$datetime')";
        if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
        }
      }   
?>
<script type="text/javascript">
history.go(-1);
</script>