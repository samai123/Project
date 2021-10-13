<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "project");
$penID = $_GET['penID'];
// echo $penname;
if (empty($_SESSION['UserID'])) { ?>
  <!doctype html>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>novel</title>
    <link rel="stylesheet" href="CSS/PenNameDetail.css">
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
  <?php } else {
  $id = $_SESSION["UserID"]; ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>penname</title>
      <link rel="stylesheet" href="CSS/Home.css">
      <link rel="stylesheet" href="CSS/PenNameDetail.css">
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
  $query = "SELECT DISTINCT p.PenID,p.PenName, n.novelID
  FROM penname p
  LEFT JOIN novel n on n.PenID = p.PenID 
  where p.PenID = '$penID'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result);
  if(isset($row['novelID'])) $writing = $result->num_rows; else $writing = 0;
  $query = "SELECT DISTINCT PenID,count(FollowID) as folcount
  FROM follow where PenID = '$penID'
  group by PenID";
  $result1 = mysqli_query($con, $query);
  $query = "SELECT DISTINCT p.PenName,n.NovelID, n.NovelName,n.PublishDateTime , count(c.ChapterNumber) as ChapterCount
  FROM chapter c,novel n,penname p where c.novelID = n.novelID 
  and n.PenID = p.PenID and p.PenID = '$penID' group by n.novelID";
  $result2 = mysqli_query($con, $query);
  foreach ($result as $row) {
    $penname = $row['PenName'];
  }
    ?>

    <div class="main_box">
      <h3>PenName :
      <B><?php echo $penname ?></B></h3>
      <?php
      if (isset($_SESSION['UserID'])) {
        $query = "SELECT DISTINCT FollowID FROM follow where PenID = '$penID' and accountID = '$id'";
        $result3 = mysqli_query($con, $query);
      ?>
          <form id='FollowForm' action='follow.php?penID=<?php echo $penID ?>' method='post'>
          <?php if ($result3->num_rows > 0) { ?> <button type='submit' form='FollowForm'>unfollow</button>
          <?php } else { ?><button type='submit' form='FollowForm'>follow</button>
        
    <?php } ?>
    </form>
    <?php } ?>
    <span> 
      <br>
      <?php
      echo "writing : " . $writing;
      ?>
    </span>
    <span>
      <?php
      if ($result1->num_rows > 0) {
        foreach ($result1 as $row) echo "follow : " . $row['folcount'];
      } else {
        echo "follow : 0";
      }
      ?>
    </div>
    </span>

    <div class="main_box">
      <h1>Writing</h1>
      <?php
      foreach ($result2 as $row) {
        echo "<hr><a href='Novel.php?novelID=" . $row['NovelID'] . " '>" . $row["NovelName"] .
          "</a><p>Chapter : " . $row["ChapterCount"] . "</p><p>first public : " . $row["PublishDateTime"] . "</p>";
      }
      ?>
    </div>
    </body>
    <html>