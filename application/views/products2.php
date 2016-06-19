<?php defined('BASEPATH') OR exit('No direct script access allowed');

	if($products!=""){
	    foreach ($products as $products1) {
	        echo "
	        <div style='display:inline-block; margin:6px'>
	        	<form method='GET' action='mychoice'>
		        	<input type='text' name='proid' id='proid' value='".$products1->productId."' style='display:none;'/>
		        	<input type='image' src='/dbcopela/productimages/".$products1->productImage."' alt='".$products1->productName."' width='180px' height='100px'/><br>
		        	<a href='mychoice?proid=", urlencode($products1->productId) ,"' style='color:maroon'>".$products1->productName."</a></td>
	        	</form>
	        </div>";
	    }
	    echo '</div>';
	}
?>