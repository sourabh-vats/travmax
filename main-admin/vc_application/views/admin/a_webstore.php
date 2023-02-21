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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Affiliate Webstore</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> customer updated with success.';
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

	   <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th> <th>File Name</th><th>Size</th><th>Status</th><th>Image</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;



foreach($store['response']['data']['data'] as $result){ 


	
	echo '<tr><td>'.$i.'</td><td>'.$result['OfferFile']['filename'].'</td><td>'.$result['OfferFile']['size'].'</td><td>'.$result['OfferFile']['status'].'</td><td><img src="'.$result['OfferFile']['url'].'" width="80"></td></tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
