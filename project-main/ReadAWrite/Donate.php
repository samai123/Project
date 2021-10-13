<?php session_start();?>
<?php
    date_default_timezone_set("Asia/Bangkok");
    include('connection.php');
    $id = $_SESSION["UserID"];
    $novelID = $_GET['novelID'];
    $amount = $_POST['amountcoins'];
    $date = date('Y-m-d h:i:s');
    $query = "SELECT Balance from account where AccountID = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $balance = $row['Balance'];
    if($amount<=5000){
        if($balance>=$amount){                
            $sql = "INSERT INTO donate values (null,'$date',$novelID,$id,$amount)";      
            $query_run = mysqli_query($con, $sql);
            $sql1 = "UPDATE account set Balance = $balance-$amount where AccountID = '$id'";
            $query_run1 = mysqli_query($con, $sql1);
            echo "<script>";
            echo "alert(\"โดเนทสำเร็จ\");";
            echo "</script>";
            
        }
        else{
            echo "<script>";
            echo "alert(\"จำนวน coin ไม่พอ\");";
            echo "</script>";
        }
    } 
    else {
        echo "<script>";
        echo "alert(\"จำกัดยอดไม่เกิน 5000 ค่ะ\");";
        echo "</script>";
    }

?>
<script type="text/javascript">
history.go(-2);
</script>