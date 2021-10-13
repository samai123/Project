<?php
    include('ReadAWrite/connection.php');
    $file = addslashes(file_get_contents("ReadAWrite/image_nav/tiny.jpg"));
    $query = "SELECT ProfileImage FROM Account WHERE AccountID=0";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    if(empty($row['ProfileImage'])){
        $sql= "UPDATE Account SET ProfileImage='$file'";
        mysqli_query($con,$sql);
    }
    date_default_timezone_set("Asia/Bangkok");
?>
<html>
    <head>
        <link rel="stylesheet" href="ReadAWrite/CSS/Start.css">
    </head>
    <body>
        <div class="myl">
            <img src="ReadAWrite/image_nav/RAW-Login_v3@2x.png">
        </div>
        <div class="myr">
            <img src="ReadAWrite/image_nav/readawrite-logo-svg.svg">
            <p>
                นิยาย นิยายออนไลน์<br>แหล่งกบดานใหม่<br>
                สำหรับผู้ที่รักการอ่านและเขียน<br><br>
                <a href="ReadAWrite/unknown_homepage.php">เข้าสู่หน้าเว็บไซต์</a>
            </p>
        </div>
    </body>
</html>

<!-- UNDONE: Novel ชื่อไม่ซ้ำ -->
<!-- UNDONE: Username ชื่อไม่ซ้ำ -->

<!-- BUG: admin_homepage -->
<!-- BUG: analyreport/amountofdonate -->

<!-- TODO: หน้า Novel แสดง top donater -->

<!-- FIXME: เปลี่ยน con ให้มา่จาก connection ทั้งหมด -->
<!-- FIXME: แก้ checkbox ในหน้า topup -->
<!-- FIXME: แก้ checkbox ในหน้า donate -->

<!-- HACK: regis แบบ username ไม่ซ้ำ -->