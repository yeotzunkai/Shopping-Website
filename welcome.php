<?php
include("dbconnect.php");
include("shoppingcart.php");
$name=$_SESSION["username"];
if (isset($_SESSION["username"])){
?>
<!DOCTYPE html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="new-collections">
		<div class="container"><center>
			<h3>Welcome user: <?php echo $name; ?>!</h3>
			<p>
			<a href="logout.php">Logout</a> | <a href="checkout.php">Checkout Page</a> | <a href="history.php">Order History</a>
			</p>
			</center>
			<div class="products">
			<?php
					$query = "SELECT * FROM products ORDER BY id ASC";  
					$result = mysqli_query($conn, $query);  
					if(mysqli_num_rows($result) > 0)  
					{  
						while($row = mysqli_fetch_assoc($result))  
						{  
					?>  
					<div class="col-md-4">  
                     <form method="post" action="checkout.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <h4 class="text-info"><?php echo $row['name']; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row['price']; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" /> 
							   <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" /> 
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="item_add" value="Add to Cart" />  
                          </div>  
                     </form>  
					</div>  
					<?php
						}
					}
					?>
	</div>

	</div>
	</div>
</body>
</html>
<?php
}
else
{
	header("Location: index.php");
}
?>