<?php session_start();?>
<?php
    include('connection.php');
    $id = $_SESSION["UserID"]; //อัปโหลดลง database
    if(isset($_POST['upload']) && !empty($_FILES['pfimg']['tmp_name'])){
        $file =  addslashes(file_get_contents($_FILES["pfimg"]["tmp_name"]));
        $sql = "UPDATE account SET ProfileImage = '$file' WHERE AccountID = '$id'";
        $sql_run = mysqli_query($con, $sql);
        if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
        }
        else{
            header("Location: changeprofilefrom.php");
        }
    }
    else{
        echo "<script>";
        echo "alert(\"ยังไม่ได้เลือกไฟล์ภาพ\");";
        echo "window.history.back()";
        echo "</script>";
    }
?>