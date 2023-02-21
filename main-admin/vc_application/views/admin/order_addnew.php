	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/order'; ?>">Back</a>
        <h2>Add new order</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Order added successfully.';
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
      
      echo form_open_multipart('admin/order/add', $attributes);
      ?>
        <fieldset> 
		
	<div class="row">
	<div class="form-group col-sm-4 ">
	 <label>User ID</label>
	<input type="text" class="form-control" required value="" name="userid">
	</div>
	</div>
	
	<div class="form-group col-sm-4">
            <label>Product Name</label>
              <input type="text" class="form-control"  name="iname[]" required>
          </div>
	
	<div class="form-group col-sm-3">
            <label>Price</label>
              <input type="number" class="form-control"  name="price[]"  required>
          </div>
		  
		  <div class="form-group col-sm-3">
            <label>Quantity</label>
              <input type="number" class="form-control" name="qty[]" required>
          </div>
	
		  
		   <div class="col-sm-12 text-center"><button class="btn btn-primary btn-sm addnewitem">Add New Item</button><br><br></div>
 <div class="add-new-item-div">

 </div>
		  
		  
		  
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/category'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
<script>
jQuery(document).ready(function() {
	jQuery(document).on('click','.removeItem',function() {
		var cls = jQuery(this).attr('data-cls');
		jQuery(cls).html('');
		jQuery(cls).remove();
	});
	var i = 9999999;
	jQuery('.addnewitem').click(function(){
		var item = ' <div class="row row-item-'+i+'"><div class="form-group col-sm-4 dt0"><input class="form-control" type="text" class="form-control" required value="" name="iname[]"></div><div class="form-group col-sm-3 dt0"> <div class="dat0"><input min="1" type="number" required class="form-control" value="10" name="price[]"></div></div><div class="form-group col-sm-3 dt0"><div class="dat0"><input type="number" required min="1" value="1" name="qty[]" class="form-control"></div></div><div class="form-group col-sm-2 dt0"><div class="dat0"><a style="color:#ff0000;font-weight:bold;float:right;font-size: 20px;" class="removeItem" data-cls=".row-item-'+i+'" href="javascript:;">X</a></div> </div><div class="clearfix"></div><br></div>';
		jQuery('.add-new-item-div').append(item);
		i++;
	});
});
</script>