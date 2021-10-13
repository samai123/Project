<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    include('connection.php');
    $NovelName = $_POST['NovelName'];
    $Category = mysqli_real_escape_string($con, $_POST['Category']);
    $Rate = mysqli_real_escape_string($con, $_POST['Rate']);
    $PenID = mysqli_real_escape_string($con, $_POST['PenName']);
    $End = mysqli_real_escape_string($con, $_POST['Type']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $Publish = date("Y-m-d H:i:s");
    
    $query = "SELECT NovelName from novel where NovelName = '$NovelName'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
    
    if(isset($row["NovelName"]))
	{
		echo "<script>";
        echo "alert(\"Novelname ซ้ำ\");";
        echo "history.go(-1);close();</script>";
	}
    else{
        $sql = "INSERT INTO Novel
            VALUES(NULL,'$NovelName',$PenID,$Category,$Rate,$End,'$Publish','$Publish');";
    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

        $find = "SELECT NovelID FROM Novel WHERE NovelName='$NovelName';";
        $result = mysqli_query($con,$find);
        $row = mysqli_fetch_array($result);
        $NovelID = $row['NovelID'];

        if($End==1){
        $insert = "INSERT INTO chapter
                    VALUES ($NovelID, 1, '$NovelName', '$content');";
        if (!mysqli_query($con,$insert)) {
            die('Error: ' . mysqli_error($con));
        }
    }
    echo "<script>";
    echo "alert(\"Success\");";
    echo "location.href='MyPage.php'</script>";
    }

    
?>