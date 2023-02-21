<style>
.smry4 {
    background: url(../images/edit-ing.jpg) no-repeat scroll center;
  
}
.smry {
    font-size: 45px;
}
.smry {
    padding: 10px 0;
    line-height: normal;
	color: #fff;
}
.col-sm-10 {
    
    padding: 0 !important;
}




</style>

<div class="smry smry4  text-center"><h2>Add Money</h2>
</div>
<div class="col-sm-12">
<?php 
$user = $profile[0]; 
?>




</div>
<div class="col-sm-12 right-bar">

<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Profile updated successfully.';
          echo '</div>';       
        } /*elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		}*/
      }
	  
	  if($user['var_status']=='no') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your profile is under review please wait 2 working days';
          echo '</div>';
           }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open_multipart(base_url().'admin/profile', $attributes);
      ?>
	  
		<input type="hidden" value="<?php echo $user['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $user['var_status']; ?>" name="var_status">

		<p>&nbsp;</p>
<!--p>Reference URL: <strong><?php echo base_url().'reference/'.$user['customer_id'];?></strong></p-->
<p>&nbsp;</p>

		  <div class="main-wallet monyess">
  <div class="row">

    <div class="col-md-4 text-center">
		<div class="wallet">
		<a href="<?php echo base_url(); ?>admin/payment">
		<h4>Online Payment</h4>
		<p>Click Here for Online Payments</p>
		</a> 
		<img src="<?php echo base_url(); ?>/assets/images/online_pymnt.png"alt="macro">
	</div>
	</div>
	
    <div class="col-md-4 text-center">
	<div class="wallet">
		<a href="<?php echo base_url(); ?>admin/request-fund">
		<h4>Upload Receipt</h4>
		<p>Upload Receipt in case of Bank Deposit</p>
		</a>
		<img src="<?php echo base_url(); ?>/assets/images/receipts.png"alt="macro">
	</div>
	</div>
	
    <div class="col-md-4 text-center">
	<div class="wallet">
		<a href="<?php echo base_url(); ?>admin/transfer_master">
		<h4>Transfer Moneyback</h4>
		<p>Transfer Approved Moneyback to your wallet</p>
		</a>
		<img src="<?php echo base_url(); ?>/assets/images/wallets.png"alt="macro">
	</div>
	</div>
    
  </div>
</div>
		  
</div>
