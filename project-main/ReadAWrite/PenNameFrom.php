<?php session_start();
include('connection.php');
?>

<?php if (empty($_SESSION['UserID'])) { ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="CSS/penNameFrom.css">
    <link rel="stylesheet" href="CSS/Home.css">
</head>

<body>
    <nav class="navbar">
        <div style="position:absolute; left:10px">
            <ul>
                <li><a href="unknown_homepage.php">Home</a></li>
                <li><a href="Category.php">Category</a></li>
            </ul>
        </div>
        <div>
            <ul>
                <li><a href="unknown_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
            </ul>
        </div>
        <div>
            <ul>
                <li><a href="LoginForm.php" style="position:absolute; top:13px; right:10px;" class="dropbtn">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php } else { ?>
    <!doctype html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
        <link rel="stylesheet" href="CSS/penNameFrom.css">
        <link rel="stylesheet" href="CSS/Home.css">
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
					$sth = $con->query($sql);
					$row = mysqli_fetch_array($sth);
					echo '<img  style="border-radius:50%;width:32px;height:32px;" src="data:image/jpg;base64,' . base64_encode($row['ProfileImage']) . '"/>';
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
        <?php } ?>

        <?php
		if (empty($_SESSION['UserID'])) {
			Header("Location: LoginForm.php");
		} else {
			$accountID = $_SESSION['UserID'];
			$showname = $_SESSION['User'];
			$query = "SELECT PenID,PenName FROM penname WHERE AccountID = '$accountID'";
			$result = mysqli_query($con, $query);
		?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Penname</title>
        </head>

        <div class="out_box">
            <form name="inpfrm" method="post" action="PenName.php">
                <!-- จัดการนามปากกา -->
                <div class="tiny_box">
                    <h2> จัดการนามปากกา </h2>
                    <h3> เพิ่มนามปากกา &nbsp;
                        <input class="box" type="text" id="PenName" name="PenName" required>
                    </h3>
                    <input name="Create" type="submit" id="Create" value="ยืนยัน" class="forbtn"/>
                </div>
            </form>
            <!-- ดูนามปากกา -->
            <div class="tiny_box">
                <h3> นามปากกา </h3>
                <?php
					foreach ($result as $row) {
						echo "<a href='PenNameDetail.php?penID=" . $row['PenID'] . " '>" . $row['PenName'] . "</a>" . "<br><br>";
				?>
				<button id="editbtn" name="editbtn" onclick="document.getElementById('<?php echo $row['PenID'] ?>popup').style.display = 'block'">Change</button>	
				<a href="PenNameUpdate.php?penID=<?php echo $row['PenID']; ?>&type=0">
					<button name="delete" id="delete" >Delete</button><br><br>
				</a>
				<div id="<?php echo $row['PenID'] . "popup"; ?>" class="modal">
					<div class="modal-content">
					<span class="close" id="closebtn" onclick="document.getElementById('<?php echo $row['PenID'] ?>popup').style.display = 'none'">&times;</span>
					<div class="pleasecenter"><p>แก้ไขนามปากกา: <?php echo $row['PenName'] ?></p>
					<form id="penupdate" action="PenNameUpdate.php?penID=<?php echo $row['PenID']; ?>&type=1"
                                method="post" >
                        <div class="simpledata">
                            <input type="text" name="PenName" placeholder="" /><br>
                        </div> 
						<button type="submit" id="edit penname" name="edit penname">ยืนยันการแก้ไข</button>
                        <br>
                    </form>
					</div>
					</div>
				</div>
                <?php } ?>
            </div>
        </div>

        </html>
        <?php } ?>