<!DOCTYPE html>
<?php
//$conf = parse_ini_file("config.ini", true);

$date=date_create();
$timestamp=date_timestamp_get($date);

if ($_POST['timestamp']){
  if (($timestamp - $_POST['timestamp']) <= 60000) {
    // 1 minute
    //$success = system("sudo /sbin/halt");
  }
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="stylesheet" href="../color.css" type="text/css" />
<title>Failure</title>
</head>
<body>
  <div id="words">
    <div id="words">
      <div class="dropdown">
        <button class="dropbtn">&#x1D118; &nbsp; </button>
       <div class="dropdown-content">
         <a href="../">Home</a>
         <a href="./">(Re)Start Piece</a>
        <a href="./piece.html">Show Piece as Conductor</a>
        <a href="../piece.html">Show piece as Player</a>
        <a href="./wifi.php">Show WiFi Password</a>
        <a href="./advanced.html">Set WiFi Password</a>
        <a href="./setintro.php">Set introductory text</a>
      </div>
    </div>
<h2>Failed</h2>
<p>The computer did not shut down. This may be because you
  waited too long on the previous page.</p>
<p>You should <a href="requestshutdown.php">Try shutting down again</a>.
  <p>time stamp now: <?php echo $timestamp ?></p>
  <p>time at request: <?php echo $_POST['timestamp'] ?></p>
  <p>diff: <?php echo ($timestamp - _POST['timestamp'])?></p>
  <!--
<ul>
<li><a href="./">Return to piece settings</a></li>
<li><a href="advanced.html">Return to Advanced settings</a></li>
<li><a href="piece.html">View piece as Conductor</a></li>
<li><a href="../piece.html">View piece as performer</a></li>
</ul>
-->
</div>
</body>
</html>
