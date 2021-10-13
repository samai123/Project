<?php include('connection.php'); ?>
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
<?php
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