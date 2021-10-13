<?php session_start();?>
<?php
    include('connection.php');
    $id = $_SESSION["UserID"];
    $data = "SELECT * FROM account WHERE AccountID = '$id'";
    $result = mysqli_query($con, $data);
    $row = mysqli_fetch_array($result);

    $cate =  "SELECT novel.*,category.*,shelfhistory.*,penname.PenName,penname.AccountID as pAccountID
              FROM category 
              INNER JOIN novel ON novel.CategoryID = category.CategoryID
              INNER JOIN penname ON novel.PenID = penname.PenID 
              INNER JOIN shelfhistory ON shelfhistory.NovelID = novel.NovelID
              ORDER BY shelfhistory.AddShelfDateTime"; 
    $result_c = mysqli_query($con, $cate);    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHELF</title>
    <link rel="stylesheet" href="CSS/Home.css">	
    <link rel = "stylesheet" href ="CSS/shelf.css">
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

    <div class=nameshelf>
    <label>ชั้นหนังสือของฉัน</lable></div>
  <div class=bookdetail>  
    <?php
  $i = 1;  
  while($row_c = mysqli_fetch_array($result_c))
  {
      if($row_c['AccountID'] == $id){
           echo '<div class="nname">';
           echo "$i)"."     "; 
           echo "<a href='Novel.php?novelID=" . $row_c['NovelID'] . " '>$row_c[NovelName]</a>" . '<br>';
           echo '</div>';
           echo '<div class="pname">';
           echo "<a href='MyPage.php?accountID=" . $row_c['pAccountID'] . " '>$row_c[PenName]</a>" . '<br>';
           echo '</div>';
           echo '<div class="category">';
           echo "<a href='NovelCategory.php?CategoryID=" . $row_c['CategoryID'] . " '>$row_c[CategoryName]</a>" . '<br>';
           echo '</div>';
           echo '<div class="time">';
           echo "$row_c[AddShelfDateTime]" . '<br>'. '<br>';
           echo '</div>';
           $i++;
      }
  }
       
    ?>
  </div>  
</body>
</html>