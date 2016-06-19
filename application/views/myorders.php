<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br><div align='center' style='text-decoration:underline'><b>My Previous Orders</b></div>
<?php
	if($errormsg!=""){
	echo "<br><div align='center'><b>".$errormsg."</b></div>";}
	else{
	    echo '<br><div>';
	    foreach ($previousorders as $orders) {
	        echo "<fieldset>
	        	<form method='GET' action='myorderdetails'>
	        		<input type='text' name='orderid' value='".$orders->orderId."' hidden/>
		        	Order ID: ".$orders->orderId." &nbsp&nbsp&nbsp
		        	Ordered Date : ".$orders->orderDate." &nbsp&nbsp&nbsp
			        Time : ".$orders->orderTime." &nbsp&nbsp&nbsp
			        Order Price: ".$orders->orderPrice." &nbsp&nbsp&nbsp
			        Payment Method: ".$orders->paymentMethod." &nbsp&nbsp&nbsp
			        Shipping Address: ".$orders->shippingAddress." &nbsp&nbsp&nbsp
			        Billing Address: ".$orders->billingAddress." &nbsp&nbsp&nbsp	        
			        <input type='submit' id='ordpro' value='Ordered Products' class='ord' />
			    </form>
	        </fieldset>";
	    }		
	}
?>