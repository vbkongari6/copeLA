<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<br>
		<div id="customerlogininfo" align="center" style="position:block">
			<fieldset id="fieldsetautowidth">
				<legend>Customer Login</legend>
				<form method="POST" action="customerloginverify" onsubmit="return validateCustomerLogin()">
					<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="custloginemail" id="custloginemail"/></td>
					</tr>
					<tr><td>Password</td>
						<td><input type="password" name="custloginpassword" id="custloginpassword"/></td></tr>
					<tr><td></td><td><input type="submit" id="submitcustlogin" name="submitcustlogin" value="Login"/></td></tr>
					</table>
				</form>			
			</fieldset>
			<a href="customerregistration">New Customer? Click here to Register</a>
			<p id="error"></p>
			<div align="center" style="color:white; background-color:maroon"><?php echo $errmsg; ?></div>
		</div>
	</body>
</html>