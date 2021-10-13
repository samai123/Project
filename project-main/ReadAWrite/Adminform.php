<?php
session_start();
include('connection.php');
if($_SESSION['UserID']!=0){
    Header("Location:LoginForm.php");
}else{
    $query = "SELECT AccountID,IDCardPic from verification 
    where AgeVerification is null";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminhome</title>
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/AdminForm.css">
</head>
<body>
    <nav class="navbar">
        <div>
            <ul>
                <li><a href="admin_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
            </ul>
        </div>
    </nav>

    <br>
    <br>
    <form name="AdminForm" action="Admin.php" method="post">
    <?php
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "<tr>";
        echo "<th>AccountID</th> ";
        echo "<th>Picture</th> ";	
        echo "<th>Check</th> ";	
        echo "</tr>";
        foreach( $result as $row ) {
            echo "<tr>";
            echo "<td>" . $row["AccountID"] ."</td> ";
            echo "<td><img  style= 'width: 200px; height: 200px' src='data:image/jpg;base64," . base64_encode( $row['IDCardPic'] ) . "'</td>";
            echo "<td><input type='radio' name=". $row["AccountID"] ." id='Type' value=1>ผ่าน
            <input type='radio' name=". $row["AccountID"] ." id='Type' value=0>ไม่ผ่าน";
            echo "</tr>";   
        }
        echo "</table>";
        echo "<br><div align = 'center'><button type='submit'>submit</button>";
    ?>
    <a href="admin_homepage.php" ><input type="button" value="Back"></a></div>
    </form>
    <br>
</body>
</html>
<?php }?> 