<?php 
session_start();
$con=mysqli_connect("localhost","root","","project");
$novelID = $_GET['novelID'];
// echo $novelname;
if(empty($_SESSION['UserID'])){ 
  $id = 0;
  ?>
  <!doctype html>
  <html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>novel</title>
      <link rel="stylesheet" href="CSS/Home.css">
      <link rel="stylesheet" href="CSS/novel.css">
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
          <title>novel</title>
          <link rel="stylesheet" href="CSS/Home.css">
          <link rel="stylesheet" href="CSS/novel.css">
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
  $query = "SELECT AgeVerification from verification where AccountID = '$id'";
  $result_c = mysqli_query($con, $query);
  $row = mysqli_fetch_array($result_c);
  if(isset($row['AgeVerification'])) $ageverifi = $row['AgeVerification']; else $ageverifi = 0; 
  $query = "SELECT DISTINCT s.AccountID,s.NovelID
  FROM account a,shelfhistory s,novel n where n.NovelID = s.NovelID 
  and n.NovelID = '$novelID' and s.AccountID = '$id'";
  $result3 = mysqli_query($con, $query);
}
  $query = " SELECT DISTINCT n.*,p.PenID,p.PenName,sum(DonateAmount) as sumDonate 
  from penname p
  LEFT JOIN novel n on p.PenID = n.PenID
  LEFT JOIN donate d on n.NovelID = d.NovelID
  where n.NovelID = '$novelID'";
  $result = mysqli_query($con, $query);
  $query = "SELECT DISTINCT n.NovelID,c.ChapterNumber,c.ChapterName,count(v.ViewID) as chapview
  FROM novel n
  LEFT JOIN chapter c on n.NovelID = c.NovelID
  LEFT JOIN viewing v on c.ChapterNumber = v.ChapterNumber and c.NovelID = v.NovelID
  where n.NovelID = '$novelID'
  group by c.ChapterNumber";
  $result1 = mysqli_query($con, $query);
  $query = "SELECT v.ViewID
  FROM novel n,viewing v where n.NovelID = v.NovelID 
  and n.NovelID = '$novelID'";
  $result2 = mysqli_query($con, $query);
  if(isset($result1)) {
    $row_c = mysqli_fetch_array($result1);
    if(isset($row_c['ChapterNumber']))
    $chapcount = $result1->num_rows; 
    else $chapcount = 0;
  }
  if(isset($result2)) $viewcount = $result2->num_rows; else $viewcount = 0;
  $query = "SELECT DISTINCT p.AccountID,a.BankNumber
  FROM account a,penname p,novel n where n.PenID = p.PenID
  and a.accountID = p.accountID and n.NovelID = '$novelID'";
  $result4 = mysqli_query($con, $query);
  $writer = mysqli_fetch_array($result4);
  
?>
          <?php 
          //print_r($result3); 
            foreach($result as $row) {
              echo "<div class=all>".
              "<div class=one>".'<br>'.
              "<div class=novelname>".$row["NovelName"].
              "</div><div class=penname><a href='MyPage.php?accountID=" 
               . $writer['AccountID'] ." '>" . $row['PenName'] . 
               "</a></div><div class=lastedit>"."Lastupdate : ".$row["LastEditDateTime"]."</div></div>
               <div class=two><div class=chapcount>จำนวน ".$chapcount." ตอน".'<br>'. "อ่าน " . $viewcount." ครั้ง</div>";
              if($row['Rate'] == 1){
                if(empty($_SESSION['UserID']) or $ageverifi != 1){
                  echo "<script type='text/javascript'> alert(\"เรื่องนี้เป็นนิยาย 18+ ท่านอาจจะยังไม่ได้ยืนยันอายุ อายุไม่ถึง หรือยังไม่ได้ log in ค่ะ\");history.go(-1);</script>";
                }
              }
              if(isset($row['sumDonate'])) {
                $sumDonate = $row['sumDonate']; 
              }else{
                $sumDonate = 0;  
              }
            }

            if(isset($_SESSION['UserID'])){
              echo "<div class=buttonshelf>
              <form id='ShelfForm' action='AddShelf.php?novelID=" .  $novelID
              . "' method='post'>";
              if($result3->num_rows > 0){
                echo "<button type='submit' form='ShelfForm'>remove from shelf</button>";
              }
              else{
                echo "<button type='submit' form='ShelfForm'>add to shelf</button>";
              }
              echo "</form></div>";
            }
            echo "</div></div></div>";
            echo "<br>";
            echo "<div class=three>";    
            echo "<div class=chap>";   
            echo '<br>'."Chapter".'<br>'.'<br>';  
            echo  "</div>";
            foreach( $result1 as $row ) {
              if(isset($row['ChapterNumber'])){
              echo "<hr><br><div class=chapterdetail>".$row['ChapterNumber'] .") "." ". "<a href='Viewing.php?chapnum=" . $row['ChapterNumber'] . 
              "&novelID=" . $row['NovelID'] . "' >" . $row['ChapterName'] . "</a><div class=view><br>view : " . $row['chapview'] . "</div></div>".
              '<br>';
              }
            }
            echo "</div></div>";
            if(isset($writer['BankNumber'])){
          ?> 
        <div class="totaldonate">ยอดโดเนทรวม : <?php echo $sumDonate ?> บาท </div>
        <div class="donatebtn">
        <?php if(isset($_SESSION['UserID'])){ 
          echo "<form id='DonateForm' action='donatefrom.php?novelID=" .  $novelID . "' method='post'>";
          echo "<button type='submit' form='DonateForm'>Donate</button></form>";
        ?>
        </div>
        <?php }} ?>
      
       </body>
	<html>

   
