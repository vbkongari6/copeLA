<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br><br>

<fieldset >
	<div align="center">
		<span style="text-decoration:underline; display:block;">
			<b>People who bought this product also bought</b>
		</span>
		<?php
		    foreach ($product as $products) {
		        echo "<div style='display:inline-block; margin:6px'>
		        	<form method='GET' action='mychoice'>
			        	<input type='text' name='proid' id='proid' value='".($products->productId)."' style='display:none;'/>
			        	<input type='image' src='/dbcopela/productimages/".($products->productImage)."' alt='".$products->productName."' width='160px' height='100px'/><br>
			            <a href='mychoice.php?proid=", urlencode($products->productId) ,"' style='color:maroon'>".($products->productName)."</a>
			        </form></div>";
		    }
		?>
	</div>
</fieldset>