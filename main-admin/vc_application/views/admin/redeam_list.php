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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/redeam/add'; ?>">Add New</a--> 
        <h2>Redeems List</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> redeam updated with success.';
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
      
      echo form_open('admin/redeam/', $attributes);
      ?>
	   <div class="table-responsive">
<table id="example" class="table table-bordered table-hover redeam-table"> 
	<thead> <tr><th>ID</th><th>Name</th><th>Email</th><th>Redeam</th><th>After TDS</th><th>Status</th><th>Doc. ver.</th><th>Req. for</th><th>Voucher email</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($redeam as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/redeam/edit/'.$con['rd_id'].'">'.$con['f_name'].'</a></td><td><a href="'.base_url().'admin/redeam/edit/'.$con['rd_id'].'">'.$con['email'].'</a></td><td>'.$con['redeem'].'</td><td>'.$con['after_tds'].'</td><td>'.$con['redeem_status'].'</td><td>'.$con['var_status'].'</td><td>'.$con['my_bliss_req'].'</td><td>'.$con['voucher_email'].'</td>';
echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>