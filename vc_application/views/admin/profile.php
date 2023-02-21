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

<div class="smry smry4  text-center"><h2><b>Personal Details</b></h2>
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

		 <div class="form-group col-sm-6">
            <label>Partner ZKey</label>
              <input type="text" class="form-control" readonly  name="bsacode" value="<?php echo $user['customer_id'];?>" >
          </div>
		  
		<div class="form-group col-sm-3">
            <label>Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $user['image']; ?>" name="image_old">
          </div>  
		  <div class="form-group col-sm-3">
<?php if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="100">'; } ?>
</div>

        <div class="form-group col-sm-6">
            <label>First Name</label>
              <input type="text" class="form-control" required name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $user['f_name']; } ?>" >
          </div>
        <div class="form-group col-sm-6">
            <label>Last Name</label>
              <input type="text" class="form-control" required name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $user['l_name']; } ?>" >
          </div>

		  <div class="form-group col-sm-6">
            <label>Gender</label>
			<select class="form-control"  name="gender">
            <option value="Male">Male</option>
			<option <?php if($user['gender']=='Female') { echo 'selected="selected"'; } ?> value="Female">Female</option>
			</select>
          </div>
        <div class="form-group col-sm-6">
            <label>Date of Birth</label>
              <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="dob" value="<?php if($this->input->post('dob')!='') { echo $this->input->post('dob'); } else { echo $user['dob']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>Phone</label>
              <input type="number" class="form-control" required name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
        <div class="form-group col-sm-6">
            <label>Email</label>
              <input type="email" class="form-control" readonly name="email" value="<?php echo $user['email']; ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>Address</label>
              <input type="text" class="form-control" required name="address" value="<?php if($this->input->post('address')!='') { echo $this->input->post('address'); } else { echo $user['address']; } ?>" >
          </div>
        <div class="form-group col-sm-6 hide">
            <label>City</label>
              <input type="text" class="form-control" readonly="" required name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $user['city']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-6 hide">
            <label>State</label>
              <input type="text" class="form-control" readonly="" required name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $user['state']; } ?>" >
          </div>
        <div class="form-group col-sm-6">
            <label>Pincode</label>
              <input type="number" class="form-control" required name="pincode" value="<?php if($this->input->post('pincode')!='') { echo $this->input->post('pincode'); } else { echo $user['pincode']; } ?>" >
          </div>
          
        
		  
		  
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input required type="checkbox" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. </label></div>
		  
		  
		  
		  
          <div class="form-group  col-lg-12">
              <?php if($user['var_status']!='yes'){?>
            <button class="btn btn-primary" type="submit">Update</button>
               <a href="<?php echo base_url(); ?>admin/password" class="btn btn-primary">Change Password</a>
			 &nbsp; 
            <?php }else { ?>
         
            <h2>if you want to changes in your profile <a href="https://www.realwater.in/contact_us">click here</a> to contact us.</h2> 
            
          <?php  } ?>
          </div>
		  
		  <?php echo form_close(); ?>
		  
</div>
