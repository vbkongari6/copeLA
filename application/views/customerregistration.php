<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<div id="customerregisterinfo" align="center">
			<p>Welcome! New Customer</p>	
			<form method="POST" action="addnewcustomer" name="customerregistration" id="customerregistration" onsubmit="return validateCustomerRegistration()">
				<fieldset id="fieldsetautowidth">
					<legend>Registration Form 1</legend>
					<table>
						<tr><td>First Name *</td>
							<td><input type="text" name="custfname" id="custfname" maxlength="50"/></td></tr>
						<tr><td>Last Name *</td>
							<td><input type="text" name="custlname" id="custlname" maxlength="50"/></td></tr>
						<tr><td>Gender *</td>
							<td>
								<input type="radio" name="custgender" id="custgender" value="Male"/>Male
								<input type="radio" name="custgender" id="custgender" value="Female"/>Female</td></tr>
						<tr><td>Date of Birth *</td>
							<td><input type="date" name="custdob" id="custdob"/></td></tr>	
						<tr><td>Email Address *</td>
							<td><input type="email" name="custemail" id="custemail"/></td></tr>
						<tr><td>Choose Password *</td>
							<td><input type="password" name="custpassword" id="custpassword"/></td></tr>
						<tr><td>Confirm Password *</td>
							<td><input type="password" name="custpasswordconfirm" id="custpasswordconfirm"/></td></tr>
						<tr><td>Shipping Address *</td>
							<td><textarea name="custshippingaddress" id="custshippingaddress" maxlength="180"/></textarea></td></tr>
						<tr><td>City *</td>
							<td><input type="text" name="custshippingcity" id="custshippingcity" maxlength="50"/></td></tr>
						<tr><td>State *</td>
							<td><input type="text" name="custshippingstate" id="custshippingstate" maxlength="50"/></td></tr>		
					</table>
				</fieldset>	
				<fieldset id="fieldsetautowidth">
					<legend>Registration Form 2</legend>					
					<table>
						<tr><td>Country *</td>
							<td><input type="text" name="custshippingcountry" id="custshippingcountry" maxlength="50"/></td></tr>
						<tr><td>Zip Code *</td>
							<td><input type="text" name="custshippingzipcode" id="custshippingzipcode" maxlength="10"/></td></tr>
						<tr><td>Billing Address *</td>
							<td>
								<input type="button" name="shipequalbilladdress" id="shipequalbilladdress" value="same as shipping address" onclick="sameasshippingaddress()"/><br>
								<textarea name="custbillingaddress" id="custbillingaddress" maxlength="180"/></textarea></td></tr>							
						<tr><td>Card Type *</td>
							<td>
								<input type="radio" name="custcardtype" id="custcardtype" value="Credit"/>Credit
								<input type="radio" name="custcardtype" id="custcardtype" value="Debit"/>Debit
							</td></tr>
						<tr><td>Card Number *</td>
							<td><input type="text" name="custcardnumber" id="custcardnumber" maxlength="16"/></td></tr>
						<tr><td>Card Security Code *</td>
							<td><input type="number" name="custcardsecuritycode" id="custcardsecuritycode" max="9999"/></td></tr>
						<tr><td>Valid Thru *</td>
							<td>
								<input type="text" name="custcardvalidthrumonth" id="custcardvalidthrumonth" size="2" placeholder="MM"/>
								<input type="text" name="custcardvalidthruyear" id="custcardvalidthruyear" size="2" placeholder="YY"/>
							</td></tr>
						<tr><td>Contact Number :</td>
							<td><input type="number" name="custcontactnumber" id="custcontactnumber" max="9999999999"/></td></tr>
						<tr><td></td><td style="padding-top:21px"><input type="submit" name="custregformsubmit" id="custregformsubmit" value="Register Me"/></td></tr>
					</table>	
				</fieldset>				
			</form>			
			<p id="error"></p>
		</div>
		<div align="center" style="padding:6px"><?php echo $errormsg; ?></div>
		<div align="center"><b><?php echo $smsg; ?></b></div>
	</body>
</html>