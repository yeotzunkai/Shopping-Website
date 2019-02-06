<?php
include("dbconnect.php");
session_start();
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
		<h1>Order History</h1>
			<h3>User: <?php echo $name; ?></h3>
			<p>
			<a href="logout.php">Logout</a> | <a href="welcome.php">Welcome Page</a> | <a href="history.php">Order History</a>
			</p>
			</center>
					<?php
						$sql = "SELECT * FROM orders WHERE username='$name'";
						$result = mysqli_query($conn,$sql);
						$resultCheck = mysqli_num_rows($result);
	
						if ($resultCheck > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$product=explode(',', $row["product"]);
								$quantity=explode(',',$row["quantity"]);
								$price=explode(',',$row["price"]);
								$subtotal=explode(',',$row["subtotal"]);
					?>
				<table style="width: 100%;">
				<h4 align="center">Date and Time: <?php echo $row['datetime']; ?></h4> <br />
					<thead>
						<tr>
							<th>Item Name</th>
							<th>Quantity</th>						
							<th>Price</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<?php
					$total=0;
					for ($x = 1; $x < count($product); $x++) { ?>
					<tr>
						<td><?php echo $product[$x]; ?></td>
						<td><?php echo $quantity[$x]; ?></td>
						<td>$ <?php echo number_format($price[$x],2); ?></td>
						<td>$ <?php echo number_format($subtotal[$x],2); ?></td>
					</tr>
					<?php 
					$total=$total+$subtotal[$x];
					} ?>
					<tr>
						 <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total,2); ?></td>  
                          </tr>
					<tr>
						 <td colspan="3" align="right">Discount</td>  
                               <td align="right">$ <?php echo number_format($row["discount"],2); ?></td>   
                          </tr>
					<tr>
						 <td colspan="3" align="right">Loyalty Discount</td>  
                               <td align="right">$ <?php echo number_format($row["loyalty"],2); ?></td>    
                          </tr>
					<tr>
						 <td colspan="3" align="right">Final Total</td>  
                               <td align="right">$ <?php echo number_format($total-$row["discount"]-$row["loyalty"],2); ?></td>  
                          </tr>

						
					<?php
							}
						}
					?>
					</table>
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