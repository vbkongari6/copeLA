<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
    $(document).ready( function(){
        $("#canceleditmyprofile").click( function(){ window.location.href = 'customermyprofile'; } );
    });
</script>
        <div id="customerrelogininfo" align="center">
            <p>For Account Security concerns, your need to enter password to edit profile</p>
            <form method="POST" action="customerprofileedit" onsubmit="return fillpassword()">
                <fieldset id="fieldsetautowidth">  
                    <table>
                        <tr><td>Password :</td>
                            <td><input type="password" name="custloginpassword" id="custloginpassword"/>
                                <input type="submit" value="Submit" style="color:maroon"/>
                            </td></tr>
                    </table>                                     
                </fieldset>                    
            </form>
            <p><input type="button" name="canceleditmyprofile" id="canceleditmyprofile" value="Cancel Edit" style="color:maroon"/></p>
            <p id="error"></p>
            <div align="center"><?php echo $errormsg; ?></div>
        </div>
        </body>
</html>