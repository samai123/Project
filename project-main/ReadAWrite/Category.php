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
        <link rel="stylesheet" href="CSS/Category.css">
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
            <title>Category</title>
            <link rel="stylesheet" href="CSS/Category.css">
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

        <div class="main_content">
            <p><h1>Category</h1>
                <div class = "text_link">
                    <table>
                        <tr>
                            <td>
                                <a href='NovelCategory.php?CategoryID=1'><img class="image" src="image_category/fancy.png"><span> Fantasy </span></a>
                            </td>
                            <td>
                                <a href='NovelCategory.php?CategoryID=2'><img class="image" src="image_category/romance.png"><span> Romance </span></a>                 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href='NovelCategory.php?CategoryID=3'><img class="image" src="image_category/horror.png"><span> Horror </span></a>
                            </td>
                            <td>
                                <a href='NovelCategory.php?CategoryID=4'><img class="image" src="image_category/Detective.png"><span> Detective </span></a>
                            </td>
                        </tr>
                    </table>
                 
                </div>
            </p>   
        </div>     
    </body>
    </html>