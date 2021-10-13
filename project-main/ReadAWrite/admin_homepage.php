<?php 
session_start();
if (isset($_SESSION['UserID']) and $_SESSION['UserID']==0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminhome</title>
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/adminhome.css">
</head>
<body>
    <nav class="navbar">
        <div>
            <ul>
                <li><a href="admin_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
            </ul>
        </div>
    </nav>
    <div class="all"> 
        <div class="topa">    
            <table>
            <br><label>Admin</lable></div>       
                <div class="veri">    
                    <p><a href="Adminform.php">Verification check</a></p></div>
                <div class="donate">
                    <p><a href="AdminDonateSelect.php">Donation check</a></p></div>
                <div class="logout">
                <p><a href="logout.php">Logout</a></p><br>
            </table>
        </div>
    </div>
</body>
</html>
<?php
}else{
    Header("Location: LoginForm.php");
} ?>