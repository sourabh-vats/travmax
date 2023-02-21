<div class="col-sm-12">
 
	
<div class="text-center">
<h2>My Cart</h2>
</div>


<?php 
$cart = $this->cart->contents();
if(!empty($cart)) { 
$sub_total = $comm_dis = 0;
$shipping = 0;
$tax = 0;
?>
<div class="col-sm-12 top-tem">
<div class="col-sm-6 dt0"><h4>Your Items</h4></div>
<div class="col-sm-2 dt0"><h4>Item Price</h4></div>
<div class="col-sm-2 dt0"><h4>Quantity</h4></div>
<div class="col-sm-2 dt0"><h4>Total Price</h4></div>
<?php 
foreach ($cart as $items){ 
//print_r($items);
?>
<div class="col-sm-6 dt0"> 
<div class="col-sm-4 item-img">
<img src="<?php echo $items['options']['image'];?>">
<!--a href="#">Move to wish list</a-->
<a href="<?php echo base_url().'cart/remove/'.$items['rowid'];?>">Remove</a>
</div>
<div class="col-sm-8 item-info">
<h5><?php echo $items['name']; ?></h5>
<?php echo $items['options']['desc']; ?>
</div>

</div>
<div class="col-sm-2 dt0"> 
<div class="dat0">₹<?php echo $items['price']; ?></div>
</div>
<div class="col-sm-2 dt0">
<div class="dat0"><?php echo $items['qty']; ?></div>
</div>
<div class="col-sm-2 dt0">
<div class="dat0">₹<?php echo $i_total = $items['qty'] * $items['price']; ?></div> 
</div>
<div class="clearfix"></div>
<?php 
$sub_total = $sub_total + $i_total;
$comm_dis = $comm_dis + ($items['qty'] * $items['comm_dis']);
} 
	/******************* session define *****************/
$this->session->set_userdata('order_sub_total',$sub_total);
$this->session->set_userdata('order_shipping',$shipping);
$this->session->set_userdata('order_tax',$tax);
$this->session->set_userdata('comm_dis',$comm_dis);
?>

</div>

<div class="col-sm-12">
<div class="col-sm-4">
<div class="col-sm-12 apl">
<span>Enter Coupon Code</span>
	<?php
	$coupon_val = '0';
	if($coupon_form == 'true') { /*print_r($coupon_result);*/
				$date = 'false';
		        $this->session->set_userdata('coupon_val','');
				$this->session->set_userdata('coupon_code','');
				if($coupon_result[0]['start_date']=='' || $coupon_result[0]['end_date']=='') {
					$date = 'true';
				} else {
					$current_date = strtotime(date('m/d/Y'));
					$sdate = strtotime($coupon_result[0]['start_date']);
					$edate = strtotime($coupon_result[0]['end_date']);
					if($sdate < $current_date && $edate > $current_date) {
						$date = 'true';
					} else {
						echo '<p class="error">Coupon date has expire.</p>';
					}
				}
				if($date == 'true') {
					$amount = $coupon_result[0]['amount'];
					if($coupon_result[0]['type']=='Percentage') { 
					   $coupon_val = ($amount / 100) * $sub_total;
					   $coupon_val = round($coupon_val,2);
					   $this->session->set_userdata('coupon_val',$coupon_val);
					   $this->session->set_userdata('coupon_code',$coupon_result[0]['code']);
					}
				}
			}
	if($coupon_form == 'false') { 
		echo '<p class="error">Coupon code is not valid.</p>';
		$this->session->set_userdata('coupon_val','');
	    $this->session->set_userdata('coupon_code','');
	} 
	?>
<form name="coupon" method="post" action="<?php echo base_url();?>cart" class="form form-inline">
<input required type="text" class="form-control" name="coupon"> <input type="submit" class="btn btn-primary" name="coupon_submit" value="Apply">
	</form>

<div class="col-sm-12 expr">
<!--my bag will expire :00-->
</div>
<div class="col-sm-12 to00">
	<a href="<?php echo base_url();?>bliss-products"><button> Continue Shopping</button></a>
</div>
</div>
</div>
<div class="col-sm-8 itm-lst">
<?php
$total_order = ($sub_total + $tax + $shipping) - $coupon_val;
$this->session->set_userdata('order_total',$total_order);
?>
<ul>
<li> Sub total <span>₹<?php echo $sub_total; ?></span></li>
<?php if($this->session->userdata('coupon_val')!='') { ?>
<li> Discount <span>₹<?php echo $this->session->userdata('coupon_val'); ?></span></li>
<?php } ?>
<li> Shipping <span>₹<?php echo $shipping; ?></span></li>
<li> Tax <span>₹0</span></li>
<li> Grand total <span>₹<?php echo $total_order; ?></span></li>
<li class="hide"> Distribution Amount <span>₹<?php echo $comm_dis; ?></span></li>
</ul>
<div class="col-sm-12 to000">
	<a href="<?php echo base_url();?>checkout"><button> Checkout</button></a>
</div>
</div>
</div>

<div class="col-sm-12 like-may">
 <h2>You may also like</h2> 
 </div>
 
<?php } else {  echo '<p>Your cart is empty. <a href="/bliss-products">Click here</a> for search product.</p>';  } ?>

</div>