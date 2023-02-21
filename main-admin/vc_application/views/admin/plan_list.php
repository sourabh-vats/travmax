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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/plan/add'; ?>">Add New</a>
        <h2>Manage Operators</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> plan updated with success.';
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
      
      echo form_open('admin/plan/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>id</th> <th>plan</th><th>price</th><th>talktime</th><th>validity</th><th>description</th><th>mobile operator</th><th>operator circle</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($plan as $con){ 
	
	echo '<tr><td>'.$con['id'].'</td><td><a href="'.base_url().'admin/plan/edit/'.$con['id'].'">'.$con['plan'].'</a></td><td>'.$con['price'].'</td><td>'.$con['talktime'].'</td><td> '.$con['validity'].'</td><td>'.$con['description'].'</td><td>'.$con['mobile_operator'].'</td><td>'.$con['operator_circle'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/plan/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>