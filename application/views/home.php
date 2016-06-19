<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(all); 
function all(){
    $("#image1").hide().fadeIn(300);
    $("#image2").hide();
    $("#image3").hide();
    $("#image4").hide();
    $("#image5").hide();
    $("#image6").hide();

    $("#img1").click( function(){
                                    $("#image1").show();
                                    $("#image2").hide();
                                    $("#image3").hide();
                                    $("#image4").hide();
                                    $("#image5").hide();
                                    $("#image6").hide();
                                    $("#imagecontrol").removeClass("towhite");
                                } );
    $("#img2").click( function(){
                                    $("#image1").hide();
                                    $("#image2").show();
                                    $("#image3").hide();
                                    $("#image4").hide();
                                    $("#image5").hide();
                                    $("#image6").hide();
                                } );
    $("#img3").click( function(){
                                    $("#image1").hide();
                                    $("#image2").hide();
                                    $("#image3").show();
                                    $("#image4").hide();
                                    $("#image5").hide();
                                    $("#image6").hide();
                                } );
    $("#img4").click( function(){
                                    $("#image1").hide();
                                    $("#image2").hide();
                                    $("#image3").hide();
                                    $("#image4").show();
                                    $("#image5").hide();
                                    $("#image6").hide();
                                    $("#imagecontrol").addClass("towhite");
                                } );
    $("#img5").click( function(){
                                    $("#image1").hide();
                                    $("#image2").hide();
                                    $("#image3").hide();
                                    $("#image4").hide();
                                    $("#image5").show();
                                    $("#image6").hide();
                                    $("#imagecontrol").addClass("towhite");
                                } );
    $("#img6").click( function(){
                                    $("#image1").hide();
                                    $("#image2").hide();
                                    $("#image3").hide();
                                    $("#image4").hide();
                                    $("#image5").hide();
                                    $("#image6").show();
                                    $("#imagecontrol").addClass("towhite");
                                } );
    $("#shopnow").click( function(){ window.location.href = 'products'; } );
}
</script>

<p style="margin:0;padding:2px"></p>
<table width="100%" cellspacing="0" cellpadding="1" >
    <tr width="100%">
        <td width="100%" colspan="3">
            <div id="imggs">
                <div id="image1"><img src="<?php echo base_url('JSimagesCSS/images/MY_CAR-solution-banner1920X400_1_.jpg'); ?>" /></div>
                <div id="image2"><img src="<?php echo base_url('JSimagesCSS/images/super-car-DeepEng-.jpg'); ?>" /></div>
                <div id="image3"><img src="<?php echo base_url('JSimagesCSS/images/Maybach-62-S-2011-010.jpg'); ?>" /></div>
                <div id="image4"><img src="<?php echo base_url('JSimagesCSS/images/bmw_cars_desktop_1920x1128_hd-wallpaper-1316799-1280x720.jpg'); ?>" /></div>
                <div id="image5"><img src="<?php echo base_url('JSimagesCSS/images/ferrari-ff-cars-photo-manipulation-1667514-1920x1080.jpg'); ?>" /></div>
                <div id="image6"><img src="<?php echo base_url('JSimagesCSS/images/Mercedes-Benz-CLS400-Shooting-Brake-AMG-Sports-Package-2014-1920x1080-043.jpg'); ?>" /></div>
                <div id="changeattraction">
                    <p id="imagecontrol">
                        <label id="img1" name="img1">o</label>
                        <label id="img2" name="img2">o</label>
                        <label id="img3" name="img3">o</label>
                        <label id="img4" name="img4">o</label>
                        <label id="img5" name="img5">o</label>
                        <label id="img6" name="img6">o</label>
                    </p></div>
                <div id="shopnow">
                    <p><input type="button" name="shopnow" id="shopnow" value="Shop Now &#9658"/></p></div>
            </div>
        </td>
    </tr>     
</table>
<br>
<div align="center" id="prodddimg">
    <b style="display:block">Special Sales</b>
    <?php
        foreach ($details as $detail) {
            echo "<div style='display:inline-block; margin:6px'>
                <form method='GET' action='mychoice'>
                    <input type='text' name='proid' id='proid' value='".$detail->productId."' style='display:none;'/>
                    <input type='image' src='/dbcopela/productimages/".$detail->productImage."' alt='".$detail->productName."' width='220px' height='160px' /><br>
                    <a href='mychoice?proid=", urlencode($detail->productId) ,"' style='color:maroon;'>".$detail->productName."</a>
                </form></div> ";
        }
    ?>
</div>