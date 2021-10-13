<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href ="testpopup.css">
</head>
<body>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Donate</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <br><br><p>Donate</p>
    <div class="btcoin">
    <br><br>  
    <input type="submit"  name="10"  value="1 coins" />
    <input type="submit"  name="20"  value="10 coins" />
    <input type="submit"  name="30"  value="50 coins" />
    <input type="submit"  name="50"  value="100 coins" /></div>
    <br><br><label>Amount</label>
    <input type=text name=amountcoins placeholder=""/>
    <br><br><a href="#">submit</a>
  </div>

</div>

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
