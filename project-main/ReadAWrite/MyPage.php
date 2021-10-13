<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "project");
if(empty($_SESSION['UserID'])){ 
  ?>
  <!doctype html>
  <html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>novel</title>
      <link rel="stylesheet" href="CSS/Mypage.css">
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
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page</title>
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/Mypage.css">
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
        <a style="position:absolute; top:13px; right:10px;" class="dropbtn"><a style="position:absolute; top:13px; right:10px;" class="dropbtn"><a style="position:absolute; top:13px; right:10px;" class="dropbtn">
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
if(empty($_GET['accountID'])) $accountID = $_SESSION['UserID']; else $accountID = $_GET['accountID'];
$query = "SELECT DISTINCT p.PenID, n.novelID
FROM account a,novel n,penname p where n.PenID = p.PenID 
and p.AccountID = a.AccountID and a.AccountID = '$accountID'";
$result = mysqli_query($con, $query);

$query = "SELECT DISTINCT p.PenID, f.accountID 
FROM account a,follow f,penname p where f.PenID = p.PenID 
and p.AccountID = a.AccountID and a.AccountID = '$accountID'";
$result1 = mysqli_query($con, $query);

$query = "SELECT DISTINCT a.AccountID,p.PenID, p.PenName,n.NovelID, n.NovelName
,n.PublishDateTime , count(ChapterNumber) as ChapterCount
FROM account a
LEFT JOIN penname p on a.AccountID = p.AccountID
LEFT JOIN novel n on n.PenID = p.PenID
LEFT JOIN chapter c on n.NovelID = c.NovelID
where a.AccountID = '$accountID'
group by n.novelID";
$result2 = mysqli_query($con, $query);

$query = "SELECT ShowName from account where AccountID = '$accountID'";
$result3 = mysqli_query($con, $query);
$row = mysqli_fetch_array($result3);
$showname = $row["ShowName"];

?>

      <div class="main_box">
        <h1>My Page</h1>
      <?php
      include('connection.php');
      $sql = "SELECT ProfileImage FROM account WHERE AccountID = '$accountID'";
      $sth = $con->query($sql);
      $row = mysqli_fetch_array($sth);
      echo "<div class = showname>";
      echo '<img  style="width: 200px; height: 200px; border-radius: 20px;" src="data:image/jpg;base64,' . base64_encode($row['ProfileImage']) . '"/><br>';
      echo "<a style = 'font-size : 30px;'>".$showname . "</a>";
      echo "</div>";
      // print_r($result4);  
      ?>
      <span>
        <br>
        <?php
        if ($_SESSION['UserID'] == 0) {
          echo "<br><a href='adminform.php'>Verification</a><br>";}
        ?>
        <br>
        <?php
        echo "writing : " . $result->num_rows ." ";
        echo "follow : " . $result1->num_rows ;
        ?>
        <p><a style="color: rgb(47, 124, 124);" href='MyPenname.php?accountID=<?php echo $accountID; ?>'>Penname List...</a></p>
      </span>
    </div>
    <div class="main_box">
    <h1>writing</h1>
    <div class="novel">
      <?php
      foreach ($result2 as $row) {
          if(isset($row['NovelID'])){
          echo "<hr><a href='Novel.php?novelID=" . $row['NovelID'] . " '>" . $row["NovelName"] .
            "</a>";
          if(isset($_SESSION['UserID'])){
            if($id == $accountID){
              echo " <a href = 'NovelDelete.php?novelID=".$row['NovelID']."'><button name='delete' id='delete'>Delete
              </button></a>";
            }
          }
          echo "<br>Penname : <a href='PenNameDetail.php?penID="  . $row['PenID'] . " '>" . $row['PenName'] . "</a>"
            . "<br>Chapter : " . $row["ChapterCount"] . "<br>first public : " . $row["PublishDateTime"] . "<br>";
        }
      }
      ?>
      <h3><a style="color: rgb(47, 124, 124);" href="CreateNovelForm.php" class="mylink">สร้างนิยายสักเรื่อง...</a></h3>
    </div>
</div>
  </body>

  </html>
