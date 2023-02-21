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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/card/add'; ?>">Add New</a>
        <h2>Card</h2>
      </div>
 
      <?php
      //flash messages
	// echo "<pre>"; print_r($tax); echo "</pre>";
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> card updated successfully.';
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
      
      echo form_open('admin/card/', $attributes);
      ?>
	   <div class="table-responsive">
<table class="table table-bordered table-hover tax-table"> 
<thead> <tr> <th>Sr no.</th><th>Card No.</th><th>Status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($tax as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con['cr_no'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/card/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>