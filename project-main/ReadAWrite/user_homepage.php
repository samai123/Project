<?php session_start(); ?>
<?php
if (empty($_SESSION['UserID'])) {
	Header("Location: LoginForm.php");
} else {
?>
	<!doctype html>
	<html>

	<head>
		<title>Home</title>
		<link rel="stylesheet" href="CSS/Home.css">
		<link rel="stylesheet" href="CSS/topview.css">
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
	<?php }
$cate =  "SELECT novel.*,category.*,penname.AccountID,penname.PenName,count(viewing.ViewID) as viewcount
	 FROM category 
	 INNER JOIN novel ON novel.CategoryID = category.CategoryID
	 INNER JOIN penname ON novel.PenID = penname.PenID 
	 LEFT JOIN viewing ON novel.NovelID = viewing.NovelID
     GROUP BY novel.NovelID
	 ORDER BY viewcount DESC";
$result_c = mysqli_query($con, $cate);
$query  = "SELECT * from category";
$result = mysqli_query($con, $query);
	?>

	<h1>Top View</h1>
	<div class="cate">
		<?php
		$i = 1;
		while ($row_c = mysqli_fetch_array($result_c) and $i < 6) {
			echo '<div class = "myboxtop" ">';
			echo '<div class = "labeltop">';
			echo "&nbsp Top " . $i . "   ";
			echo '</div>';
			echo '<div class = "mybox" ">';
			echo "<h4><a href='Novel.php?novelID=" . $row_c['NovelID'] . " '>$row_c[NovelName]</a></h4>";
			echo '<div ">';
			echo "<a href='MyPage.php?accountID=" . $row_c['AccountID'] . " '>$row_c[PenName]</a>" . '<br>';
			echo '</div>';
			echo "<a href='NovelCategory.php?CategoryID=" . $row_c['CategoryID'] . " '>$row_c[CategoryName]</a>" . '<br>';
			echo '<a style = "color : grey">';
			echo "view : " . $row_c['viewcount'] . '</a><br>';
			echo '</div>';
			echo '</div>';
			$i++;
		}
		?>
	</div>
	<?php
	$j = 1;
	while ($category = mysqli_fetch_array($result) and $j < 5) {
		$i = 1;
		$result_c = mysqli_query($con, $cate);
		echo "<h1>Top " . $category['CategoryName'] . "</h1>";
		echo '<div class="cate">';
		while ($row_c = mysqli_fetch_array($result_c) and $i < 5) {
			if ($row_c['CategoryID'] == $j) {
				echo '<div class = "myboxtop" ">';
				echo '<div class = "labeltop">';
				echo "&nbsp Top " . $i . "   ";
				echo '</div>';
				echo '<div class = "mybox" ">';
				echo "<h4><a href='Novel.php?novelID=" . $row_c['NovelID'] . " '>$row_c[NovelName]</a></h4>";
				echo '<div ">';
				echo "<a href='MyPage.php?accountID=" . $row_c['AccountID'] . " '>$row_c[PenName]</a>" . '<br>';
				echo '</div>';
				echo "<a href='NovelCategory.php?CategoryID=" . $row_c['CategoryID'] . " '>$row_c[CategoryName]</a>" . '<br>';
				echo '<a style = "color : grey">';
				echo "view : " . $row_c['viewcount'] . '</a><br>';
				echo '</div>';
				echo '</div>';
				$i++;
			}
		}
		$j++;
		echo '</div>';
	}
	?>
	</body>

	</html>