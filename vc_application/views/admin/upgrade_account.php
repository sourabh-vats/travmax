<style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 
.smry4 {
    background: url(<?php echo base_url(); ?>images/edit-ing.jpg) no-repeat scroll center;
  
}
.smry {   
    font-size: 45px;
}
.smry {
	padding: 10px 0;
	line-height: normal;
	color: #fff;
	margin-bottom: 24px;
}
.col-sm-10 {
    
    padding: 0 !important; 
}
</style>
<div class="smry smry4  text-center"><h2><b>Become Macro</b></h2>
</div>      
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'activated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> You Become Macro successfully.';
          echo '</div>';       
        }  elseif($this->session->flashdata('flash_message') == 'no_record'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>Active Record Not Found. Come Back Soon.';
          echo '</div>';          
        } elseif($this->session->flashdata('flash_message') == 'already'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>You Already Used Activated Your Account.';
          echo '</div>';          
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>PIN not activated please try again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      if(empty($user)) {
      echo form_open('admin/upgrade_account', $attributes);
      ?>
        <fieldset>
		   <div class="form-group col-sm-4">
            <label>Customer ID :</label>
              <input type="hidden" name="find_customer" value="yes" >
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
          </div> 
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Find Customer</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); 
	  
	  } 
	  else {
		  echo form_open('admin/upgrade_account/'.$this->uri->segment(3), $attributes);
		  ?>
		 <fieldset>
		   <div class="form-group col-sm-4">
            <p><label>Customer: </label>&nbsp;<?php echo $user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].')';?> 
              <input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" >
              <input type="hidden" name="pin" value="<?php $this->uri->segment(3); ?>" ></p>
			  <p><label>Wallet Balance: </label>&nbsp;INR <?php echo $profile[0]['income_wallet'];?></p>
			  
      
        <input type="hidden" name="product" value="2596" >
       <p><label>Activation Package: </label>&nbsp; 2200 + 396 (18% GST) = INR 2596</p>



         
          		
       </div> 
			
          
		  
		  <!--<p><label>package: </label>&nbsp;Rs 8000 
             </p>-->			  		  
		  
		  
		 
		   
		
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-success" type="submit">Buy Macro Package</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/upgrade_user'; ?>">Upgrade User </a>
       <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </fieldset>  
		  
	  <?php 
	  echo form_close(); 
	  } ?>
	