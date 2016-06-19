<?php defined('BASEPATH') OR exit('No direct script access allowed');
    foreach ($editmyprofile as $row) {;}
    echo '
            <div id="customerregisterinfo" align="center">
                <p style="text-decoration:underline">Edit My Profile</p>    
                <form method="POST" action="customerprofileediting" name="customerregistration" onsubmit="return validateCustomerProfileEdit()">
                    <fieldset id="fieldsetautowidth" style="padding-bottom:10px">
                        <legend>Registration Form 1</legend>
                            <table>
                                <tr><td>First Name *</td>    
                                    <td><input type="text" name="custfname" id="custfname" maxlength="50" value="'.$row->firstName.'"/></td></tr>
                                <tr><td>Last Name *</td>
                                    <td><input type="text" name="custlname" id="custlname" maxlength="50" value="'.$row->lastName.'"/></td></tr>
                                <tr><td>Gender *</td>
                                    <td>
                                        <input type="radio" name="custgender" id="custgender" value="Male"';
                                        if($row->gender == "Male"){echo "checked";} 
                                        echo '/>Male
                                        <input type="radio" name="custgender" id="custgender" value="Female"';
                                        if($row->gender == "Female"){echo "checked";}
                                        echo '/>Female</td></tr>
                                <tr><td>Date of Birth *</td>
                                    <td><input type="date" name="custdob" id="custdob" value="'.$row->dateOfBirth.'"/></td></tr>  
                                <tr><td>Email Address *</td>
                                    <td><input type="email" name="custemail" id="custemail" value="'.$row->emailAddress.'"/></td></tr>
                                <tr><td>Password *</td>
                                    <td><input type="password" name="custpassword" id="custpassword" value="'.$row->password.'"/></td></tr>
                                <tr><td>Shipping Address *</td>
                                    <td><textarea name="custshippingaddress" id="custshippingaddress" maxlength="180" style="color:maroon"/>'.$row->shippingAddress.'</textarea></td></tr>
                                <tr><td>City *</td>
                                    <td><input type="text" name="custshippingcity" id="custshippingcity" maxlength="50" value="'.$row->city.'"/></td></tr>
                                <tr><td>State *</td>
                                    <td><input type="text" name="custshippingstate" id="custshippingstate" maxlength="50" value="'.$row->state.'"/></td></tr>       
                            </table>
                    </fieldset>
                    <fieldset id="fieldsetautowidth" style="padding-bottom:27px">
                        <legend>Registration Form 2</legend>                    
                            <table>
                                <tr><td>Country *</td>
                                    <td><input type="text" name="custshippingcountry" id="custshippingcountry" maxlength="50" value="'.$row->country.'"/></td></tr>
                                <tr><td>Zip Code *</td>
                                    <td><input type="text" name="custshippingzipcode" id="custshippingzipcode" maxlength="10" value="'.$row->zipCode.'"/></td></tr>
                                <tr><td>Billing Address *</td>
                                    <td>
                                        <input type="button" name="shipequalbilladdress" id="shipequalbilladdress" value="same as shipping address" onclick="sameasshippingaddress()"/><br>
                                        <textarea name="custbillingaddress" id="custbillingaddress" maxlength="180" style="color:maroon"/>'.$row->billingAddress.'</textarea></td></tr>                          
                                <tr><td>Card Type *</td>
                                    <td>
                                        <input type="radio" name="custcardtype" id="custcardtype" value="Credit"';
                                        if($row->cardType == "Credit"){echo ' checked';}
                                        echo '/>Credit
                                        <input type="radio" name="custcardtype" id="custcardtype" value="Debit"';
                                        if($row->cardType == "Debit"){echo ' checked';}
                                        echo '/>Debit
                                    </td></tr>
                                <tr><td>Card Number *</td>
                                    <td><input type="text" name="custcardnumber" id="custcardnumber" maxlength="16" value="'.$row->cardNumber.'"/></td></tr>
                                <tr><td>Card Security Code *</td>
                                    <td><input type="number" name="custcardsecuritycode" id="custcardsecuritycode" max="9999" value="'.$row->cvv.'"/></td></tr>
                                <tr><td>Valid Thru *</td>
                                    <td>
                                        <input type="text" name="custcardvalidthrumonth" id="custcardvalidthrumonth" size="2" placeholder="MM" value="'.$row->cardValidMonth.'"/>
                                        <input type="text" name="custcardvalidthruyear" id="custcardvalidthruyear" size="2" placeholder="YY" value="'.$row->cardValidYear.'"/>
                                    </td></tr>
                                <tr><td>Contact Number :</td>
                                    <td><input type="number" name="custcontactnumber" id="custcontactnumber" max="9999999999" value="'.$row->contactNumber.'"/></td></tr>  
                            </table>    
                    </fieldset>
                    <p><input type="submit" name="custregformsubmit" id="custregformsubmit" value="Edit" width="50px"></p>
                    <input type="text" name="inputemail" id="inputemail" value="'.$row->emailAddress.'" hidden/>         
                </form>         
                <p id="error"></p>
            </div>
        </body>
    </html>';  
?>