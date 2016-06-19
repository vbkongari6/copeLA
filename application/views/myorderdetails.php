<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br><div align='center' style='text-decoration:underline'><b>Order Details</b></div>
<?php
	if($errormsg!=""){
	echo "<br><div align='center'><b>".$errormsg."</b></div>";}
	else{
	    echo '<br><div align="center">';
	    foreach ($previousorderdetails as $orders) {
	        echo "<fieldset>	        	
	        	Product: ".$orders->productName." &nbsp&nbsp&nbsp
	        	Qty : ".$orders->quantity." &nbsp&nbsp&nbsp
		        Price : ".$orders->price."
	        </fieldset>";
	    }
	}
?>