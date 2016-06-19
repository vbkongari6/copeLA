<?php defined('BASEPATH') OR exit('No direct script access allowed');

    if ($search!=""){
        if ($search == "specialsales"){
            echo '<p style="text-decoration:underline" align="center"><b>Special Sales</b></p>';
        }
        else{
            echo '<p style="text-decoration:underline" align="center"><b>'.$search.'</b></p>';
        }
    }
    else{
        echo '<p style="text-decoration:underline" align="center"><b>All Products</b></p>';
    }   
    echo '<div align="center">';
    foreach ($productss as $products) {
        echo "
        <div style='display:inline-block; margin:6px'>
        	<form method='GET' action='mychoice'>                
            	<input type='text' name='proid' id='proid' value='".$products->productId."' style='display:none;'/>
            	<input type='image' src='/dbcopela/productimages/".$products->productImage."' alt='".$products->productName."' width='200px' height='150px'/><br>
            	<a href='mychoice?proid=", urlencode($products->productId) ,"' style='color:maroon'>".$products->productName."</a>
            </form>
        </div>";
    }
    echo '</div>';
    if($search!="" && $search!="specialsales") {
        echo '<br><div align="center"><p><b>Special Sales</b></p>';
    }
?>