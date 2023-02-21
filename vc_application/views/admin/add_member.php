	<style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading">
        <h2>Add Member</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'activated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Member Added successfully.';
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
      echo form_open('admin/add_member', $attributes);
      ?>
        <fieldset>
		   <div class="form-group col-sm-4">
            <label>Member ID :</label>
              <input type="hidden" name="find_customer" value="yes" >
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
          </div> 
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Find Member</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/add_member'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); 
	  
	  } 
	  else {
		  echo form_open('admin/add_member/'.$this->uri->segment(3), $attributes);
		  ?>
		 <fieldset>
		   <div class="form-group col-sm-4">
            <p><label>Member: </label>&nbsp;<?php echo $user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].')';?> 
              <input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" > 
			  <input type="hidden" name="fid" value="<?php echo $user[0]['id']; ?>" >
           </p>

          		
       </div> 
			
          
          <div class="form-group  col-lg-12">
            <button class="btn btn-success" type="submit">Add Member</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/add_member'; ?>">Back </a>
          </div>
        </fieldset>  
		  
	  <?php 
	  echo form_close(); 
	  } ?>
	