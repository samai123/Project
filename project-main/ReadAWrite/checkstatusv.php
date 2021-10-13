<?php session_start();?>
<?php
      include('connection.php');
      $id = $_SESSION["UserID"];
      $data = "SELECT * FROM verification WHERE AccountID = '$id'";
      $result = mysqli_query($con, $data);
	  $row = mysqli_fetch_array($result);
      if($row['AgeVerification'] == 1){
        echo "<script>";
        echo "alert(\"ยืนยันอายุสำเร็จแล้วไม่ต้องยืนยันซ้ำ\");";
        echo "window.history.back()";
        echo "</script>";
      }
      else{
        Header("Location: verificationform.php"); 
      }  
?>      