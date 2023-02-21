<style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/uploadreceipts'; ?>">Back</a>
        <h2>Update Receipt Order </h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Update receipt successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  

      //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo validation_errors();     

	   echo form_open_multipart('admin/uploadreceipts/edit/'.$this->uri->segment(4).'', $attributes);
	   $user='';
	?>
        <fieldset> 
		 <input type="hidden" class="form-control" required name="cid" value="<?php echo $getsingle_receipt[0]['id'];  ?>" >
		<div class="form-group col-sm-12">
            <label>websites</label>
              <input type="text" class="form-control"  name="websites" value="<?php if($this->input->post('websites')!='') { echo $this->input->post('websites'); }else { echo $getsingle_receipt[0]['website'];} ?>" >
          </div>	

		  <div class="form-group col-sm-12">
            <label>Product</label>
              <input type="text" class="form-control"  name="p_name" value="<?php if($this->input->post('p_name')!='') { echo $this->input->post('p_name'); }else {echo $getsingle_receipt[0]['product'];} ?>" >
          </div>
		  
		  	<!---div class="form-group col-sm-12">
           
              <input type="text" class="form-control"  name="status" value="<?php //if($this->input->post('status')!='') { echo $this->input->post('status'); }else {echo $getsingle_receipt[0]['status'];} ?>" >
          </div-->
			<div class="form-group col-sm-6"> 
			 <label>Status</label>
			<select name="status" required class="form-control custom-select">
        <option value="" selected="" disabled="">Select Status</option>
        <?php if($getsingle_receipt[0]['status']=='') { ?>
          <option value="Pending">Pending</option>
          <option value="Reject">Reject</option>
       <?php }  elseif($getsingle_receipt[0]['status']=='Pending') { ?>

        <option value="Approved">Approved</option>


    <?php  } elseif($getsingle_receipt[0]['status']=='Approved') { ?>

			  <option value="Redeem">Redeem</option>
			  
        <?php } ?>
        
			  </select>
          </div>		  
		  
		  
		  <div class="form-group col-sm-6">
            <label>Commission</label>
              <input type="text" class="form-control"  name="commission" value="<?php if($this->input->post('commission')!='') { echo $this->input->post('commission'); }else {echo $getsingle_receipt[0]['commission'];} ?>" >
          </div>
		
           <!-- <div class="form-group col-sm-6">
            <label>Cashback</label>
              <input type="text" class="form-control"  name="cashback" value="<?php if($this->input->post('cashback')!='') { echo $this->input->post('cashback'); }else {echo $getsingle_receipt[0]['cashback'];} ?>" >
          </div> -->
		   <div class="form-group col-sm-6">
            <label>Amount</label>
              <input type="number" required="required" class="form-control"  name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); } else {echo $getsingle_receipt[0]['amount'];} ?>" >
          </div>		
         
		<div class="form-group col-sm-6">
         <label>Image</label>
			  
			<div class="form-group col-sm-2">
				<?php if($getsingle_receipt[0]['image'] !='') { echo '<img class="lsb-preview wthree_p_grid" data-lsb-group="header" src='.base_url().'../images/receipt/'.$getsingle_receipt[0]['image'].' width="50" height="50">'; } ?>
			</div>
          </div> 
			  
		  <div class="form-group col-sm-12">
            <label>Discription</label>
              <textarea class="form-control" required="required" name="p_discription" value="<?php if($this->input->post('p_discription')!='') { echo $this->input->post('p_discription'); }?>" > <?php echo $getsingle_receipt[0]['description'];?></textarea>
          </div>
		 <div class="col-lg-12 col-md-12">
			  <div class="form-group">
          <?php // if($getsingle_receipt[0]['status']!='Approved') {
            echo '<button class="btn btn-primary" type="submit">Save</button> &nbsp;';
        //  } ?>
				 
				 <a class="btn btn-primary" href="<?php echo base_url().'admin/uploadreceipts'; ?>">Cancel  </a>
			  </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  