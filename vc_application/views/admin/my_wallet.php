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

<div class="smry smry4  text-center"><h2><b>My Wallet</b></h2>
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
		
		<div class="macro_crdts wllettss">
			<div class="mcro_prdcts my_wlletts">
				<div class="macro_txt">
				<h5>Online<br>Shopping</h5>
				<a href="#">Click Here</a>
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/wllts1.png"alt="macro">
              </div>
		</div>
		<div class="mcro_prdcts  my_wlletts">
				<div class="macro_txt">
				<h5>All<br>Recharges</h5>
				<a href="<?php echo base_url(); ?>admin/recharge">Click Here</a>
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/wllts2.png"alt="macro">
              </div>
		</div>
		<div class="mcro_prdcts  my_wlletts">
				<div class="macro_txt">
				<h5>Macro<br>Purchases</h5>
				<a href="#">Click Here</a>
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/wllts3.png"alt="macro">
              </div> 
		</div>
		<div class="mcro_prdcts  my_wlletts">
				<div class="macro_txt">
				<h5>Activate Friend's <br> Account</h5>
				<a href="#">Click Here</a>
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/wllts4.png"alt="macro">
              </div>
		</div>
		<div class="mcro_prdcts  my_wlletts">
				<div class="macro_txt">
				<h5>Wallet<br>History<br></h5>
				<a href="#">Click Here</a>
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/wllts5.png"alt="macro">
              </div>
		</div>
		
		</div>



		
</div>
