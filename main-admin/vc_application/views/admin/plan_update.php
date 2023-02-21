	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/plan'; ?>">Back</a>
        <h2>Update Operators</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> plan updated successfully.';
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
      
      echo form_open_multipart('admin/plan/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $plan[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		
		
		
			<div class="form-group col-sm-4">
            <label>Price</label>
             <input type="text" class="form-control"  name="price" value="<?php if($this->input->post('price')!='') { echo $this->input->post('price'); } else { echo $prod['price']; } ?>" >
          </div>
		  
		<div class="form-group col-sm-4">
            <label>Talktime</label>
			  
			    <input type="text" class="form-control"  name="talktime" value="<?php if($this->input->post('talktime')!='') { echo $this->input->post('talktime'); } else { echo $prod['talktime']; } ?>" >
			  
          </div>
		  <div class="form-group col-sm-4">
            <label>Validity</label>
			
			<input type="text" class="form-control"  name="validity" value="<?php if($this->input->post('validity')!='') { echo $this->input->post('validity'); } else { echo $prod['validity']; } ?>" >
			
          </div>
		  <div class="form-group col-sm-4">
            <label>Description</label>
			<input type="text" class="form-control"  name="description" value="<?php if($this->input->post('description')!='') { echo $this->input->post('description'); } else { echo $prod['description']; } ?>" >
			
          </div>
		  
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
            <label>Browse Plans</label>
              <select name="plan" class="form-control">
			  <option <?php if($prod['plan']=='recharge') { echo 'selected="selected"'; } ?> value="">Select Service</option>
			  <option <?php if($prod['plan']=='Best Offer') { echo 'selected="selected"'; } ?> value="Best Offer">Best Offer</option>
			  <option <?php if($prod['plan']=='Full Talktime') { echo 'selected="selected"'; } ?> value="Full Talktime">Full Talktime</option>
			  <option <?php if($prod['plan']=='3G/4G Data') { echo 'selected="selected"'; } ?> value="3G/4G Data">3G/4G Data</option>
			  <option <?php if($prod['plan']=='2G Data') { echo 'selected="selected"'; } ?> value="2G Data">2G Data</option>
			  <option <?php if($prod['plan']=='Top Up') { echo 'selected="selected"'; } ?> value="Top Up">Top Up</option>
			  <option <?php if($prod['plan']=='Special Recharge') { echo 'selected="selected"'; } ?> value="Special Recharge">Special Recharge</option>
			  <option <?php if($prod['plan']=='Roaming') { echo 'selected="selected"'; } ?> value="Roaming">Roaming</option>
			 
			  </select>
          </div> 
		
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
		<label>Operator</label> <select name="operator" class="form-control custom-select">
			<option selected disabled value="">Select</option> 
			  <?php if(!empty($operator)) {
				  foreach($operator as $value) {
					  echo '<option value="'.$value['Operator_Code'].'" ';
					  echo '>'.$value['oper_name'].'</option>';
				  }
			  } ?>
			  </select>
</div> 


 <div class="form-group col-lg-4 col-mg-6 col-sm-6">
		 <label>Circle</label> <select name="circle" class="form-control custom-select">
			<option selected disabled value="">Select</option> 
			  <?php if(!empty($circle)) {
				  foreach($circle as $valuec) {
					  echo '<option value="'.$valuec['cir_code'].'"';
					  echo '>'.$valuec['cir_name'].'</option>';
				  }
			  } ?>
			  </select>
</div> 


		  <div class="form-group col-sm-6">
           <label>Status <small style="color:red">*</small></label>
               <select name="pl_status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option <?php if($prod['pl_status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>
			  </select>
          </div> 
				  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/plan'; ?>">Cancel </a>
          </div>
		  </div>
		  
		  
		
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>