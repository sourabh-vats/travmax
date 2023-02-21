	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;} 
	 </style>
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart('admin/docverification/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $docverificationupdate[0];
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Update docverification <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/docverification'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Doc. verification updated successfully.';
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
	   
      ?>
      
      <?php 
      //form validation
      echo validation_errors(); 
      ?>
        <fieldset> 
		
		<div id="collapse0" class="panel-collapse collapse in">
		 <input type="hidden" class="form-control" required name="rid" value="<?php echo $prod['id'];  ?>" >
	  
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Name <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $prod['f_name']; }  ?>" >
          </div>
          </div>
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Aadhar image <small style="color:red"></small></label>
             <div class="col-sm-9">   
			 <?php if($prod['aadharimage'] !='') { echo '<a href="http://www.blisszon.com/images/user/'.$prod['aadharimage'].'" target="_blank"><img src="http://www.blisszon.com/images/user/'.$prod['aadharimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
          </div>
		  
		 <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">PAN image <small style="color:red"></small></label>
             <div class="col-sm-9">   
			 <?php if($prod['panimage'] !='') { echo '<a href="http://www.blisszon.com/images/user/'.$prod['panimage'].'" target="_blank"><img src="http://www.blisszon.com/images/user/'.$prod['panimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Approved Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  
			 <select name="status" class="form-control custom-select">
			  <option value="yes">Approved</option>
			  <option value="no">Disapproved</option>
			  </select>
          </div> 
          </div> 
		  
		  
		</div>  

	</div>
				 
        </fieldset>
      <?php echo form_close(); ?>
	  

	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>
  
 