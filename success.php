<?php
include ("dbconnect.php");
session_start();
$email = $_SESSION["email"];
if (isset($_SESSION["email"])){
$sql = "SELECT username FROM login where email='$email'";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);
	
if ($resultCheck > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
	
	?>
	
<!DOCTYPE html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h4>You have successfully registered. Your new username is: <b><?php echo $row['username']; ?></b>. Click <a href="index.php"><b><u>here</u></b></a> to login.</h4>
</body>
</html>
<?php
	}
}
unset($_SESSION['email']);
}
else {
	header("Location: index.php");
}
?>