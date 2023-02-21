	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/franchise'; ?>">Back</a>
        <h2>Update Franchise Area </h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> franchise  updated successfully.';
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
      
      echo form_open_multipart('admin/franchise/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $category[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		<div class="form-group col-sm-6">
            <label>Franchise Area</label>
              <input type="text" class="form-control"  name="c_name" value="<?php if($this->input->post('c_name')!='') { echo $this->input->post('c_name'); } else { echo $prod['c_name']; } ?>" >
          </div>
			
		  
		   <div class="form-group col-sm-6">
           <label>Parent State<small style="color:red">*</small></label>
            
			<select name="p_category" class="form-control custom-select">
			<option value="">Select</option> 
			  <?php if(!empty($parentcat)) {
				  foreach($parentcat as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($prod['p_id']==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['c_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>
		  
		 
		  
		  <div class="form-group col-sm-6">
           <label>Status <small style="color:red">*</small></label>
               <select name="status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option <?php if($prod['status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>
			  </select>
          </div> 
		 
		  	  
		   <div class="form-group col-sm-12">
            <label>Referral code</label>
              <input type="text" class="form-control"  name="code_no" value="<?php if($this->input->post('code_no')!='') { echo $this->input->post('code_no'); } else { echo $prod['code_no']; } ?>">
          </div>
		  
		  <div class="form-group col-sm-6">
            <label>Percentage</label>
              <input type="number" class="form-control"  name="percentage" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); } else { echo $prod['percentage']; } ?>" >
          </div>
			 <div class="form-group col-sm-4">
           <label>Type<small style="color:red"></small></label>
             <select required name="type" class="form-control custom-select">
			
		<option <?php if($prod['type']=='Phase 1') {echo 'selected';}?> value="Phase 1">Phase 1</option>
        <option <?php if($prod['type']=='Phase 2') {echo 'selected';}?> value="Phase 2">Phase 2</option>
		 <option <?php if($prod['type']=='Phase 3') {echo 'selected';}?> value="Phase 3">Phase 3</option>
			 
			  </optgroup>
			  
   </select> 
          </div> 
			  
         
		  
	<div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Update</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/category'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>