<?php
session_start();
include('connection.php');
if($_SESSION['UserID']!=0){
    Header("Location:LoginForm.php");
}else{
    $query = "SELECT a.AccountID,a.ShowName,d.DonateDateTime,sum(d.DonateAmount) as sumDonate
    from account a
    left join penname p on a.AccountID = p.AccountID
    left join novel n on p.PenID = n.PenID
    left join donate d on n.NovelID = d.NovelID
    group by YEAR(d.DonateDateTime), MONTH(d.DonateDateTime),AccountID";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminhome</title>
    <link rel="stylesheet" href="CSS/Home.css">
    <link rel="stylesheet" href="CSS/AdminDonateSelrct.css">
</head>
<body>

<nav class="navbar">
			<div>
				<ul>
					<li><a href="user_homepage.php"><img src="image_nav/readawrite-logo-svg.svg"></a></li>
				</ul>
			</div>
			
		</nav>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>

<?php
    $cutoff = 2015;
    $now = date('Y');
?>

    <?php
        if(isset($_GET['year']) and isset($_GET['month'])){
            $year = $_GET['year'];
            $month = $_GET['month'];
            if($month<10){
                $wantDate = $year . "-0" . $month;
            }else{
                $wantDate = $year . "-" . $month;
            }

            ?>
            <form action='' method='get'>
            <div class="select1">
                <select name="year" id="year" required onchange="this.form.submit()">
                    <option disable hidden selected <?php echo "value='".$year."'>".$year."</option"; ?> >
                <?php
                    for ($y=$now; $y>=$cutoff; $y--){
                        echo "<option value='".$y."'>".$y.'</option>';
                    }
                ?>
                </select>
                <select name="month" id="month" required onchange="this.form.submit()">
                    <option disable hidden selected <?php echo "value='".$month."'>".date('M',mktime(0,0,0,$month))."</option";?> >
                <?php
                    for ($m=1; $m<=12; $m++){
                        echo "<option value='".$m."'>".date('M',mktime(0,0,0,$m))."</option>";
                    }
                ?>
                </select></div>
            </form> 
            <?php
                echo "<div>";
                echo "<table border = 1 align='center'>";
                echo "<tr><th>AccountID</th><th>Showname</th><th>Donate</th></tr>";
                $i = 0;
                foreach( $result as $row ) {
                    if(strpos($row['DonateDateTime'], $wantDate) !== false){
                        if(isset($row['sumDonate'])) $sumDonate = $row['sumDonate']; else $sumDonate = 0;
                        echo "<tr>";
                        echo "<td>" . $row["AccountID"] ."</td> ";
                        echo "<td>" . $row["ShowName"] . "</td>";
                        echo "<td>" . $sumDonate . "</td>";
                        echo "</tr>"; 
                    } else {
                        $i++;
                    }
                }
                if(mysqli_num_rows($result)==$i){ ?>
                    <tr><td colspan="3">----ไม่มีข้อมูล----</td></tr>
                <?php }
                echo "</table>";
                echo "</div>";
        }else{ ?>
        
            <form action='' method='get' id="selectYM" name="selectYM">
            <div class="select1">    <select name="year" id="year" required onchange="checkmonth()">
                    <option disable hidden selected value="none">Year</option>
                <?php
                    for ($y=$now; $y>=$cutoff; $y--){
                        echo "<option value='".$y."'>".$y.'</option>';
                    }
                ?>
                </select>
                <select name="month" id="month" required onchange="checkyear()">
                    <option disable hidden selected value="none">Month</option>
                <?php
                    for ($m=1; $m<=12; $m++){
                        echo "<option value='".$m."'>".date('M',mktime(0,0,0,$m))."</option>";
                    }
                ?>
                </select></div>
            </form> 
        
            <?php
        }
    ?>
    <p id="here"></p>
    <script>
        function checkmonth(){
            var mon = document.getElementById("month");
            // document.getElementById("here").innerHTML = mon.value;
            if(mon.value != "none"){
                document.selectYM.submit();
            }
        }
        function checkyear(){
            var year = document.getElementById("year");
            // document.getElementById("here").innerHTML = year.value;
            if(year.value != "none"){
                document.selectYM.submit();
            }
        }
    </script>
    <footer>
    <a href="admin_homepage.php" ><input type="button" value="Back"></a>
    </footer>
</body>
</html>
<?php }?>