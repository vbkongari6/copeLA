<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
function editquantity(productid){
	var quant = document.getElementById(productid).value;
	if(!quant.match(/^[0-9]$/)){
		alert("Quantity should be a number");
	}
	else{
		$.ajax({
			url: "editproductquantity",
			type: "POST",
			dataType: "text",
			data: { quant: quant, productid: productid },
			cache: false,
			success: function (response) { $("#mydiv").load(location.href + " #mydiv"); }
		});
	}
}

function delpro(productid){
	$.ajax({
		url: "deleteproductfromcart",
		type: "POST",
		dataType: "text",
		data: { productid: productid },
		cache: false,
		success: function (response) { $("#mydiv").load(location.href + " #mydiv");  }
	});
}

</script>

<div id="mydiv">
	<p style="text-align:center;text-decoration:underline"><b>Shopping Cart</b></p><br>
	<div>
		<?php 
			$subtotal = 0;
			foreach($shoppingcart as $product){
				echo '<fieldset>
					<img src="'.$product->image.'" width="50px" height="50px" />
					<b>'.$product->name.'</b> &nbsp;&nbsp;Qty
					<input type="number" id="'.$product->id.'" value='.$product->quantity.' style="width:36px; color:maroon" min="1" max="9" onchange="editquantity('.$product->id.')"/>';
					if($product->discount !=0){
						$p = ($product->quantity)*($product->price)-($product->price)*($product->discount)/100;
						echo " &nbsp;&nbsp;&nbsp;Price:&nbsp;".($p)."$ <span style='font-size:0.6em'>after discount</span>";
					}
					else{ 
						$p=($product->quantity)*($product->price); 
						echo " &nbsp;&nbsp;&nbsp;Price:&nbsp;".$p."$";
					}
					$subtotal = $subtotal + $p;		
					echo " &nbsp;&nbsp;&nbsp;<input type='button' id='".$product->id."' value='Delete' class='del' onclick=delpro(".$product->id.")><br>
				</fieldset>";
			}
		?>
	</div>
	<div align="center" style="background-color:maroon; color:white">
		<fieldset style="padding:0px">
			<p>Sub Total: <?php echo $subtotal; ?>$</p>
			<p>Tax: 9%</p>
			<p>Order Total: <b><?php $total=($subtotal+($subtotal*9/100)); echo $total."$"; ?></b></p>
			
			<form action="checkout">			
				<input type="text" name="total" id="total" value="<?php echo $total; ?>" hidden/>
				<input type="submit" name="proceddtocheckout" id="proceedtocheckout" value="Proceed to Checkout"/>
			</form>
		</fieldset>
	</div>
</div>