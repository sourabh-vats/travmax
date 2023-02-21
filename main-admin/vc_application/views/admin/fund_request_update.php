	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/fund_request_list'; ?>">Back</a>
        <h2>Update Fund Request</h2>
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
	  //print_r($category);
      
      echo form_open_multipart('admin/fund_request/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $category[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		
		
		<div class="form-group col-sm-6">
            <label>Customer ID</label>
              <input type="text" readonly class="form-control"  name="customer_id" value="<?php echo $prod['cus'];  ?>" >
          </div>
		   <div class="form-group col-sm-6">
            <label>Amount</label>
              <input type="text" readonly class="form-control"  name="amount" value="<?php echo $prod['amount'];  ?>" >
          </div>
		  <!--<div class="form-group col-sm-6">
            <label> No Of pins </label>
              <input type="text" readonly class="form-control"  name="pins" value="<?php echo $prod['pins'];  ?>" >
          </div>-->
		   <!-- <div class="form-group col-sm-6">
            <label>Package</label>
              <input type="text" readonly class="form-control"  name="package" value="<?php echo $prod['package'];  ?>" >
          </div> -->
		  <div class="form-group col-sm-6">
            <label>Description</label>
              <textarea class="form-control"  name="description" ><?php if($this->input->post('description')!='') { echo $this->input->post('description'); } else { echo $prod['description']; } ?></textarea>
          </div>
		 <!--   <div class="form-group col-sm-6">
            <label>Payment On</label>
              <input type="text" readonly class="form-control"  name="payment_no" value="<?php echo $prod['payment_no'];  ?>" >
          </div> -->
		  <div class="form-group col-sm-6">
            <label> Payment mode</label>
              <input type="text" readonly class="form-control"  name="mode" value="<?php echo $prod['mode'];  ?>" >
          </div>
		  <div class="form-group col-sm-6">
            <label> UTR No</label>
              <input type="text" readonly class="form-control"  name="neft" value="<?php echo $prod['neft'];  ?>" >
          </div>
		 
		
		  	
		  	<!-- <div class="form-group col-sm-6">
            <label>bank_name</label>
              <input type="text" readonly class="form-control"  name="bank_name" value="<?php echo $prod['bank_name'];  ?>" >
          </div>-->
		  	  
		  
		  
		  
		   
		   
		  <!-- <div class="form-group col-sm-6">
            <label>Date</label>
              <input type="date" readonly class="form-control"  name="date" value="<?php echo $prod['date'];  ?>" >
          </div> -->
		   
		   

 
		
		  
		<div class="form-group col-sm-6">         
		  <label>Status <small style="color:red">*</small></label>    
		  <select name="status" class="form-control custom-select">			
		  <option value="Pending">Pending</option>		
		  <option <?php if($prod['status']=='Rejected') { echo 'selected="selected"'; } ?> value="Rejected">Rejected</option>		
		  <option <?php if($prod['status']=='Completed') { echo 'selected="selected"'; } ?> value="Completed">Completed</option>		
		  </select>      
		  </div> 
		  <div class="form-group col-lg-6 col-mg-12 col-sm-6">
        <label  class="control-label col-sm-5">Image</label>
         <div class="form-group col-sm-2">
<?php if($prod['image'] !='') { echo '<img src="'.base_url().'../assets/images/'.$prod['image'].'" width="50" height="50">'; } ?>
<a class="btn btn-primary btn-view" href="<?php echo base_url().'../assets/images/'.$prod['image'];?>">view</a>
</div>
			    
          </div>
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pin_request_list'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>