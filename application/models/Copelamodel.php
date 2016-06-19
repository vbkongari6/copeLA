<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Copelamodel extends CI_Model{

		public function getCategoryName(){
			$this->db->select('categoryName');
			$rows = $this->db->get('productcategory');
			return $rows->result();			
		}

		public function getSpecialSales(){			
			$rows = $this->db->query('select ss.*, p.* from specialsales ss inner join product p on ss.productId=p.productId;');
			return $rows->result();			
		}

		public function getProducts($searchcap){
			if(strlen($searchcap)>0){
		    	//$sql1 = $this->db->query('select ss.*, p.* from specialsales ss inner join product p on ss.productId=p.productId inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName="'.$searchcap.'" order by p.productName asc');
		    	$sql1 = 'select ss.*, p.* from specialsales ss inner join product p on ss.productId=p.productId inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName= ? order by p.productName asc';
		    	$stmt = $this->db->query($sql1, array($searchcap));
		    	return $stmt->result();
		    }
		}

		public function getProductss($searchcap, $sortby, $searchfld){
			if($sortby=="Name" || $sortby==""){
				if(strlen($searchcap)>0 && strlen($searchfld)==0){
					if($searchcap=="specialsales"){
						$sql= $this->db->query("select p.* from product p inner join specialsales ss on p.productId = ss.productId order by p.productName asc;");
					}
					else{
						//$sql= $this->db->query("select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName='".$searchcap."' order by p.productName asc;");
						$sql1= "select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName= ? order by p.productName asc;";
						$sql = $this->db->query($sql1, array($searchcap));
					}
				}
				elseif(strlen($searchcap)==0 && strlen($searchfld)>0){
					//$sql= $this->db->query("select * from product where productName like '%".$searchfld."%' order by productName asc;");
					$sql1 = "select * from product where productName like ? order by productName asc;";
					$searchfld = '%'.$searchfld.'%';
					$sql = $this->db->query($sql1, array($searchfld));

				}
				elseif(strlen($searchcap)>0 && strlen($searchfld)>0){
					if($searchcap=="specialsales"){
						//$sql= $this->db->query("select p.* from product p inner join specialsales ss on p.productId = ss.productId where p.productName like '%".$searchfld."%' order by p.productName asc;");
						$sql1 = "select p.* from product p inner join specialsales ss on p.productId = ss.productId where p.productName like ? order by p.productName asc;"; 
						$searchfld = '%'.$searchfld.'%';
						$sql = $this->db->query($sql1, array($searchfld));
					}
					else{
						//$sql= $this->db->query("select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName='".$searchcap."' and p.productName like '%".$searchfld."%' order by p.productName asc;");
						$sql1 = "select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName= ? and p.productName like ? order by p.productName asc;";
						$sql = $this->db->query($sql1, array($searchcap));
					}
				}
				else{$sql= $this->db->query("select * from product order by productName asc;"); }
			}	
			elseif($sortby=="Price"){
				if(strlen($searchcap)>0 && strlen($searchfld)==0){					
					if($searchcap=="specialsales"){
						$sql= $this->db->query("select p.* from product p inner join specialsales ss on p.productId = ss.productId order by p.productPrice asc;");
					}
					else{
						//$sql= $this->db->query("select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName='".$searchcap."' order by p.productPrice asc;");
						$sql1 = "select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName= ? order by p.productPrice asc;";
						$sql = $this->db->query($sql1, array($searchcap));
					}
				}
				elseif(strlen($searchcap)==0 && strlen($searchfld)>0){
					//$sql= $this->db->query("select * from product where productName like '%".$searchfld."%' order by productPrice asc;");
					$sql1 = "select * from product where productName like ? order by productPrice asc;";
					$searchfld = '%'.$searchfld.'%';
					$sql = $this->db->query($sql1, array($searchfld));
				}
				elseif(strlen($searchcap)>0 && strlen($searchfld)>0){
					if($searchcap=="specialsales"){
						//$sql= $this->db->query("select p.* from product p inner join specialsales ss on p.productId = ss.productId where p.productName like '%".$searchfld."%' order by p.productPrice asc;");
						$sql1 = "select p.* from product p inner join specialsales ss on p.productId = ss.productId where p.productName like ? order by p.productPrice asc;";
						$searchfld = '%'.$searchfld.'%';
						$sql = $this->db->query($sql1, array($searchfld));
					}
					else{
						//$sql= $this->db->query("select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName='".$searchcap."' and p.productName like '%".$searchfld."%' order by p.productPrice asc;");
						$sql1 = "select p.* from product p inner join productcategory pc on p.productCategoryId = pc.categoryId where pc.CategoryName= ? and p.productName like ? order by p.productPrice asc;";
						$searchfld = '%'.$searchfld.'%';
						$sql = $this->db->query($sql1, array($searchcap, $searchfld));
					}
				}
				else{$sql= $this->db->query("select * from product order by productPrice asc;");}
			}	
			return $sql->result();
		}

		public function getMyChoice($prodid){
			$prodid=trim($prodid);
			$sql = $this->db->query("select p.*, pc.*, ss.* from product p inner join productcategory pc on p.productCategoryId=pc.categoryId inner join specialsales ss on p.productId=ss.productId where p.productId=".$prodid.";");			
			return $sql->result();
		}

		public function getMyChoice2($prodid){
			$prodid=trim($prodid);
			$sql = $this->db->query("select p.*, pc.* from product p inner join productcategory pc on p.productCategoryId=pc.categoryId where p.productId='".$prodid."';");
			return $sql->result();
		}

		public function getMyChoice3($prodid){
			$prodid=trim($prodid);
			$sql = $this->db->query("select o.orderId from orders o inner join orderdetails od on o.orderId=od.orderId where od.productId='".$prodid."';");
			return $sql->result();
		}

		public function getMyChoice4($orderId, $prodid){
			$prodid=trim($prodid);
			$sql = $this->db->query("select o.*, od.*, p.* from orders o inner join orderdetails od on o.orderId=od.orderId inner join product p on p.productId=od.productId where o.orderId=".$orderId." and p.productId != ".$prodid.";");
			return $sql->result();
		}

		public function verifyLogin($emailaddress, $password){			
			//$sql = $this->db->query("select * from customers where emailAddress = '".$emailaddress."' and password='".$password."';");
			$sql = "select * from customers where emailAddress = ? and password= ? ;";
			$stmt = $this->db->query($sql, array($emailaddress, $password));
			return $stmt->result();
		}

		public function getMyProfile($email){			
			//$sql = $this->db->query("select * from customers where emailAddress = '".$email."';");
			$sql1 = "select * from customers where emailAddress = ? ;";
			$sql = $this->db->query($sql1, array($email));
			return $sql->result();
		}

		public function getMyProfileForEdit($email,$pass){			
			//$sql = $this->db->query("select * from customers where emailAddress = '".$email."' and password='".$pass."';");
			$sql1 = "select * from customers where emailAddress = ? and password= ? ;";
			$sql = $this->db->query($sql1, array($email, $pass));
			return $sql->result();
		}

		public function updatemyprofile($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear,$contactnumber,$editme){
			if($contactnumber!=""){
				//return $this->db->query("update customers set firstName ='".$firstname."', lastName ='".$lastname."', gender ='".$gender."', dateOfBirth='".$dateofbirth."', emailAddress='".$emailaddress."', password='".$password."', shippingAddress='".$shippingaddress."', city ='".$city."', state ='".$state."', country ='".$country."', zipCode='".$zipcode."', billingAddress='".$billingaddress."', cardType='".$cardtype."', cardNumber='".$cardnumber."', cvv='".$securitycode."', cardValidMonth='".$uptomonth."', cardValidYear='".$uptoyear."', contactNumber='".$contactnumber."' where emailAddress='".$editme."';");
				$sql = "update customers set firstName = ? , lastName = ? , gender = ? , dateOfBirth= ? , emailAddress= ? , password= ? , shippingAddress= ? , city = ? , state = ? , country = ? , zipCode= ? , billingAddress= ? , cardType= ? , cardNumber= ? , cvv= ? , cardValidMonth= ? , cardValidYear= ? , contactNumber= ?  where emailAddress= ? ;";
				return $this->db->query($sql, array($firstname, $lastname, $gender, $dateofbirth, $emailaddress, $password, $shippingaddress, $city, $state, $country, $zipcode, $billingaddress, $cardtype, $cardnumber, $securitycode, $uptomonth, $uptoyear, $contactnumber, $editme));
			}
			else{
				//return $this->db->query("update customers set firstName ='".$firstname."', lastName ='".$lastname."', gender ='".$gender."', dateOfBirth='".$dateofbirth."', emailAddress='".$emailaddress."', password='".$password."', shippingAddress='".$shippingaddress."', city ='".$city."', state ='".$state."', country ='".$country."', zipCode='".$zipcode."', billingAddress='".$billingaddress."', cardType='".$cardtype."', cardNumber='".$cardnumber."', cvv='".$securitycode."', cardValidMonth='".$uptomonth."', cardValidYear='".$uptoyear."', contactNumber=null where emailAddress='".$editme."';");
				$sql = "update customers set firstName = ? , lastName = ? , gender = ? , dateOfBirth= ? , emailAddress= ? , password= ? , shippingAddress= ? , city = ? , state = ? , country = ? , zipCode= ? , billingAddress= ? , cardType= ? , cardNumber= ? , cvv= ? , cardValidMonth= ? , cardValidYear= ? , contactNumber=null  where emailAddress= ? ;";
				return $this->db->query($sql, array($firstname, $lastname, $gender, $dateofbirth, $emailaddress, $password, $shippingaddress, $city, $state, $country, $zipcode, $billingaddress, $cardtype, $cardnumber, $securitycode, $uptomonth, $uptoyear, $editme));
			}
		}

		public function getAllEmailAddresses(){
			$sql = $this->db->query("select emailAddress from customers;");
			return $sql->result();
		}

		public function addme($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear,$contactnumber){
			if($contactnumber!=""){
				//return $this->db->query("insert into customers values ('".$firstname."', '".$lastname."', '".$gender."', '".$dateofbirth."', '".$emailaddress."', '".$password."', '".$shippingaddress."', '".$city."', '".$state."', '".$country."', ".$zipcode.", '".$billingaddress."', '".$cardtype."', ".$cardnumber.", ".$securitycode.", ".$uptomonth.", ".$uptoyear.", ".$contactnumber.");");
				$sql = "insert into customers values ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? );";
				return $this->db->query($sql, array($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear,$contactnumber));
			}
			else{
				//return $this->db->query("insert into customers values ('".$firstname."', '".$lastname."', '".$gender."', '".$dateofbirth."', '".$emailaddress."', '".$password."', '".$shippingaddress."', '".$city."', '".$state."', '".$country."', ".$zipcode.", '".$billingaddress."', '".$cardtype."', ".$cardnumber.", ".$securitycode.", ".$uptomonth.", ".$uptoyear.", null);");
				$sql = "insert into customers values ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , null );";
				return $this->db->query($sql, array($firstname,$lastname,$gender,$dateofbirth,$emailaddress,$password,$shippingaddress,$city,$state,$country,$zipcode,$billingaddress,$cardtype,$cardnumber,$securitycode,$uptomonth,$uptoyear));
			}
		}

		public function getcustomerdetails($email){
			//$sql = $this->db->query("select * from customers where emailAddress = '".$email."';");
			$sql1 = "select * from customers where emailAddress = ? ;";
			$sql = $this->db->query($sql1, array($email));
			return $sql->result();
		}

		public function addtoshoppingcart($pid, $pname, $quantity, $pprice, $pimage, $pdiscount,$email){
			if ($pdiscount==""){
				//return $this->db->query("insert into shoppingcart values ('".$email."', ".$pid.", '".$pname."', ".$quantity.", ".$pprice.", 0, '".$pimage."' ) ;");
				$sql = "insert into shoppingcart values ( ? , ? , ? , ? , ? , 0, ? ) ;";
				return $this->db->query($sql, array($email, $pid, $pname, $quantity, $pprice, $pimage));
			}
			else{
				//return $this->db->query("insert into shoppingcart values ('".$email."', ".$pid.", '".$pname."', ".$quantity.", ".$pprice.", ".$pdiscount.", '".$pimage."' ) ;");
				$sql = "insert into shoppingcart values ( ? , ? , ? , ? , ? , ? , ? ) ;";
				return $this->db->query($sql, array($email, $pid, $pname, $quantity, $pprice, $pdiscount, $pimage));
			}
		}

		public function getshoppingcart($email){
			$sql = $this->db->query("select * from shoppingcart where email='".$email."';");
			return $sql->result();
		}

		public function updateqtyinshoppingcart($email,$productid,$quantity){
			//return $this->db->query("update shoppingcart set quantity=".$quantity." where email='".$email."' and id=".$productid.";");
			$sql = "update shoppingcart set quantity= ? where email= ? and id= ? ;";
			return $this->db->query($sql, array($quantity, $email, $productid));
		}

		public function getmypreviousorders($email){
			$sql = $this->db->query("select * from orders where orderedBy = '".$email."' order by orderDate DESC, orderTime DESC;");
			return $sql->result();
		}

		public function getmypreviousorderdetails($orderid){
			$sql = $this->db->query("select o.*, od.* from orders o inner join orderdetails od on o.orderId=od.orderId where o.orderId = '".$orderid."';");
			return $sql->result();
		}

		public function checkshoppingcart($pid,$email){
			$sql = $this->db->query("select * from shoppingcart where email='".$email."' and id='".$pid."';");
			return $sql->result();
		}

		public function orderproducts($email, $ordertotal, $cardType, $shippingAddress, $billingAddress, $res1){
			$this->db->trans_start();
			$sql = $this->db->query("insert into orders values ( NULL, '".$ordertotal."', curdate(), curtime(), '".$email."', '".$cardType."', '".$shippingAddress."', '".$billingAddress."')");
			foreach ($res1 as $product) {
				$sql1 = $this->db->query("insert into orderdetails values (LAST_INSERT_ID(),'".$product->id."','".$product->name."','".$product->quantity."','".$product->price."')");
			}
			$k = $this->db->affected_rows();
			$this->db->trans_complete();
			return $k;
		}

		public function deleteshoppingcart($email){
			$this->db->query("delete from shoppingcart where email='".$email."'; ");
		}

		public function deleteproductinshoppingcart($email,$productid){
			$this->db->query("delete from shoppingcart where email='".$email."' and id=".$productid." ; ");
		}

		public function checkshoppingcartforproducts($email){
			$sql = $this->db->query("select * from shoppingcart where email='".$email."';");
			return $this->db->affected_rows();
		}

	}
?>
