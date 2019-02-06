<?php
include ("dbconnect.php");
$error='';
?>

<!DOCTYPE html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="">

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Username" name="username" value="<?php if(isset($_COOKIE["login"])) {echo $_COOKIE["login"];} ?>" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Password" name="password" required>

    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox" <?php if(isset($_COOKIE["login"])) { ?> checked <?php } ?> name="remember"> Remember me
    </label>
	<?php echo $error; ?>
  </div>
 </form>
 
 <?php
if(isset($_POST['submit'])){
	if(empty($_POST['username']) || empty($_POST['password'])){
		$error = "Both fields are required.";
		
	}
	else
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		$query = mysqli_query($conn,"SELECT password FROM login WHERE username = '$username'");
				
		
		$rows = mysqli_num_rows($query);
		
		if($rows > 0){
			$data=mysqli_fetch_array($query);
			
			if(password_verify($password, $data['password'])){
				session_start();
				if(!empty($_POST["remember"]))
				{
					
				setcookie("login", $username, time() + (30*24*60*60), "/");
				
				}
				else
				{
					if(isset($_COOKIE["login"]))
					{
						setcookie("login","", time()+(30*24*60*60),"/");

					}

				}	
				$_SESSION["username"]=$username;
				header("Location: welcome.php");
		}
		}
		else
		{
			$error = "Email and/or password is invalid";
		}
	}
}

?>

  <div class="container" style="background-color:#f1f1f1">
    <span class="psw">If you don't have an account, <a href="register.php">Register here</a></span>
  </div>

</body>
</html>