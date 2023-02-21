<style>
.smry4 {
    background: url(../images/edit-ing.jpg) no-repeat scroll center;

}
.smry {
    font-size: 45px;
}
.smry {
    padding: 10px 0;
    line-height: normal;
	color: #fff;
}
.main-body {
    
    padding: 0 !important;
}
</style>
<div class="smry smry4  text-center" >
<?php

if($profile[0]['franchisee']>0){
	
	echo "<h2>Franchise Customer's Details</h2>";
	}

else{
	echo "<h2>Customer's Details</h2>";
	}



 ?>

        
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
          echo '</div>';       
        }else{
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
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	  

	  
	  
	
	  
	  <!--div class="col-md-12 col-sm-12">
	  <div class="row">
	  <form method="post" action="<?php echo base_url(); ?>admin/DistributorLevelInformation">
	  <div class="table-responsive">
	  <table id="ContentPlaceHolder1_rb" class="ver12bldgray" style="width:100%;">
	  <tbody>
	  <tr><td><span class="btn green" style="margin-bottom: 2px;"><label><input onclick="this.form.submit();" type="radio" name="level" value="1" <?php //if($this->input->post('level')=='' || $this->input->post('level')=='1') { echo 'checked="checked"'; } ?>> Level 1</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input type="radio" name="level" value="2" onclick="this.form.submit();" <?php //if($this->input->post('level')=='2') { echo 'checked="checked"'; } ?>> Level 2</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='3') { echo 'checked="checked"'; } ?> type="radio" name="level" value="3" onclick="this.form.submit();"> Level 3</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='4') { echo 'checked="checked"'; } ?> type="radio" name="level" value="4" onclick="this.form.submit();"> Level 4</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='5') { echo 'checked="checked"'; } ?> type="radio" name="level" value="5" onclick="this.form.submit();"> Level 5</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php// if($this->input->post('level')=='6') { echo 'checked="checked"'; } ?> type="radio" name="level" value="6" onclick="this.form.submit();"> Level 6</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='7') { echo 'checked="checked"'; } ?> type="radio" name="level" value="7" onclick="this.form.submit();"> Level 7</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='8') { echo 'checked="checked"'; } ?> type="radio" name="level" value="8" onclick="this.form.submit();"> Level 8</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='9') { echo 'checked="checked"'; } ?> type="radio" name="level" value="9" onclick="this.form.submit();"> Level 9</label></span></td>
	  
	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php //if($this->input->post('level')=='10') { echo 'checked="checked"'; } ?> type="radio" name="level" value="10" onclick="this.form.submit();"> Level 10</label></span></td>
	 
	 
	  </tr>
	  </tbody>
	  </table>
	  </div>
	  </form>
	 
	  
	  </div>
	   </div--->
	  
	  
	  <div class="col-md-12 col-sm-12 martintb">
	  <div class="table-responsive">
	  <div>
	  <table cellspacing="0" rules="all" class="table table-bordered table-striped" border="1" id="ContentPlaceHolder1_GridView1" style="border-collapse:collapse;width: 100%">
	 <tbody>
<tr>
<th scope="col">S.No</th><th scope="col">WF ID</th><th scope="col">WF Name</th><th scope="col">DOJ</th><th scope="col">Sponser ID</th><th scope="col">Status</th>

</tr>
<?php $no_user_found = 'true';
if(!empty($show_direct)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';
	$i = 1;
	foreach($show_direct as $friends) {
		
		echo '<tr><td>'.$i.'</td><td>'.$friends['customer_id'].'</td><td>'.$friends['f_name'].' '.$friends['l_name'].'</td><td>'.date('d F Y',strtotime($friends['rdate'])).'</td><td>'.$friends['parent_customer_id'].'</td><td>'.$friends['status'].'</td></tr>';
		
	}
	
		
	}
	else{
		if($no_user_found == 'true') { echo '<tr><td colspan="9">No user found</td></tr>'; } 
	
} 


?>
</tbody>  
	  </table></div></div></div><span id="ContentPlaceHolder1_Label2" style="color:Red;font-weight:bold;display: none;"></span></div></div>
 <?php //echo form_close(); ?>