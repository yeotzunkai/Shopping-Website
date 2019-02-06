<?php
include("dbconnect.php");
session_start();
$name=$_SESSION["username"];
if (isset($_SESSION["username"])){
	if (!isset($_COOKIE["loyaluser".$name]))
	{
		setcookie("loyaluser".$name, $name, time()+(10*24*60*60), "/");
	}
	
	?>
	
<!DOCTYPE html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="new-collections">
		<div class="container"><center>
			<h3>User: <?php echo $name; ?></h3>
			</center>
<h4>Your order is successful. Click <a href="history.php"><b><u>here</u></b></a> to view all past orders.</h4>
</body>
</html>
<?php
}
else {
	header("Location: index.php");
}
?>