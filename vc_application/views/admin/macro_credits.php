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

<div class="smry smry4  text-center"><h2><b>My Macro Credits</b></h2>
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
		
		<h2>you can use macro credits to buy macro products on the macro mall</h2>
		
		<div class="macro_crdts">
			<div class="mcro_prdcts">
				<a href="javascript:;">
				<div class="macro_txt">
				<h5>Mobile</h5>
				
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/iphone_macro.png"alt="macro">
              </div>
			</a> 
		</div>
		<div class="mcro_prdcts">
				<a href="javascript:;">
				<div class="macro_txt">
				<h5>Gadgets</h5>
				
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/gdgets.png"alt="macro">
              </div>
			</a> 
		</div>
		<div class="mcro_prdcts">
				<a href="javascript:;">
				<div class="macro_txt">
				<h5>Fashion</h5>
				
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/fshn.png"alt="macro">
              </div>
			</a> 
		</div>
		<div class="mcro_prdcts">
				<a href="javascript:;">
				<div class="macro_txt">
				<h5>Grocery</h5>
				
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/grocry.png"alt="macro">
              </div>
			</a> 
		</div>
		<div class="mcro_prdcts">
				<a href="javascript:;">
				<div class="macro_txt">
				<h5>Furniture<br></h5>
				
              </div>
			  <div class="macro_imgss">
				<img src="<?php echo base_url(); ?>/assets/images/frntr.png"alt="macro">
              </div>
			</a> 
		</div>
		
		</div>



		
</div>
