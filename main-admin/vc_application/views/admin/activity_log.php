<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">

        <h2>Activity Log</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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
      
      echo form_open('admin/activity_log/', $attributes);
      ?>	
	  	<div class="tablee" style="width:100%; overflow-x:auto;">
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead>  <tr><th>ID</th> <th>User Name</th><th>Customer ID</th><th>Site Name</th><th>Link</th><th>Phone</th><th>Visitor No</th><th>Date Time</th> </tr> </thead> 
<tbody> 
                <?php 
$i = 1;
foreach($activity_log as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/activity_log/'.$con['zkey'].'">'.$con['username'].'</a></td><td><a href="'.base_url().'admin/activity_log/'.$con['zkey'].'">'.$con['zkey'].'</a></td><td>'.$con['Sitename'].'</td><td>'.$con['link'].'</td><td>'.$con['phno'].'</td><td>'.$con['visitor_no'].'</td><td>'.$con['Date_Time'].'</td>';
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	

		<?php echo '</tr>';
$i++;
}
?>


</tbody> 
</table>
</div>
</div>
</form>
 <?php echo form_close(); ?>