<?php
session_start();
include('connection.php');
?>
  
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>penname</title>
      <link rel="stylesheet" href="CSS/Home.css">
      <link rel="stylesheet" href="CSS/MyPenname.css">
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
				  <a style="position:absolute; top:13px; right:10px;" class="dropbtn"><?php 
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

<?php
  if(empty($_GET['accountID'])) $accountID = $_SESSION['UserID']; else $accountID = $_GET['accountID'];
  $query = "SELECT p.PenID,p.PenName
  FROM account a,penname p where p.AccountID = a.AccountID 
  and a.AccountID = '$accountID'";
  $result2 = mysqli_query($con, $query);
?>
      <div class="all">
        <h1>My Penname</h1>
      
        <?php 
          // print_r($result1); 
            foreach( $result2 as $row ) {
            echo "<a href='PenNameDetail.php?penID=" . $row['PenID'] . " '>• " . $row['PenName'] . "</a>" . "<br><br>";
          }
        ?>
        <h3><a href="PenNameFrom.php" >จัดการนามปากกา</a></h3>
      </div>
    </body>
  </html>