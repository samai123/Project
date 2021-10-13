<?php session_start();?>
<?php
     date_default_timezone_set("Asia/Bangkok");
    include('connection.php');
    $id = $_SESSION["UserID"];
    $date = date('Y-m-d h:i:s');
    $query = "SELECT Balance from account where AccountID = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $balance = $row['Balance'];
    if(isset($_POST['submitbank']) || isset($_POST['submittrue'])){
        if(isset($_POST['amountcoins'])){
            $money = $_POST['amountcoins'];
        }
        else if(isset($_POST['amountcoinstrue'])){
            $money = $_POST['amountcoinstrue'];
        }

        if(isset($_POST['submitbank'])){
            $type = "OnlineBanking";
        }
        else if(isset($_POST['submittrue'])){
            $type = "True Money";
        }
        if($money<=5000){
            $sql = "INSERT INTO coin SET TopUpDateTime = '$date', TopUpAmount = $money, PaymentType = '$type',
                AccountID = '$id'";
            //print_r($sql);        
            $query_run = mysqli_query($con, $sql);
            $sql1 = "UPDATE account set Balance = $balance+$money where AccountID = '$id'";
            $query_run1 = mysqli_query($con, $sql1);
            if($query_run and $query_run1 ){
                echo "<script>";
                echo "alert(\"เติมเงินสำเร็จ\");";
                echo "</script>";
            }            
            else{
                echo "<script>";
                echo "alert(\"เติมเงินไม่สำเร็จ\");";
                echo "</script>";
            }
        }
        else{
            echo "<script>";
            echo "alert(\"จำกัดยอดไม่เกิน 5000 ค่ะ\");";
            echo "</script>";
        }    
    }
    else{
        echo "<script>";
        echo "alert(\"กรุณาเลือกจำนวนเงิน\");";
        echo "</script>";
    }
?>
<script type="text/javascript">
window.location.href = "topupform.php";
</script>