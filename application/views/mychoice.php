<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
	$(document).ready(imghover); 
	function imghover(){
		$("#i81").hover( function(){
										$("#bmwi81").show();
										$("#bmwi82").hide();
										$("#bmwi83").hide();
										$("#bmwi84").hide();
									} );
		$("#i82").hover( function(){
										$("#bmwi81").hide();
										$("#bmwi82").show();
										$("#bmwi83").hide();
										$("#bmwi84").hide();
									} );
		$("#i83").hover( function(){
										$("#bmwi81").hide();
										$("#bmwi82").hide();
										$("#bmwi83").show();
										$("#bmwi84").hide();
									} );
		$("#i84").hover( function(){
										$("#bmwi81").hide();
										$("#bmwi82").hide();
										$("#bmwi83").hide();
										$("#bmwi84").show();
									} );
	}
	function cart(){
		var email = document.getElementById("email").value;
		if (email==""){ alert("You need to login to add products to cart"); }
		else{
			var pid = document.getElementById("pid").value;
			var pimage = document.getElementById("pimage").value;
			var pname = document.getElementById("pname").value;
			var pprice = document.getElementById("pprice").value;
			var quantity = document.getElementById("qty").value;
			var pdiscount = document.getElementById("pdiscount").value;
			$.ajax({
				url: "ajax1",
				type: "POST",
				dataType: "text",
				data: { pname: pname, pprice: pprice, quantity: quantity, pid: pid, pimage: pimage, pdiscount: pdiscount },
				cache: false,
				success: function (response) {
					alert(response);
				}
			});
		}
	}
</script>

<?php
	foreach($product as $product){ ; }	
	if (array_key_exists('discountPercentage', $product)){
    	$priceafterdiscount = ($product->productPrice)-(($product->productPrice)*($product->discountPercentage)/100);
    }
    else{$product->discountPercentage = "";}
    
    echo '<br>
    <input type="text" id="email" value="'.$email.'" hidden/>
    	<div align="center" style="color:maroon; padding:0px;">
			<div id="inmychoice" align="center" style="color:maroon;display:inline-block; margin:0px">';
				if(($product->productImage)!=""){echo '
				<label id="i81" name="i81" style="padding:1px"><img src="/dbcopela/productimages/'.($product->productImage).'" alt="'.($product->productImage).'" /></label><br>';}
				if(($product->productImage2)!=""){echo '
    			<label id="i82" name="i81" style="padding:1px"><img src="/copela/images/'.($product->productImage2).'" alt="'.($product->productImage2).'" /></label><br>';}
    			if(($product->productImage3)!=""){echo '
    			<label id="i83" name="i81" style="padding:1px"><img src="/copela/images/'.($product->productImage3).'" alt="'.($product->productImage3).'" /></label><br>';}
    			if(($product->productImage4)!=""){echo '
    			<label id="i84" name="i81" style="padding:1px"><img src="/copela/images/'.($product->productImage4).'" alt="'.($product->productImage4).'" /></label>';}
    		echo '
    		</div>
    		<div style="display:inline-block; margin:0px">
    			<div id="bmwi81"><img src="/dbcopela/productimages/'.($product->productImage).'" alt="'.($product->productImage).'" /></div>
    			<div id="bmwi82"><img src="/copela/images/'.($product->productImage2).'" alt="'.($product->productImage2).'" /></div>
    			<div id="bmwi83"><img src="/copela/images/'.($product->productImage3).'" alt="'.($product->productImage3).'" /></div>
    			<div id="bmwi84"><img src="/copela/images/'.($product->productImage4).'" alt="'.($product->productImage4).'" /></div>
    		</div>
    		<div style="display:inline-block; margin:0px; vertical-align:top">
	    		<table>
		    		<tr><td>Name : </td>
		    			<td><b>'.($product->productName).'</b></td></tr>
			    	<tr><td>Category : </td>
			    		<td>'.($product->categoryName).'</td></tr>
		    		<tr><td>Description : </td>
		    			<td id="tdp">'.($product->productDescription).'</td></tr>
		    		<tr><td>Price (actual*) : </td>
		    			<td>'.($product->productPrice).' $</td></tr>';
					if(($product->discountPercentage)!=""){
			      		echo '<tr><td>Special Sale : </td>
			      			<td><span style="text-decoration:underline">'.($product->discountPercentage).'% discount</span></td></tr>
			      		<tr><td>Price after Discount* : </td>
			      			<td>'.($priceafterdiscount).' $</td></tr>';
			    	}
			    echo '</table>
			</div>
			<div style="display:inline-block; margin:0px; vertical-align:top; float:right;">
				<input type="text" name="pid" id="pid" value="'.($product->productId).'" hidden/>
				<input type="text" name="pimage" id="pimage" value="/dbcopela/productimages/'.($product->productImage).'" hidden/>
				<input type="text" name="pname" id="pname" value="'.($product->productName).'" hidden/>
				<input type="text" name="pprice" id="pprice" value="'.($product->productPrice).'" hidden/>
				<input type="text" name="pdiscount" id="pdiscount" value="'.($product->discountPercentage).'" hidden/>
    			<fieldset>
    				<table cellpadding="3px">
    					<tr><td align="center">
    						<span style="text-decoration:underline"><b>Cart</b></span></td></tr>
    					<tr><td  align="center">
    							Quantity:
    							<select name="qty" id="qty" style="color:maroon">
    								<option value="1">1</option>
    								<option value="2">2</option>
    								<option value="3">3</option>
    								<option value="4">4</option>
    								<option value="5">5</option>
    								<option value="6">6</option>
    								<option value="7">7</option>
    								<option value="8">8</option>
    								<option value="9">9</option>
    							</select>
    						</td></tr>
    					<tr>
    						<td>			    							
    							<input type="button" name="addtocart" id="addtocart" value="Add to Cart" onclick="cart()" />
    						</td>
    					</tr>
    				</table>
    			</fieldset>				    	 			
    		</div>
    	</div>';
?>