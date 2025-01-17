<?php
    $baseUrl =  Yii::app()->baseUrl;
    $themeUrl = Yii::app()->theme->baseUrl;
    $autoship = Yii::app()->session['autoship'];   
?>
<script type="text/javascript">
    $(document).ready(function(){
        var flag=0; 
        $("#demo4").hover(function(){


            if(flag==0)
                { 
                //alert(1);    
                $(".elastislide-carousel ul#demo4carousel li:first").click(); 
            
                flag=1;
                }
                

        });




        $('.text-contain span ').css('color','#fff');
        $('.text-contain span ').css('font-size','12px');


    });

</script>





<?php
    $sess = Yii::app()->session['sess_user'];
?>

<div class="productdetails">

    <!-- <div class="top-nav">Home &raquo; Lorem ipsum &raquo; Lorem ipsum dolor sit amet &raquo; <span>Valescere Cream with BBXT55 formula</span></div>-->

    <div class="product-left-contain">
        <div class="zoom-gallery">
            <img src="<?php echo $themeUrl;?>/images/logo.png"  alt="#"  class="logo" />
            <div class="box cf" style="padding-bottom:0px; margin:0;">

                <div class="left">

                    <span class="demowrap"><img id="demo4" src="<?php echo $baseUrl; ?>/uploads/product_image/zoom/<?php echo @$result['images'][0]['image_name'];?>"  /></span>
                    <ul id="demo4carousel" class="elastislide-list">
                        <?php if(count($result['images'])) foreach($result['images'] as $row){ ?>
                                <li><a href="javascript:void(0)"><img src="<?php echo $baseUrl; ?>/uploads/product_image/zoom/<?php echo $row['image_name'];?>" data-largeimg="<?php echo $baseUrl; ?>/uploads/product_image/zoom/<?php echo $row['image_name'];?>" /></a></li>
                                <?php } ?>  
                    </ul>
                </div>
            </div>



            <div style="display:none;">    
                <ul id="demo6carousel" class="elastislide-list" >
                    <li><a href="javascript:void(0)"></a></li>

                </ul>

            </div>




        </div>

        <div class="zoom-text">Scroll mouse over to zoom on the image</div>

        <div class="zoom-gallery">

            <strong style="padding-bottom:10px;"> Brand Information</strong>

            <p>
            
            <?php
    echo $result['brand_info']
