<?php defined('BASEPATH') OR exit('No direct script access allowed');

	$emailaddress = $_POST['custloginemail'];
    $password = $_POST['custloginpassword'];
    if(strlen(trim($emailaddress))==0){$errmsg = 'Invalid login';}
    if(strlen(trim($password))==0){$errmsg = 'Invalid login';}
    if(strlen(trim($emailaddress))==0 && strlen(trim($password))==0){$errmsg = "";}
    if(strlen(trim($emailaddress))>0 && strlen(trim($password))>0){
        $sql = "select * from customers where emailAddress = '".trim($emailaddress)."' and password='".trim($password)."';";
        $con = mysql_connect(':/home/scf-25/kongari/mysql.sock','root','kongari');
        if(!$con){die('Could not be able to connect to  mysql');}
        mysql_select_db('hwdb', $con);
        $res = mysql_query($sql);
        if(!($row = mysql_fetch_assoc($res))){$errmsg='Invalid login';}
        else{ 
            $_SESSION['email'] = $row['emailAddress'];
            $_SESSION['lname'] = $row['lastName'];
        }
    }
    if(strlen($errmsg)>0){
        require 'customerlogin.php';
        echo '<div align="center" style="color:white; background-color:maroon">'.$errmsg.'</div>';}
    elseif(!$res){     
        require 'customerlogin.php';}    
    else{ require "home.php";}
?>