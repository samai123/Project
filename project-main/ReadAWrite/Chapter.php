<?php 
session_start();
include('connection.php');
$novelID = $_GET['novelID'];
$chapnum = $_GET['chapnum'];
$readtime = date("Y-m-d H:i:s");
// echo $novelID . $chapnum;
if(empty($_SESSION['UserID'])){ 
  ?>
  <!doctype html>
  <html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>novel</title>
      <link rel="stylesheet" href="CSS/chapter.css">
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
<?php }else{
  $id = $_SESSION["UserID"]; 
  ?>
<!DOCTYPE html>
    <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>chapter</title>
          <link rel="stylesheet" href="CSS/chapter.css">
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
			        <a style="position:absolute; top:13px; right:10px;" class="dropbtn"><a style="position:absolute; top:13px; right:10px;" class="dropbtn">
					    <?php 
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
<?php }
$query = " SELECT * from chapter where NovelID = $novelID and ChapterNumber = $chapnum";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$chapname = $row["ChapterName"];
$story = $row["Story"];
$query = "SELECT a.ShowName,co.CommentContent,co.CommentTime
from comment co,account a
where co.NovelID = $novelID and co.ChapterNumber = $chapnum and
co.accountID = a.accountID";
$result1 = mysqli_query($con, $query);
$query = " SELECT count(ChapterNumber) as ChapterCount from chapter where NovelID = $novelID group by NovelID ";
$result2 = mysqli_query($con, $query);
$row = mysqli_fetch_array($result2);
$chapcount = $row["ChapterCount"];
$query = " SELECT n.NovelName,p.PenName from novel n,penname p 
where n.NovelID = $novelID and n.PenID = p.PenID ";
$result3 = mysqli_query($con, $query);
$row = mysqli_fetch_array($result3);
$novelname = $row["NovelName"];
$penname = $row["PenName"];
?>
            <div>
            <?php 
               
                echo "<div class = 'main_box'> <div class = 'head_NV'> ชื่อเรื่อง : " . $novelname .
                 "<h1>" .$chapname. "</h1>ผู้แต่ง :" . $penname ."</div><p>" .$story. "</p><br><br>";
            ?>
            <?php 
              if($chapnum!=1){
            ?>
            <div class = 'mycenter'>
              <div class = "button1"><a href = "Viewing.php?chapnum=<?php echo $chapnum-1 ?>&novelID=<?php echo $novelID ?>">ตอนก่อนหน้า</a></div>
              <?php 
                }else{
                  ?>
                  <div class = "button1"><a></a></div>
                  <?php 
                }
              ?>
              <div class = "button2"><a href = "Novel.php?novelID=<?php echo $novelID ?>">กลับสู่หน้าหลัก</a></div>
              <?php 
                if($chapnum!=$chapcount){
              ?>
              <div class = "button3"><a href = "Viewing.php?chapnum=<?php echo $chapnum+1 ?>&novelID=<?php echo $novelID ?>">ตอนต่อไป</a></div>
              <?php 
                }else{
                  ?>
                  <div class = "button3"><a></a></div>
                  <?php 
                }
              ?>
              </div>
            </div>
            <?php
            if(isset($_SESSION['UserID'])){
              echo "<div class = 'main_box'>
              <form id='CommentForm' action='Comment.php?novelID=" .  $novelID
              ."&chapnum=" . $chapnum . "' method='post'>
              <div class = comment> comment </div> <br>
              <textarea name='comment' id='comment' required ></textarea>
              </from><br>
              <button type='submit' form='CommentForm'>submit</button>
              </div>";
            }else{
              echo "<div class = 'main_box'>
              <div class=comment ><a href='LoginForm.php'>Login</a> เพื่อ comment</div> <br>
              </div>";
            }

            foreach( $result1 as $row )
            {
              echo "<div class = 'main_boxc'><a>" . $row['ShowName']  ."</a><a style = 'color : gray;'>". $row['CommentTime'] . "</a><br><a>" . $row['CommentContent'] ."</a></div>";
            }
            ?>
        </body>
	<html>