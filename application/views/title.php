<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html>
	<head>
		<title>
			CopeLA : Online shopping for Cars and its Accessories
		</title>
		<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo base_url(); ?>JSimagesCSS/CSS/copela.css" rel="stylesheet" type="text/css">	
		<script src="<?php echo base_url(); ?>JSimagesCSS/JS/copela.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready( function(){
				$("#editcheckout").click( function(){ window.location.href = 'shoppingcart'; } );
				$("#proceedcheckout").click( function(){ window.location.href = 'checkout'; } );
			});
		</script>
	</head>
	<body style="color:maroon">	
	<div style="background-color:maroon;">	
		<div id="title">
			<!-- u can use href="/codeigniter/index.php/Copela/home" or just home-->
			<label><a href="home" style="color:white; text-decoration:none">copeLA</label><sup>&reg -autos</sup></a>
		</div>
		<div id="searchcart" >
			<div id="search">
				<form method="GET" action="products">
					<select name="searchcapability" id="searchcapability" style="width:90px">
						<option value="Select Category" selected disabled >Category</option>
						<?php
							foreach ($category as $name){
	                		echo "<option value=".$name->categoryName.">".$name->categoryName."</option>";
							}
						?>
						<option value="specialsales">Special Sales</option>
                    </select>
                    <input type="text" name="searchfield" id="searchfield" placeholder="Search.."/>
                    <span style="color:white">
                        <select name="sortby" id="sortby">
                            <option value="SortBy" selected disabled/>Sort By</option>
                            <option value="Name"/>Name ASC</option>
                            <option value="Price"/>Price ASC</option>
                        </select>
                    </span>
                    <input type="submit" name="serachbutton" id="searchbutton" value="&#128269" />
                </form>
            </div>
            <div id="logincart" >
                <ul><li><a id="carthover">Cart &#9662</a>
                        <ul><div id="cart">
                                <fieldset>
                                    <input type="button" id="editcheckout" name="checkout" value="Edit Cart"/>
                                    <input type="button" id="proceedcheckout" name="checkout" value="Checkout"/>                    
                                </fieldset>
                            </div></ul>
                    </li>
                    <?php 
                    if(strlen($email)>0){
                    	$dest = 1;
	                    echo '		                    
	                    <div id="loggedin">
		                    <li>
		                        <a href="#"> '.$lname.' &#9662</a>
		                        <ul><li><a href="customermyprofile">My Profile</a></li>
		                        	<li><a href="myorders">My Orders</a></li>
		                            <li><a href="customerlogin?destroy=1" id="destroysession" >Not '.$lname.' ? Logout</a></li>';
		                        echo '
		                        </ul>
		                    </li>
	                    </div>';}
                    else{
	                    echo '
	                    <div id="notlogged">
		                    <li>
		                        <a>Login &#9662</a>
		                        <ul><li><a href="customerlogin">Customer</a></li>
		                            <li><a href="customerregistration">New Customer? Register</a></li>
		                            <li><a href="/dbcopela/login.php">Employee</a></li></ul>
		                    </li>
	                    </div>';}
                    echo'
                </ul>
            </div>
        </div></div>';
?>