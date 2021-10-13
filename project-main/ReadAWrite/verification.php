<?php session_start();?>
<?php
    date_default_timezone_set("Asia/Bangkok");
    $con = mysqli_connect("localhost","root","","project");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if(isset($_POST['upload']) && !empty($_FILES['img']['tmp_name'])){
        $file =  addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
        $date = date('Y-m-d h:i:s');
        $id = $_SESSION["UserID"];
        $sql = "REPLACE INTO verification(AccountID, IDCardPic, SendDateTime) 
        VALUE ('$id', '$file', '$date')";
        $sql_run = mysqli_query($con, $sql);
        if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
        }
        else{
            echo "<script>";
		    echo "alert(\"upload สำเร็จ\");";
            echo "window.history.go(-2)";
            echo "</script>";
        }
    }else{
        echo "<script>";
		echo "alert(\"ยังไม่ได้เลือกไฟล์ภาพ\");";
		echo "window.history.back()";
		echo "</script>";
    }
?>

