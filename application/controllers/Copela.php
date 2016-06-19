<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Copela extends CI_Controller{
		//constructor
		public function __construct(){			
			session_start();
			parent::__construct();	
			$this->load->helper('url');
			$this->load->model('Copelamodel');
		}

		public function validatecustomer(){
			if(!empty($_SESSION['email'])){		
				if(isset($_SESSION['timeout']) && (time()-$_SESSION['timeout']) > 300) {
					$_SESSION['email']="";
					$_SESSION['lname']="";
					session_destroy();
					$this->title();
			    	$data = array('errmsg' => "Session Timed Out!" );
			    	$this->load->view('customerlogin',$data);
			    	$this->output->_display();
			    	exit;
				}		
				$_SESSION['timeout'] = time();					
			}
		}

		public function index(){
			$this->home();
		}

		public function title(){
			$rows['category'] = $this->Copelamodel->getCategoryName();
			$rows['email'] = $_SESSION['email'];
			$rows['lname'] = $_SESSION['lname'];
			$this->load->view('title',$rows);			
		}
		
		public function home(){
			$this->validatecustomer();
			$this->title();
			$row['details'] = $this->Copelamodel->getSpecialSales();
			$this->load->view('home',$row);
		}

		public function products(){
			$this->validatecustomer();
			$this->title();
			$searchcap = $this->input->get('searchcapability');
			$sortby = $this->input->get('sortby');
			$searchfld = $this->securemysite($this->input->get('searchfield'));

			$row2['productss'] = $this->Copelamodel->getProductss($searchcap, $sortby, $searchfld);

			$row1['products']="";
			if(strlen($searchcap)>0){
				$row1['products'] = $this->Copelamodel->getProducts($searchcap);
			}
			$row2['search'] = $searchcap;
			$this->load->view('products', $row2);
			$this->load->view('products2', $row1);
		}

		public function mychoice(){			
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$this->title();
			//getting product id from view products.php
			$prodid = $this->input->get('proid');
			//calling function getMyChoice with product id
			$product = $this->Copelamodel->getMyChoice($prodid);			
			//if returned nothing, do below
			if(!$product){
				//calling other function with product id
				$product = $this->Copelamodel->getMyChoice2($prodid);
			}

			$product['product']=$product;
			$product['email']=$email;
			
			$this->load->view('mychoice', $product);

			$products = $this->Copelamodel->getMyChoice3($prodid);
			//print_r($products);
			$productss="";
			if($products){
				foreach($products as $order){
					$orderId=$order->orderId;					
					//echo $orderId."+".$prodid."<br>";
					break;
				}
				$productss = $this->Copelamodel->getMyChoice4($orderId, $prodid);
				//print_r($productss);
			}
			if($productss){
				$productss['product']=$productss;	
				$this->load->view('mychoice2',$productss);			
			}
			else{
				$this->load->view('mychoice3');
			}
		}

		public function customerregistration(){
			$this->validatecustomer();		
			$this->title();
			$this->load->view('customerregistration');
		}

		public function securemysite($customerenteredvalue){
			$customerenteredvalue = trim($customerenteredvalue);
			//$customerenteredvalue = htmlentities($customerenteredvalue, ENT_QUOTES);
			$customerenteredvalue = htmlentities($customerenteredvalue);
			return trim($customerenteredvalue);
		}

		public function addnewcustomer(){
			$this->validatecustomer();
			$this->title();	
			$firstname = $this->securemysite($_POST['custfname']);
			$lastname = $this->securemysite($_POST['custlname']);
			$gender = $this->securemysite($_POST['custgender']);
			$dateofbirth = $this->securemysite($_POST['custdob']);
			$emailaddress = $this->securemysite($_POST['custemail']);
			$password = $this->securemysite($_POST['custpassword']);
			$passwordconfirm = $this->securemysite($_POST['custpasswordconfirm']);
			$shippingaddress = $this->securemysite($_POST['custshippingaddress']);
			$city = $this->securemysite($_POST['custshippingcity']);
			$state = $this->securemysite($_POST['custshippingstate']);
			$country = $this->securemysite($_POST['custshippingcountry']);
			$zipcode = $this->securemysite($_POST['custshippingzipcode']);
			$billingaddress = $this->securemysite($_POST['custbillingaddress']);
			$cardtype = $this->securemysite($_POST['custcardtype']);
			$cardnumber = $this->securemysite($_POST['custcardnumber']);
			$securitycode = $this->securemysite($_POST['custcardsecuritycode']);
			$uptomonth = $this->securemysite($_POST['custcardvalidthrumonth']);
			$uptoyear = $this->securemysite($_POST['custcardvalidthruyear']);
			$contactnumber = $this->securemysite($_POST['custcontactnumber']);
			$errormsg = "";

			if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($gender) == 0 || strlen($dateofbirth) == 0 || strlen($emailaddress) == 0 || strlen($password) == 0 || strlen($passwordconfirm) == 0 || strlen($shippingaddress) == 0 || strlen($city) == 0 || strlen($state) == 0 || strlen($country) == 0 || strlen($zipcode) == 0 || strlen($billingaddress) == 0 || strlen($cardtype) == 0 || strlen($cardnumber) == 0 || strlen($securitycode) == 0 || strlen($uptomonth) == 0 || strlen($uptoyear) == 0) { 
			    $errormsg = "- * Asterisk fields are mandatory * 1-"; 
			}
			if (strlen($firstname) == 0 && strlen($lastname) == 0 && strlen($gender) == 0 && strlen($dateofbirth) == 0 && strlen($emailaddress) == 0 && strlen($password) == 0 && strlen($passwordconfirm) == 0 && strlen($shippingaddress) == 0 && strlen($city) == 0 && strlen($state) == 0 && strlen($country) == 0 && strlen($zipcode) == 0 &&  strlen($billingaddress) == 0 && strlen($cardtype) == 0 && strlen($cardnumber) == 0 && strlen($securitycode) == 0 && strlen($uptomonth) == 0 && strlen($uptoyear) == 0) {
			    $errormsg = "- * Asterisk fields are mandatory * 2-";
			}
			if (strlen($firstname) > 0 && strlen($lastname) > 0 && strlen($gender) > 0 && strlen($dateofbirth) > 0 && strlen($emailaddress) > 0 && strlen($password) > 0 && strlen($passwordconfirm) > 0 && strlen($shippingaddress) > 0 && strlen($city) > 0 && strlen($state) > 0 && strlen($country) > 0 && strlen($zipcode) > 0 &&  strlen($billingaddress) > 0 && strlen($cardtype) > 0 && strlen($cardnumber) > 0 && strlen($securitycode) > 0 && strlen($uptomonth) > 0 && strlen($uptoyear) > 0) {
				$res1 = $this->Copelamodel->getAllEmailAddresses();
				foreach ($res1 as $rows) {
		            if (($rows->emailAddress)==trim($emailaddress)) {
		                $errormsg = "Specified Email Address was already registered. New Registration Unsuccessful";
		                break;
		            } 
		            else{ $err = "no err";}			        
			    }
			    if ($err == "no err" || $res1) {			        
			        $res = $this->Copelamodel->addme($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear,$contactnumber);
			    }
			}

			if (strlen($errormsg) > 0) {
				$data = array('errormsg' => $errormsg );
			    $this->load->view('customerregistration',$data);
			}
			elseif (!$res) {
				$data = array('smsg' => "Registration UnSuccessful. Seems you made some error while entering data." );
			    $this->load->view('customerregistration', $data);
			}
			elseif ($res){
			    $data = array('errmsg' => "Registration Successful" );
			    $this->load->view('customerlogin',$data);
			}
		}

		public function customerlogin(){	
			$this->validatecustomer();		
			if(($this->input->get('destroy'))==1){
				$_SESSION['email']="";
				$_SESSION['lname']="";
				session_destroy();
			}			
			$errmsg="";
			$data = array('errmsg' => $errmsg );
			$this->title();
			$this->load->view('customerlogin',$data);
		}

		public function customerloginverify(){
			$this->validatecustomer();
			$emailaddress = $this->securemysite($_POST['custloginemail']);
    		$password = $this->securemysite($_POST['custloginpassword']);
    		$errmsg="";
    		if(strlen($emailaddress)==0){$errmsg = 'Invalid login';}
		    if(strlen($password)==0){$errmsg = 'Invalid login';}
		    if(strlen($emailaddress)==0 && strlen($password)==0){$errmsg="";}
    		if(strlen($emailaddress)>0 && strlen($password)>0){
    			$res = $this->Copelamodel->verifyLogin($emailaddress, $password); 	
    			if($res){
			    	$_SESSION['email'] = $emailaddress;
			    	//print_r($res); 
			    	foreach($res as $k){;}
	            	$_SESSION['lname'] = $k->lastName;
			    	$this->home();
			    } 
			    elseif(!$res){$errmsg="Invalid Login";} 		 			      
		    }		    
		    if($errmsg!=""){
		    	$this->title();
		    	$data = array('errmsg' => $errmsg );
		    	$this->load->view('customerlogin',$data);
		    }
		}

		public function customermyprofile(){	
			$this->validatecustomer();		
			$email = $_SESSION['email'];
			if(strlen($email)==0){
			    $this->customerlogin();
			}
			else{
				$this->title();
				$res = $this->Copelamodel->getMyProfile($email);
				$res['myprofile']=$res;
				$this->load->view('customermyprofile',$res);
			}
		}

		public function customermyprofile2(){
			$this->validatecustomer();
			$this->title();
			$this->load->view('customermyprofile2');
		}

		public function customerprofileedit(){
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$pass = $this->securemysite($_POST['custloginpassword']);
			$errormsg = "";
			if(strlen($pass)==0){
			    $errormsg = "Password is mandatory";
			}
			if(strlen($email)>0 && strlen($pass)>0 ){
				$res = $this->Copelamodel->getMyProfileForEdit($email,$pass);			
				if($res){
					$this->title();
					$res['editmyprofile']=$res;
					$this->load->view('customerprofileedit',$res);
				}
				else{
					$errormsg="Invalid Password";
					$data = array('errormsg' => $errormsg );
					$this->title();
					$this->load->view('customermyprofile2', $data);
				}
			}
			else{
				$data = array('errormsg' => $errormsg );
				$this->title();
				$this->load->view('customermyprofile2', $data);
			}
		}

		public function customerprofileediting(){
			$this->validatecustomer();
			$firstname = $this->securemysite($_POST['custfname']);
			$lastname = $this->securemysite($_POST['custlname']);
			$gender = $this->securemysite($_POST['custgender']);
			$dateofbirth = $this->securemysite($_POST['custdob']);
			$emailaddress = $this->securemysite($_POST['custemail']);
			$password = $this->securemysite($_POST['custpassword']);
			$shippingaddress = $this->securemysite($_POST['custshippingaddress']);
			$city = $this->securemysite($_POST['custshippingcity']);
			$state = $this->securemysite($_POST['custshippingstate']);
			$country = $this->securemysite($_POST['custshippingcountry']);
			$zipcode = $this->securemysite($_POST['custshippingzipcode']);
			$billingaddress = $this->securemysite($_POST['custbillingaddress']);
			$cardtype = $this->securemysite($_POST['custcardtype']);
			$cardnumber = $this->securemysite($_POST['custcardnumber']);
			$securitycode = $this->securemysite($_POST['custcardsecuritycode']);
			$uptomonth = $this->securemysite($_POST['custcardvalidthrumonth']);
			$uptoyear = $this->securemysite($_POST['custcardvalidthruyear']);
			$contactnumber = $this->securemysite($_POST['custcontactnumber']);
			$editme = $this->securemysite($_POST['inputemail']);
			$errormsg = "";

			if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($gender) == 0 || strlen($dateofbirth) == 0 || strlen($emailaddress) == 0 || strlen($password) == 0 || strlen($shippingaddress) == 0 || strlen($city) == 0 || strlen($state) == 0 || strlen($country) == 0 || strlen($zipcode) == 0 || strlen($billingaddress) == 0 || strlen($cardtype) == 0 || strlen($cardnumber) == 0 || strlen($securitycode) == 0 || strlen($uptomonth) == 0 || strlen($uptoyear) == 0) { 
			    $errormsg = "- * Asterisk fields are mandatory * 1-"; 
			}
			if (strlen($firstname) == 0 && strlen($lastname) == 0 && strlen($gender) == 0 && strlen($dateofbirth) == 0 && strlen($emailaddress) == 0 && strlen($password) == 0 && strlen($shippingaddress) == 0 && strlen($city) == 0 && strlen($state) == 0 && strlen($country) == 0 && strlen($zipcode) == 0 &&  strlen($billingaddress) == 0 && strlen($cardtype) == 0 && strlen($cardnumber) == 0 && strlen($securitycode) == 0 && strlen($uptomonth) == 0 && strlen($uptoyear) == 0) {
			    $errormsg = "- * Asterisk fields are mandatory * 2-";
			}
			if (strlen($firstname) > 0 && strlen($lastname) > 0 && strlen($gender) > 0 && strlen($dateofbirth) > 0 && strlen($emailaddress) > 0 && strlen($password) > 0 && strlen($shippingaddress) > 0 && strlen($city) > 0 && strlen($state) > 0 && strlen($country) > 0 && strlen($zipcode) > 0 &&  strlen($billingaddress) > 0 && strlen($cardtype) > 0 && strlen($cardnumber) > 0 && strlen($securitycode) > 0 && strlen($uptomonth) > 0 && strlen($uptoyear) > 0) {
				$res1 = $this->Copelamodel->updatemyprofile($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear,$contactnumber,$editme);
			}
			if(strlen($errormsg)>0){
				$data = array('errormsg' => $errormsg );
				$this->title();
				if(strlen($emailaddress)>0 && strlen($password)>0 ){
					$res = $this->Copelamodel->getMyProfileForEdit($emailaddress,$password);
					if($res){
						$res['editmyprofile']=$res;
						$this->load->view('customerprofileedit',$res);
					}
				}
			}
			elseif(!$res1){
				$this->title();
				if(strlen($emailaddress)>0 && strlen($password)>0 ){
					$res = $this->Copelamodel->getMyProfileForEdit($emailaddress,$password);
					if($res){
						$res['editmyprofile']=$res;
						$this->load->view('customerprofileedit',$res);
					}
				}
			}
			else{
				$this->customermyprofile();
			}
		}

		public function ajax1(){
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$pname = $_POST['pname'];
			$pprice = $_POST['pprice'];
			$quantity = $_POST['quantity'];
			$pid = $_POST['pid'];
			$pimage = $_POST['pimage'];
			$pdiscount = $_POST['pdiscount'];
			$res = $this->Copelamodel->checkshoppingcart($pid, $email);
			if((sizeof($res))!=0){
				echo "You have already added this product to cart. To edit, check shopping cart";
			}
			else{
				$this->Copelamodel->addtoshoppingcart($pid, $pname, $quantity, $pprice, $pimage, $pdiscount, $email);
				echo "Successfully added ".$pname." to the Cart.";	
			}
		}

		public function myorders(){
			$this->validatecustomer();
			$this->title();
			$email = $_SESSION['email'];
			$errormsg="";
			if(strlen($email)==0){
				$msg = array('errmsg' => "Login is must to view your orders" );
				$this->load->view('customerlogin',$msg);
			}
			else{
				$res = $this->Copelamodel->getmypreviousorders($email);
				if(!$res){
					$errormsg="No Pruchases made till now";
				}
				$data['previousorders']=$res;
				$data['errormsg']=$errormsg;
				//print_r($data);
				$this->load->view('myorders',$data);
			}
		}

		public function myorderdetails(){
			$this->validatecustomer();
			$this->title();
			$email = $_SESSION['email'];
			$orderid = $_GET['orderid'];
			$errormsg="";
			if(strlen($email)==0){
				$msg = array('errmsg' => "Login is must to view your orders" );
				$this->load->view('customerlogin',$msg);
			}
			else{
				$res = $this->Copelamodel->getmypreviousorderdetails($orderid);
				if(!$res){
					$errormsg="No Pruchases made";
				}
				$data['previousorderdetails']=$res;
				$data['errormsg']=$errormsg;
				$this->load->view('myorderdetails',$data);
			}
		}

		public function shoppingcart(){	
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$errormsg="";
			$this->title();	
			if(strlen($email)==0){
				$msg = array('errmsg' => "Login is must to view shopping cart" );
				$this->load->view('customerlogin',$msg);
			}
			else{					
				$res['shoppingcart'] = $this->Copelamodel->getshoppingcart($email);
				$this->load->view('shoppingcart',$res);
			}
		}

		public function editproductquantity(){
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$quantity = $this->securemysite($_POST['quant']);
			$productid = $_POST['productid'];
			$res = $this->Copelamodel->updateqtyinshoppingcart($email,$productid,$quantity);
			if($res){
				echo "success";
			}
		}

		public function deleteproductfromcart(){
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$productid = $_POST['productid'];
			$res = $this->Copelamodel->deleteproductinshoppingcart($email,$productid);
			if($res){
				echo "success";
			}
		}

		public function checkout(){			
			$this->validatecustomer();
			$email = $_SESSION['email'];
			if($email !=""){
				$f = $this->Copelamodel->checkshoppingcartforproducts($email);
				if($f>0){									
					$data = $this->Copelamodel->getcustomerdetails($email);
					if($data){
						$this->title();
						$data['details'] = $data;
						$this->load->view('checkout',$data);
					}					
				}
				else{
					echo '
					<script type="text/javascript">
						alert("Add products to cart before checkout.");
						window.location.href="products";
					</script>';
				}
			}
			else{
				$this->title();	
				$msg = array('errmsg' => "You need to login before check out" );
				$this->load->view('customerlogin',$msg);
			}
		}

		public function ordering(){
			$this->validatecustomer();
			$email = $_SESSION['email'];
			$subtotal = 0;
			if(strlen($email)==0){
				$this->title();	
				$msg = array('errmsg' => "Login is must to order the product" );
				$this->load->view('customerlogin',$msg);
			}
			else{
				$res = $this->Copelamodel->getcustomerdetails($email);				
				$res1 = $this->Copelamodel->getshoppingcart($email);
				foreach ($res as $row) { ; }
				foreach ($res1 as $row1) { 
					$p = ($row1->quantity)*($row1->price)-($row1->price)*($row1->discount)/100;
					$subtotal = $subtotal + $p;
				}
				$ordertotal = ($subtotal + ($subtotal*9/100));

				if($ordertotal == 0 ){
					echo '
						<script type="text/javascript">
							alert("Shopping Cart is empty. Add products.");
							window.location.href="products";
						</script>';
				}
				else{
					$res2 = $this->Copelamodel->orderproducts($email, $ordertotal, $row->cardType, $row->shippingAddress, $row->billingAddress, $res1);
					if($res2 == 1){ $this->Copelamodel->deleteshoppingcart($email);}
					echo '
						<script type="text/javascript">
							alert("Order Successful, will be delivered in 5 working days. Thanks for shopping. Visit Again.");
							window.location.href="myorders";
						</script>';
				}
			}
		}


	}
?>
