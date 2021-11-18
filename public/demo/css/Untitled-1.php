<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */


 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product ;
$product_id = $product->id ;

if(!empty($product_id))
{
	$unit = get_post_meta( $product_id, 'product_unit', true );	
}

$data = do_action('wcbp_display_discount_info');

$in_staock_product = '' ;

$is_cart_page = is_page('cart');

if(!$is_cart_page)
{
	if(!$product->is_in_stock())
	{
		$in_staock_product = 'disabled' ;
	}	
}

if($is_cart_page){?>
<div class="quantity_lable_container">
<span class="quantity_label">/ <?php echo $unit;?>s <span class="colonspan">:</span></span>
</div>
<?php }else{?>
<div class="quantity_lable_container">
<span class="quantity_label">Quantity <span class="colonspan">:</span></span>
</div>
<?php }?>
<div class="quantity">
	
	<input type="number" data-minimum_input_val="<?php echo $input_value ;?>" <?php echo $in_staock_product ;?> step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( $max_value ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" class="input-text qty text myinput" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" onKeyUp="qtyValidationInCart(this.id,'<?php echo $prodId;?>','<?php echo esc_attr( $min_value ); ?>','<?php echo esc_attr( $max_value ); ?>');" id="<?php echo $prodId;?>" />
	<?php
	if(!$is_cart_page)
	{
		if ( ! empty( $unit ) )
		{
			echo "<span class='quantity_unit'>".$unit."</span>" ;
		}
		
		echo '<span class="data_quantity_stock_info">';
		if(!empty($max_value) && $max_value != '')
		{		
			echo '<span class="instocknums" id="inventoryQty">
				<span class="weight" id="inventoryQtyNum_new">'.$max_value.'</span>
				<span>in Stock (</span>
				<span class="weight">Stock in: </span>
								<div id="inventoryLocationSelectWarp" class="slists onecountry">
								<div class="origin-a">
				<span id="inventoryLocationSelect" class="tt"></span>
			</div>
				<ul class="moreorigin">
													<li vhidden="TT" vname="TT">
							<span class="tt">Trinidad</span>
						</li>
											</ul>
			</div>
			<span>)</span>
			</span>';
			
			//echo "<span class='maximum_stock_available'>".$max_value."</span>" ;
		}
		if(!$is_cart_page)
		{
			if(!$product->is_in_stock())
			{
				echo '<span class="out_of_stock">This product is Out of Stock (Restocking Soon)</span>';
			}	
		}
		
		echo '</span>';
	
	}
	?>
</div>
<?php
if(!$is_cart_page)
{
	insert_shipping_modal();
}
?>
<div class="calculate_dynamic_pric_wrap"></div>
<script type="application/javascript">
jQuery(document).ready(function() {
	jQuery(".qty-update").hide();
	
	/*
	var minVal = jQuery(".input-text.qty.text").attr("min");
	var maxVal = jQuery(".input-text.qty.text").attr("max");
	var inptVal = jQuery(".input-text.qty.text").val();
	if(inptVal<minVal || inptVal>maxVal){
		err = jQuery(".errormsg.qty").text();
		if(err=='')
		{
			jQuery(".qty-validate").append("<span class='errormsg qty'><b>Only "+minVal+" to "+maxVal+" is allowed</b></span>");
		}
		}
	jQuery('.myinput').keyup(function () {
		//jQuery(this).attr("min").each(function() {
			alert('dh');
			var minVal = jQuery(this).attr("min");
				var maxVal = jQuery(this).attr("max");
				var inptVal = jQuery(this).val();
				if(inptVal<minVal || inptVal>maxVal){
					err = jQuery(".errormsg.qty").text();
					if(err=='')
					{
						jQuery(".qty-validate").append("<span class='errormsg qty'><b>Only "+minVal+" to "+maxVal+" is allowed</b></span>");
					}
				}else{
						jQuery(".qty-update").show();
					}
		//});   
	});	*/
});
function qtyValidationInCart(m,prodId,minIpt,maxIpt){
	
alert(m+" max:"+maxIpt+" min:"+minIpt);
//alert(prodId);
	/*var pId = jQuery(".myinput").attr("id");
	if(pId == prodId){alert(prodId);
		var inptVal =  jQuery(this).val();
		alert(inptVal);
		if(inptVal<minIpt || inptVal>maxIpt){
			err = jQuery(".errormsg.qty").text();
			if(err=='')
			{
				jQuery(".qty-validate").append("<span class='errormsg qty'><b>Only "+minIpt+" to "+maxIpt+" is allowed</b></span>");
			}
		}else{
				jQuery(".qty-update").show();
			}
	}*/
};
</script>