?>
             </p>  

        </div>


        <div class="zoom-gallery">

            <a href="#"><img src="<?php echo $themeUrl;?>/images/d-logo1.png"  alt="" class="dlogo1"/></a>
            <a href="#">   <img src="<?php echo $themeUrl;?>/images/d-logo2.png"  alt="" class="dlogo2"/></a>
            <a href="#">  <img src="<?php echo $themeUrl;?>/images/d-logo3.png"  alt="" class="dlogo3"/></a>
            <div class="clear"></div>  

        </div>

        <div class="clear"></div>     

    </div>


    <div class="product-right-contain">
        <div class="text-info">
            <h3><?php echo ucfirst($result['productname']);?></h3>

            <!--<span style="color:#fd9b00;">Renue Laboratories</span>-->
            <div class="clear"></div>
            <?php if(intval($st)==0) {?>
            
            <h4>Out of Stock</h4>
            <?php } 
            else
            {?>
            <h4>In Stock</h4> 
            <?php } ?>
            <!-- <img src="<?php echo $themeUrl;?>/images/demo-sicon.png" style="float:right;"/>-->
            <div class="clear"></div>


            <div class="text-contain" style="color:#fff;"><?php echo $result['productdesc'];?></div>


            <div class="price-text">Price:&nbsp;<span>$<?php echo $result['productprice'];?></span></div>
           

            <div class="clear"></div>

            <?php if(intval($st) > 0){?>

                <div class="buynow"><a href="javascript:void(0);" product-name="<?php echo ucfirst($result['productname']);?>" onclick="buypro('<?php echo $result['productid'];?>',<?php echo intval(@$sess['id'])?>,this)">Buy Now!</a></div>

            <?php }else{ ?>

            <div class="buynow"><a href="javascript:void(0);" product-id="<?php echo intval($result['productid']);?>" user-email="<?php echo (@$sess['email']);?>" class="notifyme">Notify Me</a></div>

            <?php } ?>

            <input type="button" value="Add to wishlist"class="buynow" onclick="buywish(<?php echo $result['productid']?>,<?php echo intval(@$sess['id'])?>)"  style="background-image:none; border: none; cursor:pointer;" />
            
             <div class="clear"></div>

            <div class="shipping-contain">
                Shipping in 3 days&nbsp;&nbsp;&nbsp;Quantity&nbsp;&nbsp;

                <select id="quan" <?php echo (intval($st))?"":"disabled";?>>
                    <?php
                    $max=(intval($st) > 10)?10:intval($st);

                    for($i=1;$i<=$max;$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="clear"></div>
           <!-- <div style="width:100%; color:#fff;">

                <input type="checkbox" style="width:20px; float:left; margin:3px 0 0 10px;" id="autoship_chk" <?php if(@$autoship[$result['productid']] == 1){?> checked="checked" <?php } ?>>

                <span style="display:block; width:auto; float:left;"> &nbsp;&nbsp;Subscribe&nbsp;for&nbsp;Autoship</span></div>   -->

            <div class="clear"></div>


        </div>

        <div class="text-info">
            <h3>Product Information</h3>

            <p> 

            <?php echo $result['product_info'] ?>   
            </p>

            <strong style="color:#fd9b00; line-height:22px; display:block; padding:10px 0;"> Guarantee</strong>
            <p>
              <?php echo $result['product_guarantee'] ?>
             </p>

            <strong style="color:#fd9b00; line-height:22px; display:block; padding:10px 0;"> Features</strong>


            <p> 
            
            <?php echo $result['product_features'] ?>
            </p>
          
    


        </div>

    </div>

    <div class="clear"></div>

    <div class="bottom-tab">
        <?php    $this->widget(
            'bootstrap.widgets.TbTabs',
            array(
            'type' => 'tabs',
            'tabs' => array(
            array(
            'label' => 'Description',
            'content' => $result['product_descdetail'],
            'active' => true
            ),
            /*array('label' => 'Payments', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. <strong>Maecenas at ante non metus</strong> lacinia scelerisque. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. <br />
            <br />


            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. Maecenas at ante non metus <strong>lacinia scelerisque</strong>. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. '),
            array('label' => 'Shipping Policy', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. <strong>Maecenas at ante non metus</strong> lacinia scelerisque. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. <br />
            <br />


            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. Maecenas at ante non metus <strong>lacinia scelerisque</strong>. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. '),*/





            )
            )
            );
        ?>
    </div>



    <!--<div class="product-tab">
    <?php    $this->widget(
        'bootstrap.widgets.TbTabs',
        array(
        'type' => 'tabs',
        'tabs' => array(
        array(
        'label' => 'Description',
        'content' => ' <ul>

        <li><a href="#" class="toc"> <img src="'.$themeUrl.'/images/cart-product.png" border="0"></img> </a> </li>
        <li><a href="#" class="toc"> <img src="'.$themeUrl.'/images/cart-product.png" border="0"></img> </a> </li>
        <li><a href="#" class="toc"> <img src="'.$themeUrl.'/images/cart-product.png" border="0"></img> </a> </li>
        <li><a href="#" class="toc"> <img src="'.$themeUrl.'/images/cart-product.png" border="0"></img> </a> </li>



        <ul>      <div class="clear"></div>',
        'active' => true
        ),
        array('label' => 'Payments', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. <strong>Maecenas at ante non metus</strong> lacinia scelerisque. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. <br />
        <br />


        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. Maecenas at ante non metus <strong>lacinia scelerisque</strong>. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. '),
        array('label' => 'Shipping Policy', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. <strong>Maecenas at ante non metus</strong> lacinia scelerisque. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. <br />
        <br />


        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ligula nisi, porttitor sit amet vestibulum sit amet, tempor quis ipsum. Proin elit felis, molestie nec commodo eu, scelerisque ac odio. Morbi a lacus nunc. Maecenas at ante non metus <strong>lacinia scelerisque</strong>. Ut orci quam, egestas et placerat eu, porttitor tincidunt leo. Proin porttitor mollis magna vitae gravida. Fusce mollis mauris aliquam massa tempus rutrum. Maecenas vulputate sagittis interdum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec pulvinar auctor imperdiet. Maecenas at elit et mi convallis rutrum. '),





        )
        )
        );
    ?>
    </div>-->




    <!--<h4>Related Product List by this Category</h4>-->  
    <h4>You Might Also Like</h4>  

    <?php 
        $this->widget(
        'bootstrap.widgets.TbThumbnails',
        array(
        'dataProvider' => $result1,
        'template' => "{items}\n{pager}",
        'itemView' => 'application.modules.product.views.default.productList',
        )
        );
    ?>

</div>





<?php $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'myModal')
    ); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>&nbsp;</h4>
</div>
<div class="modal-body" style="text-align: center;">
   <!-- <img src="<?php echo $themeUrl?>/images/autoship-icon.png" alt="" style="width: 120px; display: block; margin: 0 auto;">-->
   
    <h4 style="text-align:center; color:#fd9b00; font-family:Arial, Helvetica, sans-serif; font-size:22px;">You have successfully updated your cart.</h4>
    
        <img src="<?php echo $themeUrl?>/images/logo.png" alt="" style="width: 60%; display: block; margin: 30px auto;">
    
        
 <input type="button" value="Continue"  onclick="javascript:window.location.href='<?php echo Yii::app()->getBaseurl(true);?>/product/'" style="background:#fd8c21; border:none; border-radius:5px; padding: 8px 15px; width: 140px; color:#fff;">          <input type="button" onclick="javascript:window.location.href='<?php echo Yii::app()->getBaseurl(true);?>/product/checkout'" style="background:#fd8c21; border:none; color:#fff; border-radius:5px; padding: 8px 15px; width: 140px;" value="Checkout">    


</div>

    <?php $this->endWidget(); ?>

 <?php $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'showcheckinglogin')
    ); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
<h4>&nbsp;</h4>
</div>

<div class="modal-body">
      <h4 style="text-align:center; padding:5px 0; color:#fd9b00; font-family:Arial, Helvetica, sans-serif; font-size:22px;">Please login before you check out !</h4>
        <img src="<?php echo $themeUrl?>/images/logo.png" alt="" style="width: 60%; display: block; margin:30px auto;">
        
        <div style="width:290px; margin:10px auto;">
<input type="button" value="Log In"  onclick="javascript:window.location.href='<?php echo Yii::app()->getBaseurl(true);?>/login'" style="background:#fd8c21; border:none; border-radius:5px; padding: 8px 15px; width: 140px; color:#fff;">          <input type="button" onclick="javascript:window.location.href='<?php echo Yii::app()->getBaseurl(true);?>/user/default/sign-up'" style="background:#fd8c21; border:none; color:#fff; border-radius:5px; padding: 8px 15px; width: 140px;" value="Sign Up">

</div>
</div>

<div class="modal-footer">

    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal','class'=>'modal-btn'),
        )
        ); ?>
    </div>
     
    <?php $this->endWidget(); ?>
<div id="anindiv" style="display: none;">hhf hf hds j</div>