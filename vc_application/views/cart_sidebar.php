  <div class="table-responsive cart_info">	
  <table class="table table-condensed">	
  <thead>		
  <tr class="cart_menu">
  <td class="it">Item</td>
  <td class="description"></td>	
  <td class="price">Price</td>	
  <td class="quantity">Quantity</td>
  <td class="total">Total</td>	
  <td></td>					
  </tr>					
  </thead>					
  <tbody>
  <?php	  $cart = $this->cart->contents();if(!empty($cart))
	  { foreach ($cart as $items){ 	$i_total = $items['qty'] * $items['price'];		echo '<tr>
  <td class="cart_product">	
  <a href=""><img src="'.$items['options']['image'].'"></a>
  </td>							
  <td class="cart_description">	
  <h4><a href="">'.$items['p_name'].'</a></h4>
  <p>Web ID: #'.$items['id'].'</p>	
  </td>							
  <td class="cart_price">	
  <p>Rs. '.$items['price'].'</p>
  </td>					
  <td class="cart_quantity">	
  '.$items['qty'].'								
  <!--div class="cart_quantity_button">									<a class="cart_quantity_up" href=""> + </a>									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">									
  <a class="cart_quantity_down" href=""> - </a>								</div-->							
  </td>							
  <td class="cart_total">
  <p class="cart_total_price">Rs. '.$i_total.'</p>
  </td>							
  <td class="cart_delete">
  <a class="cart_quantity_delete" href="'. base_url().'cart/remove/'.$items['rowid'].'"><i class="fa fa-times"></i></a>
  </td>	
  </tr>';}}	  ?>						
  <tr>
  <td colspan="4">&nbsp;</td>	
  <td colspan="2">		
  <table class="table table-condensed total-result">
  <tr>										
  <td>Cart Sub Total</td>
  <td>Rs. <?php echo $this->session->userdata('order_sub_total');?></td>
  </tr>	
 <tr class="discount">	
  <td>Discount</td>
  <td>Rs. <?php echo $this->session->userdata('coupon_val'); ?></td>
  </tr>	  
  <tr class="shipping-cost">	
  <td>Shipping Cost</td>
  <td>Rs. <?php echo $this->session->userdata('order_shipping');?></td>
  </tr>	
  <tr>
  <td>Total</td>	
  <td><span>Rs. <?php echo $this->session->userdata('order_total');?></span></td>
  <!--li class="hide">Distribution Amount<span>Rs. <?php //echo $this->session->userdata('comm_dis');?></span></li-->	
  </tr>	
    <tr class="emi-payment" style="display:none;">
  <td>First EMI instalment</td>	
  <td><span>Rs. <?php echo round(($this->session->userdata('order_total') / 2),2);?></span></td>
  </tr>	
  </table>
  </td>	
  </tr>	
  </tbody>
  </table>
  </div>