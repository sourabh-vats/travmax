 <div class="col-sm-3">
  <div class="right-sumary to-0-1">
  <h4 class="cft">Cart Summary</h4>
  <ul>
<?php	  $cart = $this->cart->contents();
if(!empty($cart)) { 
foreach ($cart as $items){ 
	$i_total = $items['qty'] * $items['price'];
	echo '<li>'.$items['name'].'<span>Rs. '.$i_total.'</span></li>';
}
}
	  ?> 
  <li>Sub Total<span>Rs. <?php echo $this->session->userdata('order_sub_total');?></span></li>
  <li>Shipping<span>Rs. <?php echo $this->session->userdata('order_shipping');?></span></li>
  <li>Grand Total<span>Rs. <?php echo $this->session->userdata('order_total');?></span></li>
   <li class="hide">Distribution Amount<span>Rs. <?php echo $this->session->userdata('comm_dis');?></span></li>
  </ul>
  <button class="huo">Place Your Order</button>
  </div>
  
    </div>