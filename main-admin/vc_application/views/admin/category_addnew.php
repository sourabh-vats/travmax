	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/category'; ?>">Back</a>
        <h2>Add new category</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> category added successfully.';
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
      
      echo form_open_multipart('admin/category/add', $attributes);
      ?>
        <fieldset> 
		
		<div class="form-group col-sm-12">
            <label>Category title</label>
              <input type="text" class="form-control"  name="c_name" value="<?php if($this->input->post('c_name')!='') { echo $this->input->post('c_name'); }  ?>" >
          </div>
	
		  <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label>Image</label>
              <input type="file" class="form-control"  name="image" value="<?php if($this->input->post('file')!='') { echo $this->input->post('file'); }  ?>" >
          </div> 
		  
<div class="form-group col-sm-12">
            <label>Discription</label>
              <textarea class="form-control" required="required" name="c_discription" value="<?php if($this->input->post('c_discription')!='') { echo $this->input->post('c_discription'); } ?>" ></textarea>
          </div>
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/category'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>