<div class="page-heading"> 
        <h2><?php echo $title; ?></h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> activity_log updated with success.';
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
      $attributes = array('class' => 'form form-inline', 'id_no' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>Id</th><th>Zkey</th><th>Amount</th><th>Status</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
if(!empty($show_income)) {
foreach($show_income as $con){ 
	
	echo '<tr><td>'.$i.'</td>
  <td>'.$con['customer_id'].'</td>
  <td>'.$con['amount'].'</td>
  <td>'.$con['status'].'</td>
	<td>'.$con['rdate'].'</td>'; 
	
?>
		<?php echo '</tr>';
$i++;
}
?>
<?php } else { echo '<tr><td colspan="5"><center>No Record Found</center></td></tr>'; } ?>
</tbody> 
<tfoot>
  <tr><td colspan="2"><b><center>Total</center></b></td><td>Rs <?php echo array_sum(array_column($show_income, 'amount')); ?></td><td colspan="3"></td></tr>
</tfoot>

</table></div>
 <?php //echo form_close(); ?>