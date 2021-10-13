<?php session_start();?>
<?php
    include('connection.php');
    $id = $_SESSION["UserID"];
    $showname = $_POST['showname'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    if(isset($_POST['update'])){
    $old_data = "SELECT * FROM account WHERE AccountID = '$id'";
    $result = mysqli_query($con, $old_data);
	$row = mysqli_fetch_array($result);
    if(empty($_POST['showname'])){
        $showname = $row['ShowName'];
    }
    if(empty($_POST['email'])){
        $email = $row['AccountEmail'];
    }
    if(empty($_POST['firstName'])){
        $firstname = $row['FirstName'];
    }
    if(empty($_POST['lastName'])){
        $lastname = $row['LastName'];
    }
    if(empty($_POST['sex'])){
        $sex = $row['Sex'];
    }else{
        $sex = $_POST['sex'];
    }
    if($row['Telephone'] == NULL && empty($_POST['Telephone']) ){
        $sql = "UPDATE account set Telephone = null where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    } else if(isset($_POST['Telephone'])){
        $tele = $_POST['Telephone'];
        $sql = "UPDATE account set Telephone = '$tele' where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }
    if(isset($_POST['Bank'])){
        $bank = $_POST['Bank'];
        $sql = "UPDATE account set Bank = '$bank' where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }  
    if($row['BankNumber'] == NULL && empty($_POST['BankNumber']) ){
        $sql = "UPDATE account set BankNumber = null where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }else if(isset($_POST['BankNumber'])){
        $banknum = $_POST['BankNumber'];
        $sql = "UPDATE account set BankNumber = '$banknum' where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }  
    if($row['BankName'] == NULL&& empty($_POST['BankName'])){
        $sql = "UPDATE account set BankName = null where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }else if(isset($_POST['BankName'])){
        $bankname = $_POST['BankName'];
        $sql = "UPDATE account set BankName = '$bankname' where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }
    if($row['DateOfBirth'] == NULL && empty($_POST['birthday'])){
        $sql = "UPDATE account set DateOfBirth = null where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }
    else if(isset($_POST['birthday'])){
        $birth = $_POST['birthday'];
        $sql = "UPDATE account set DateOfBirth = '$birth' where AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
    }      
    
        $sql = "UPDATE account SET ShowName = '$showname', AccountEmail = '$email', FirstName = '$firstname',
        LastName = '$lastname', Sex = '$sex'
        WHERE AccountID = '$id'";
        $query_run = mysqli_query($con, $sql);
        if($query_run){
            echo "<script>";
            echo "alert(\"แก้ไขข้อมูลสำเร็จ\");";
            echo "window.history.back()";
            echo "</script>";
        }            
        else{
            echo "<script>";
            echo "alert(\"แก้ไขข้อมูลไม่สำเร็จ\");";
            echo "window.history.back()";
            echo "</script>";
        }
    }
    else{
        echo "<script>";
        echo "alert(\"ยังไม่ได้เลือกข้อมูลที่จะแก้ไข\");";
        echo "window.history.back()";
        echo "</script>";
    }    
?>
<!-- <script type="text/javascript"> 
window.location.href = "user_homepage.php";
</script>-->