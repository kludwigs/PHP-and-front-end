<?php

session_start();

require ("mydata.php");
require ("myheader.php");

echo $header;

if(!isset($_SESSION['shopping_cart']))
{	
	$_SESSION['shopping_cart'] = array();
}
if(isset($_GET['empty_cart']))
{
	?>
		<script type="text/javascript">
			SetInnerHtml("message_box", '<?php echo "Emptied Cart!<br>" ?>')</script>					
	<?php	
	
	$_SESSION['shopping_cart'] = array();	
}
if(isset($_POST['update_cart']))
{
	$quantities = $_POST['quantity'];
	$item_count =0;
	foreach($quantities as $indexOf => $item_quantity)
	{
		if($_SESSION['shopping_cart'][$indexOf] != $item_quantity)
		{
			$itemName = $myproducts[$indexOf]['Name'];
										
			if($item_quantity > 0)
			{
				$_SESSION['shopping_cart'][$indexOf] = $item_quantity;	
								
				?>
				
				<script type="text/javascript">
					SetInnerHtml("message_box", '<?php echo "Note:Updated item $itemName quantitiy to $item_quantity<br>" ?>')</script>					
				<?php
			}
			else
			{															
				$_SESSION['shopping_cart'][$indexOf] = null;	
				
				?>
				
				<script type="text/javascript">
					SetInnerHtml("message_box", '<?php echo "Removed $itemName from our cart<br>" ?>')</script>					
				<?php				
			}

		}
		$item_count += count($_SESSION['shopping_cart'][$indexOf]);		
	}
	if($item_count == 0)
		$_SESSION['shopping_cart'] = array();
}

if(isset($_GET['view_cart']))
{
	$cart_products = $_SESSION['shopping_cart'];
	
	echo "<h3> Shopping Cart</h3>";
	
	if(!empty($cart_products))
	{			
		echo 
		"<form action='./index.php?view_cart=1' method='post'>
			<table border='1'>
				<tr>
					<th class='long-column'>	Name</th>
					<th>						Category</th>
					<th class='short-column'>	Price</th>
					<th class='short-column'>	Quantity</th>
				</tr>"
			;
			foreach($cart_products as $id=> $quantity)
			{
				if($quantity > 0 )
				{
					$indexOf = (int) $id;

					echo 
						"<tr>
							<td>	", $myproducts[$indexOf]['Name'],	 "								</td>
							<td>	", $myproducts[$indexOf]['Category'],"								</td>							
							<td>  \$", $myproducts[$indexOf]['Price']	,"								</td>    
							<td>	<input type='text' name='quantity[$indexOf]' value =$quantity 	</td>
						</tr>";
				}
			}	
				echo
			"</table>
		<br>
		<input type='submit' name='update_cart' value='Update'/>
		</form>
		";	
		echo "<br><a href='./index.php?empty_cart=1'>Empty Cart</a>
		&gt &gt <a href='./index.php?checkout=1'>Checkout</a><br>";
	}
	else
	{
		echo "Your cart is empty <br>";
	}
}
if(isset($_GET['view_product']))
{
	$id = $_GET['view_product'];
	$product = $myproducts[$id];	
		
	echo "<a href='./index.php'>Back To Main </a>&gt&gt ", $product['Category'], "<br><br>";
	
	
	echo "<span style='font-weight: bold;'> Name: ", $product['Name'],"</span><br>											
												Price: \$", $product['Price']	,"<br>	
												Description: ", $product['Description']	,"<br>";	
	echo "<br>";
	echo "<form action='./index.php?view_product=",$id,"' method='POST'>
		Quantity:
		<select name='product_quantity' id='product_quantity'>
		<option value=1>1</option>
		<option value=2>2</option>
		<option value=3>3</option>
		</select>
		<input type='submit' value='Add to cart'>
		<input type='hidden' name='product_id' value=' ",$id," '>
		<input type='hidden' name='add_to_cart' value='add_to_cart'>
		</form>";	
}
else if(isset($_GET['checkout']))
{
	$cart_products = $_SESSION['shopping_cart'];
	
	echo "<h3> Shopping Cart</h3>";
	
	$total = 0;
	
	if(!empty($cart_products))
	{			
		echo 
		"<table border='1'>
			<tr>
				<th class='long-column'>	Name</th>
				<th>						Category</th>
				<th class='short-column'>	Price</th>
				<th class='short-column'>	Quantity</th>
			</tr>"
		;
		foreach($cart_products as $id=> $quantity)
		{
			$indexOf = (int) $id;
			if($quantity > 0 )
			{
				echo 
					"<tr>
						<td>	", $myproducts[$indexOf]['Name'],	 "			</td>
						<td>	", $myproducts[$indexOf]['Category'],"			</td>							
						<td>  \$", $myproducts[$indexOf]['Price']	,"			</td>    
						<td>	", $quantity, "									</td>
					</tr>";
				$total += $myproducts[$indexOf]['Price'] * $quantity;
			}
		}	
			echo
		"</table>";	
		echo "<h4>Total__________ \$" , $total, "</h4>";
		echo "<br><a href='./index.php'>Back To Main</a><br>";
	}
	else
	{
		echo "Cart is empty <br>";
	}	
}
else
{
	echo "<br><h3> Our Products</h3>";
	foreach ($myproducts as $pos => $items) 
	{				
		echo "<a href='./index.php?view_product=",$pos,"'><span style='font-weight: bold;'> Name: ", $items['Name'],"</span></a><br>
												Category: ", $items['Category'], "<br>
												Price: \$", $items['Price']	,"<br>";    
		echo "<br>";			
	}
}
if(isset($_POST['add_to_cart']))
{
	//make sure we get an int value type back
	$id = (int)$_POST['product_id'];	
	$quantity = $_POST['product_quantity'];
	
	if(isset($_SESSION['shopping_cart'][$id]) && !empty($_SESSION['shopping_cart'][$id]))
	{
		echo "Item already in the cart!<br>";
	}
	else
	{
		$_SESSION['shopping_cart'][$id] = $quantity;
		echo "We added $quantity ", $myproducts[$id]['Name'], "(s) to our cart<br>";
		

	}	
	/* For looks: keeps product quantity drop down as the same as entered value*/
	?>
		<script type="text/javascript">
		SetObjectValue("product_quantity", '<?php echo $quantity ?>')</script>		
	<?php	
}

echo $footer;

?>