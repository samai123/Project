<?php 
    session_start();
    include('connection.php'); ?>
<html>
    <head>
        <link rel='stylesheet' href='CSS/Home.css'>
        <title>Create Novel</title>
        <link rel='stylesheet' href='CSS/CNovel.css'>
        <link rel="icon" href="image_nav/ReadChat.png">
    </head>
    <body>
        <nav class="navbar">
            <div style="position:absolute; left:10px">
                <ul>
                    <li><a href="user_homepage.php">Home</a></li>
                    <li><a href="Category.php">Category</a></li>
                    <li><a href="MyShelf.php">My shelf</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><a href="user_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
                </ul>
            </div>
            <div class="dropdown" style="margin-bottom:80px;">
                <a style="position:absolute; top:13px; right:10px;" class="dropbtn">
                <?php 
                    include('connection.php');
                    $id = $_SESSION["UserID"];
                    $sql = "SELECT ProfileImage,Balance FROM account WHERE AccountID = '$id'";
                    $sth = $con -> query($sql);
                    $row = mysqli_fetch_array($sth);
                    echo '<img  style="border-radius:50%;width:32px;height:32px;" src="data:image/jpg;base64,'.base64_encode( $row['ProfileImage'] ).'"/>';					
                ?>
                Profile</a>
                <div class="dropdown-content" st>
                    <a>Balance : <?php echo $row['Balance'] ?></a>
                    <a href="MyPage.php">My Page</a>
                    <a href="MyPenname.php">My Penname</a>
                    <a href="changeprofilefrom.php">Edit Profile</a>
					<a href="topupform.php">Topup</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <div class="box">
        <form id="form1" name="CreateNovelForm" action="CreateNovel.php" target="_blank" method="post">
            <p class="label">ชื่อเรื่อง (ไม่เกิน 120 ตัวอักษร)<br>
                <input name="NovelName" type="text" id="NovelName" maxlength="120" required>
            </p>
            <p>
                <select class="one" name="Category" id="Category" required>
                    <option selected disabled hidden value="">ประเภทนิยาย*</option>
                    <option value=1>แฟนตาซี</option>
                    <option value=2>นิยายรัก</option>
                    <option value=3>สยองขวัญ</option>
                    <option value=4>สืบสวนสอบสวน</option>
                </select>
                <select class="two" name="Rate" id="Rate" required>
                    <option selected disabled hidden value="">เรตอายุ*</option>
                    <option value=0>ทั่วไป</option>
                    <option value=1>18+</option>
                </select>
            </p>
            <p class="label">นามปากกา<br>
                <select class="three" name="PenName" id="PenName" required>
                    <option selected disabled hidden value="">นามปากกา*</option>
                <?php
                    $id = $_SESSION["UserID"];
                    $sql = "SELECT PenName, PenID from penname WHERE AccountID='$id'";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)){
                        $pen = $row['PenID'];
                        $name = $row['PenName'];
                        echo '<option value=';
                        echo $pen;
                        echo '>';
                        echo $name;
                        echo '</option>';
                    }
                ?>
                </select><br>
                <a href="PenNameFrom.php">จัดการนามปากกา</a>
            </p>
            <p>
                <p class="label">จำนวนตอน</p>
                <input type="radio" name="Type" id="Type1" value=0 checked onclick="myFunction()">มีหลายตอน
                <input type="radio" name="Type" id="Type2" value=1 onclick="myFunction()">ตอนเดียวจบ
            </p>
            <button type="submit" id="save" class="mybutton">บันทึกนิยาย</button>
        </form>
        </div>
        <div id="element" style="display:none" class="FChap">
            <div>
                <h1>เนื้อหา</h1>
            </div>
            <textarea name="content" id="content" form="form1"></textarea>
            <button type="submit" class="mybutton" form="form1">บันทึกนิยาย</button>
        </div>
        <script>
            function myFunction() {
                var checkBox = document.getElementById("Type2");
                var element = document.getElementById("element");
                var save = document.getElementById("save");
                var content = document.getElementById("content");
                if (checkBox.checked == true){
                    element.style.display = "block";
                    save.style.display = "none";
                    content.setAttribute("required", "");
                }else{
                    element.style.display = "none";
                    save.style.display = "block";
                    content.removeAttribute('required');
                }
            }
        </script>
    </body>
</html>