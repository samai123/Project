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
		<title>NovelCategory</title>
        <link rel="stylesheet" href="CSS/NCategory.css">
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
                    <li><a href="LoginForm.php" style="position:absolute; top:13px; right:10px;" class="dropbtn">Login</a></li>
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
            <link rel="stylesheet" href="CSS/NCategory.css">
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
        <?php } ?>

<?php
$CategoryID = $_GET['CategoryID'];
$query = "SELECT n.categoryID,p.AccountID, p.PenName,n.NovelID, n.NovelName,n.PublishDateTime , count(ChapterNumber) as ChapterCount 
FROM novel n
left join penname p on n.PenID = p.PenID
left join chapter c on n.NovelID = c.NovelID
WHERE n.categoryID = '$CategoryID' 
group by n.novelID ";

$result = mysqli_query($con, $query);
?> 

	<div class="novel_box">

	<?php
		foreach( $result as $row ) {
            echo "<p class='mybox'> <a href='Novel.php?novelID=" . $row['NovelID'] . " '>" . $row["NovelName"] . 
            "</a><br> <a>Penname : <a href='MyPage.php?accountID="  . $row['AccountID'] . " '>" . $row['PenName'] . "</a><br>Chapter : " . 
            $row["ChapterCount"] . "<br>first public : " . $row["PublishDateTime"] . "</p>";
          }
	?>

	</div>

</body>
</html>

