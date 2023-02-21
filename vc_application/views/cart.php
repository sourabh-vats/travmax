<style>
.cart_delete a {
	background: #2F3C97;
	
}
.apply-btn {
	padding: 5px 29px;	
}
@media (max-width:600px){
.spa {
	margin-right: 66px;
}
.five {
	margin-left: 174px !important;
}
}
</style>


<?php $this->load->view('includes/front/leftsidebar');?>

<div class="container pd" style="background:#fff;">		
		
<?php 
$cart = $this->cart->contents();
if(!empty($cart)) { 
$sub_total = $comm_dis = 0;
$shipping = 0;
$tax = 0;
?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				
			</div>
<form class="hide" method="post" action="/cart" id="updatecartform">
<input type="hidden" name="rowid" value="" class="rowid-val">
<input type="hidden" name="qty" value="" class="qty-val">
<input type="hidden" name="type" value="" class="type-val">
</form>	
				
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="it">Your Items</td>
							<td class="description"></td>
							<td class="price">Item Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total Price</td>
							<td></td>
						</tr>
					</thead>
					
					<tbody>
					
					<?php 
foreach ($cart as $items){ 
//print_r($items);
?>
						<tr>
							<td class="cart_product">
								<img class="spa" src="<?php echo $items['options']['image'];?>">
<!--a href="#">Move to wish list</a-->

							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $items['p_name']; ?></a></h4>
								<p>Pro. ID: #<?php echo $items['id']; ?></p>
							</td>
							<td class="cart_price">
								<p>₹<?php echo $items['price']; ?></p>
							</td>
							<td class="cart_quantity">
							<?php echo $items['qty']; ?>
								<!--div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div-->
							</td>
							<td class="cart_total">
								<p class="cart_total_price">₹<?php echo $i_total = $items['qty'] * $items['price']; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="<?php echo base_url().'cart/remove/'.$items['rowid'];?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
						<?php 
$tax = $tax + ($items['qty'] * $items['tax']);
$sub_total = $sub_total + $i_total;
$comm_dis = $comm_dis + ($items['qty'] * $items['comm_dis']);
} 
	/******************* session define *****************/
$this->session->set_userdata('order_sub_total',$sub_total);
$this->session->set_userdata('order_shipping',$shipping);
$this->session->set_userdata('order_tax',$tax);
$this->session->set_userdata('comm_dis',$comm_dis);
?>

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->


<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
					
					<?php
	$coupon_val = '0';
	if($coupon_form == 'true') { /*print_r($coupon_result);*/
				$date = 'false'; $coupon_user_limit = 'true';
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
				if($coupon_result[0]['per_user'] > 0) {
					$cust_id = $this->session->userdata('cust_id');
		            if($cust_id=='') { 
					   echo '<p class="error">Please first login for apply this coupon.</p>';
                       $coupon_user_limit = 'false';
				    }
					elseif($coupon_count_order[0]['total'] > 0) {
						echo '<p class="error">You can not use this coupon again. You already apply this coupon.</p>';
                        $coupon_user_limit = 'false';  
					}
				}
				$coupon_status = 'true';
				if($coupon_result[0]['status']!='Active') {
					echo '<p class="error">This coupon is not more exist.</p>';
                        $coupon_status = 'false';  
				}
				if($date == 'true' && $coupon_user_limit == 'true' && $coupon_status == 'true') {
					$amount = $coupon_result[0]['amount'];
					if($coupon_result[0]['type']=='Percentage') { 
					   $coupon_val = ($amount / 100) * $sub_total;
					   $coupon_val = round($coupon_val,2);
					} else {
                                           $coupon_val = $amount;
                                        }
					$this->session->set_userdata('coupon_val',$coupon_val);
					$this->session->set_userdata('coupon_code',$coupon_result[0]['code']);
				}
			}
	if($coupon_form == 'false') { 
		echo '<p class="error">Coupon code is not valid.</p>';
		$this->session->set_userdata('coupon_val','');
	    $this->session->set_userdata('coupon_code','');
	} 
	?>
						<ul class="user_option">
						<li>
						<form name="coupon" method="post" action="<?php echo base_url();?>cart" class="form form-inline">
                <input required type="text" class="form-control" name="coupon">
                <input type="submit" class="btn btn-primary apply-btn five" name="coupon_submit" value="Apply">
	</form>
							</li>
							
						</ul>
						
						<div class="col-sm-12 expr">
                     <!--my bag will expire :00-->
                        </div>
						<!--a class="btn btn-default update" href="">Get Quotes</a-->
						<a class="btn btn-default check_out update" href="<?php echo base_url();?>">Continue Shopping</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					
					<?php
$total_order = ($sub_total + $tax + $shipping) - $coupon_val;
$this->session->set_userdata('order_total',$total_order);
$coupon_amount = $this->session->userdata('coupon_val') + 0;
?>
<ul>
							<li>Cart Sub Total <span>₹<?php echo $sub_total; ?></span></li>
							<li>Discount<span>₹<?php echo $coupon_amount; ?></span></li>
							<li>Shipping Cost <span>₹<?php echo $shipping; ?></span></li>
							<li> Tax <span>₹0</span></li>
							<li> Grand total <span>₹<?php echo $total_order; ?></span></li>
                            <li class="hide"> Distribution Amount <span>₹<?php echo $comm_dis; ?></span></li>
						</ul>
							<a class="btn btn-default update apply-btn" href="">Update</a>
							<a class="btn btn-default check_out apply-btn" href="<?php echo base_url();?>checkout">Check Out</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->





<!--div class="col-sm-12 like-may">
 <h2>You may also like</h2> 
 </div-->
 
<?php } else { ?>			
			<p class="text-center"><img src="<?php echo base_url();?>/assets/front/images/cart.png" ></p>
<h2 class="text-center">Your Cart is currently empty.</h2>
  <p class="text-center"><a class="btn btn-primary btn-lg crtbtn" href="<?php echo base_url();?>" role="button">Return to shop</a></p>
<p>&nbsp; </p>
<?php } ?>

</div>
