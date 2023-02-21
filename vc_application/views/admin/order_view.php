	<?php 
if(empty($order)) {
	echo '<div class="page-heading"><a class="btn btn-primary flr" href="'.base_url().'admin/order'.'">Back</a>
        <h2>Order not found</h2>
      </div><p>Order not found please check the url.</p>';
} else { 
$order_data = $order[0]; ?>
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	.itm-lst li span{float:right;}
		 .itm-lst li{clear:both;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/order'; ?>">Back</a>
        <h2>Order #<?php echo $order_data['id'];?></h2>
      </div>
 
      <?php
      //flash messages
     /* if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> category updated successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }*/
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      //echo form_open('admin/order/edit/'.$this->uri->segment(4).'', $attributes);
	  
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $order_data['id']; ?>" name="cid">
		
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Contact Info</h4></div>
            <div class="panel-body">
				<div class="col-sm-8">
			  <h4><?php echo $order_data['p_name']; ?></h4>
			  <?php echo $order_data['p_email']; ?><br>
			  <?php echo $order_data['p_phone']; ?><br>
			  <?php echo $order_data['p_address'].' '.$order_data['p_address2'].' '.$order_data['p_city'].' '.$order_data['p_zip'].' '.$order_data['p_state']; ?><br><br>
			</div>
				<div class="col-sm-4">
			  <h4>Order Status</h4>
					<p><?php echo $order_data['status']; ?></p>
				</div>
			</div>
        </div>
		
		<?php 
$sub_total = 0;
$shipping = 0;
$tax = 0;
$cart = json_decode($order_data['items'],true);
?>

		<div class="panel panel-default">
			<div class="panel-heading"><h4>Items</h4></div>
            <div class="panel-body">
			  <div class="col-sm-12 top-tem">
				<div class="col-sm-6 dt0"><h4>Your Items</h4></div>
				<div class="col-sm-2 dt0"><h4>Item Price</h4></div>
				<div class="col-sm-2 dt0"><h4>Quantity</h4></div>
				<div class="col-sm-2 dt0"><h4>Total Price</h4></div>

			  <?php foreach($cart as $items) { ?>
			     
<div class="col-sm-6 dt0"> 
<div class="col-sm-4 item-img">
<img src="<?php echo $items['options']['image'];?>">
</div>
<div class="col-sm-8 item-info">
<h4><?php echo $items['name']; ?></h4>
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
 } ?>
			</div>
			
			<div class="col-sm-12">
<div class="col-sm-5"></div>
<div class="col-sm-7 itm-lst">
<ul>
<?php  $total_order = $sub_total + $tax + $shipping; ?>
<li> Sub total <span>₹<?php echo $sub_total; ?></span></li>
<li> Shipping <span>₹<?php echo $shipping; ?></span></li>
<li> Tax <span>₹0</span></li>
<li> Grand total <span>₹<?php echo $total_order; ?></span></li>
</ul>

</div>
</div>


        </div>
		
 
		   
		  	 

          <!--div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php //echo base_url().'admin/order'; ?>">Cancel </a>
          </div-->
        </fieldset>
      <?php } //echo form_close(); ?>
	  