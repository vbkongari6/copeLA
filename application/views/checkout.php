<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
			$(document).ready( function(){
				$("#checkout").click( function(){ window.location.href = 'ordering'; } );
			});
		</script>
<?php
	foreach ($details as $row){;}
	    echo ' 
	                <div id="customermyprofile" align="center">                    
	                    <p><input type="button" name="checkout" id="checkout" value="Order" style="padding:3px"/></p>
	                    <fieldset id="fieldsetautowidth" style="padding-bottom:10px">
	                        <legend style="text-decoration:underline">Check Details</legend>
	                        <table cellpadding="5">
	                            <tr><td>First Name :</td>                           
	                                <td>'.$row->firstName.'</td></tr>
	                            <tr><td>Last Name :</td>
	                                <td>'.$row->lastName.'</td></tr>                            
	                            <tr><td>Email Address :</td>
	                                <td>'.$row->emailAddress.'</td></tr>
	                            <tr><td>Shipping Address :</td>
	                                <td>'.$row->shippingAddress.'</td></tr>
	                            <tr><td>City :</td>
	                                <td>'.$row->city.'</td></tr>
	                            <tr><td>State :</td>
	                                <td>'.$row->state.'</td></tr> 
	                            <tr><td>Country :</td>
	                                <td>'.$row->country.'</td></tr>
	                            <tr><td>Zip Code :</td>
	                                <td>'.$row->zipCode.'</td></tr>
	                            <tr><td>Billing Address :</td>
	                                <td>'.$row->billingAddress.'</td></tr>                          
	                            <tr><td>Card Type :</td>
	                                <td>';
	                                    if($row->cardType == "Credit"){echo 'Credit';}
	                                    elseif($row->cardType == "Debit"){echo 'Debit';}
	                                    echo '
	                                </td></tr>
	                            <tr><td>Card Number :</td>
	                                <td>************'.substr($row->cardNumber, -4).'</td></tr>
	                        </table>
	                    </fieldset>
	                </div>
	            </body>
	        </html>
	    ';
?>