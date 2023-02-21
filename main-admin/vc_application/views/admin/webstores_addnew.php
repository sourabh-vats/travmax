	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/webstores'; ?>">Back</a>
        <h2>Add New Operator</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Operator added successfully.';
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
      
      echo form_open_multipart('admin/webstores/add', $attributes);
      ?>
        <fieldset> 
		
		<div class="form-group col-sm-4">
            <label>Operators Name</label>
              <input type="text" class="form-control"  name="oper_name" value="<?php if($this->input->post('oper_name')!='') { echo $this->input->post('oper_name'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Operator Code</label>
              <input type="text" class="form-control"  name="Operator_Code" value="<?php if($this->input->post('Operator_Code')!='') { echo $this->input->post('Operator_Code'); }  ?>" >
          </div>
		  
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
            <label>Service Type</label>
              <select name="Service_Type" class="form-control">
			  <option value="">Select Service</option>
			  <option value="Water-Bills">Water Bills</option>
			  <option value="Prepaid-Mobile">Prepaid Mobile</option>
			  <option value="Postpaid-Mobile">Postpaid Mobile</option>
			  <option value="Landline">Landline</option>
			  <option value="Insurence">Insurence</option>
			  <option value="GAS">GAS</option>
			  <option value="EMI-Payment">EMI Payment</option>
			  <option value="Electricity">Electricity</option>
			  <option value="DTH">DTH</option>
			  <option value="Datacard">Datacard</option>
			  <option value="Credit-Card">Credit Card</option>
			  <option value="Broadband-Bill">Broadband Bill</option>
        <option value="Other">Other</option>
			  </select>
          </div> 
		
		<div class="form-group col-sm-4">
            <label>Operators Commission</label>
              <input type="text" class="form-control"  name="opr_comm" value="<?php if($this->input->post('opr_comm')!='') { echo $this->input->post('opr_comm'); }  ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Operators Cashback</label>
              <input type="text" class="form-control"  name="opr_cash" value="<?php if($this->input->post('opr_cash')!='') { echo $this->input->post('opr_cash'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Merchant Comission</label>
              <input type="text" class="form-control"  name="m_comm" value="<?php if($this->input->post('m_comm')!='') { echo $this->input->post('m_comm'); }  ?>" >
          </div>
		   <div class="form-group col-sm-4">
            <label>Web Link</label>
              <input type="text" class="form-control"  name="web_link" value="<?php if($this->input->post('web_link')!='') { echo $this->input->post('web_link'); }  ?>" >
          </div>
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
            <label>Operators Image</label>
              <input type="file" class="form-control"  name="image" value="<?php if($this->input->post('file')!='') { echo $this->input->post('file'); }  ?>" >
          </div> 
		  
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
            <label>Status</label>
              <select name="oper_status" class="form-control">
			  <option value="active">Active</option>
			  <option value="deactive">Deactive</option>
			  </select>
          </div> 
		  
		  
		  <div class="form-group col-lg-4 col-mg-6 col-sm-6">
            <label>Api Type</label>
              <select name="oper_type" class="form-control">
			  <option value="1">online</option>
			  <option value="0">offline</option>
			  </select>
          </div> 

		  
				  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/webstores'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>