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
        <h2>Affiliate Scheduled</h2>
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
			<div class="tablee" style="width:100%; overflow-x:auto;">
	   <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>S No</th><th>Name </th><th>Offer Id </th> <th>Currency </th><th>Create UTC</th><th>Status </th></tr> </thead> 
<tbody> 
<?php 
$i = 1;



foreach($affiliate['response']['data']['data'] as $result){ 


	
	echo '<tr><td>'.$i.'</td><td>'.$result['Offer']['name'].'</td><td>'.$result['ScheduledOfferChange']['offer_id'].'</td><td>'.$result['Offer']['currency'].'</td><td>'.$result['ScheduledOfferChange']['created_utc'].'</td><td>'.$result['ScheduledOfferChange']['status'].'</td></tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</div>
