 <?php
 session_start();
if(isset($_POST["add_to_cart"]))  
 {  
if($_POST["quantity"] == 0 || empty($_POST["quantity"]))
{
	header("Location: welcome.php?action=quantityerror");
}
else {
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))    
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"] 					 
                );  
                array_push($_SESSION['shopping_cart'], $item_array);  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="welcome.php"</script>';  
           }  
		   
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array; 
		   
      }  
 }
 }
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="checkout.php"</script>';  
                }  
           }  
      }  
 }		

 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "quantityerror")  
      {
		  echo '<script>alert("please input a valid quantity.")</script>';  
          echo '<script>window.location="welcome.php"</script>';  
               
      }  
 }		
 
  if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "success")  
      {
		  echo '<script>alert("Your order is successful!")</script>';  
          echo '<script>window.location="welcome.php"</script>';  
      }  
 }	

					
 ?>  