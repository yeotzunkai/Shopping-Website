<?php
include ("dbconnect.php");
?>
<!DOCTYPE html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="">

  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Password" name="password" required>
	
	<label for="psw"><b>Re-type Password</b></label>
    <input type="password" placeholder="Re-type password" name="password2" required>

    <button type="submit" name="register">Register</button>
  </div>
 </form>
 
<?php
if(isset($_POST['register'])){
	if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])){
		echo "All entries are required.";
		
	}
	else
	{
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		
		//$email = mysqli_real_escape_string($conn, $email);
		//$password = mysqli_real_escape_string($conn, $password);
			
		$query = mysqli_query($conn,"SELECT email FROM login WHERE email='$email'");
				
		$rows = mysqli_num_rows($query);
	
		if($rows == 1){
			echo "This email has been used.";
		}
		else
		{
			if($password != $password2){
				echo "Passwords are not the same";
			} 
			else{

			function randomstring($len)
			{
			$string = "";
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for($i=0;$i<$len;$i++)
			$string.=substr($chars,rand(0,strlen($chars)),1);
			return $string;
			}
			
			$username=randomstring(7);
			$hash=password_hash($password, PASSWORD_BCRYPT);
			$result = mysqli_query($conn,"INSERT INTO login (username, email, password) VALUES ('$username','$email','$hash')");
			
			if($result)
			{
				session_start();
				$_SESSION["email"] = $email;
				header("Location: success.php");
				
			}
			else
			{
				echo"ERROR. PLEASE TRY AGAIN.";
			}
			}
		}
	
		mysqli_close($conn);
	}
}
?>
</body>
</html>