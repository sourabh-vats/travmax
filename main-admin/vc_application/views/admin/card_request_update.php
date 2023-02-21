	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/card_request'; ?>">Back</a>
        <h2>Update Card Request</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Request updated successfully.';
          echo '</div>';       
        } elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		} else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
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
      
      echo form_open('admin/card_request/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $tax[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $prod['user_id']; ?>" name="user_id">
		
		<div class="form-group col-sm-12">
            <label>user_id</label>
              <input type="text" class="form-control"  name="cus_id" value="<?php if($this->input->post('cus_id')!='') { echo $this->input->post('cus_id'); } else { echo $prod['customer_id']; } ?>" >
          </div>
		  <div class="form-group col-sm-12">
            <label>Name</label>
              <input type="text" class="form-control"  name="name" value="<?php if($this->input->post('name')!='') { echo $this->input->post('name'); } else { echo $prod['f_name']; } ?>" >
          </div>
		  <div class="form-group col-sm-12">
            <label>Card Number</label>
              <input type="number" class="form-control"  name="cr_no" value="<?php if($this->input->post('cr_no')!='') { echo $this->input->post('cr_no'); } else { echo $prod['cr_no']; } ?>" >
          </div>
		  <div class="form-group col-sm-12">
            <label>Phone</label>
              <input type="number" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $prod['phone']; } ?>" >
          </div>
		  
		     <div class="form-group col-sm-12">
            <label>Status</label>
              <select name="status" class="form-control">
			  <option <?php if($prod['status']=='approved') { echo 'selected="selected"'; } ?> value="approved">Approved</option>
			  <option <?php if($prod['status']=='pending') { echo 'selected="selected"'; } ?> value="pending">Pending</option>
			  <option <?php if($prod['status']=='cancel') { echo 'selected="selected"'; } ?> value="cancel">Cancel</option>
			  </select>
          </div> 
		  

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/card_request'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	   