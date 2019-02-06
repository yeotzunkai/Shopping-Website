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
		<h1>Checkout Page</h1>
			<h3>User: <?php echo $name; ?></h3>
			<p>
			<a href="logout.php">Logout</a> | <a href="welcome.php">Welcome Page</a> | <a href="history.php">Order History</a>
			</p>
			</center><form method="post" action="">
				<table style="width: 100%;">
					<thead>
						<tr>
							<th>Item Name</th>
							<th>Quantity</th>						
							<th>Price</th>
							<th>Subtotal</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
						<td><a href="checkout.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$discount=0;
							$loyalty=0;
							if ($total>100) $discount=0.1*$total;
							if (!isset($_COOKIE["loyaluser".$name]))
								{
									$loyalty=0;
								}
							else $loyalty=0.05*$total;
						}
						
						?>
					<tr>
						 <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>
					<tr>
						 <td colspan="3" align="right">Discount</td>  
                               <td align="right">$ <?php echo number_format($discount, 2); ?></td>  
                               <td></td>  
                          </tr>
					<tr>
						 <td colspan="3" align="right">Loyalty Discount</td>  
                               <td align="right">$ <?php echo number_format($loyalty, 2); ?></td>  
                               <td></td>  
                          </tr>
					<tr>
						 <td colspan="3" align="right">Final Total</td>  
                               <td align="right">$ <?php echo number_format($total-$discount-$loyalty,2); ?></td>  
                               <td></td>
                          </tr>

						
					<?php
					}
					?>
					</table>
					<button type="checkout" name="checkout" class="btn">Checkout</button>
					</form>


	</div>
	</div>
</body>
</html>
<?php
$total_products='';
$total_price='';
$total_quantities='';
$total_subtotal='';
if (isset($_POST['checkout'])) {
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$total_products.=",".$values["item_name"];
		$total_price.=",".$values["item_price"];
		$total_quantities.=",".$values["item_quantity"];
		$total_subtotal.=",".($values["item_quantity"] * $values["item_price"]);
	}
	
	$result = mysqli_query($conn,"INSERT INTO orders (product, quantity, price, subtotal, discount, loyalty, username, datetime) VALUES ('$total_products','$total_quantities','$total_price','$total_subtotal','$discount','$loyalty','$name', now())");
	if ($result) {
		unset($_SESSION["shopping_cart"]);
		header("Location: success-order.php");
	}

}

}
else
{
	header("Location: index.php");
}
?>