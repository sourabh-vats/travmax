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
        <h2>MY Offers</h2>
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
	<thead> <tr><th>S No</th><th>Name </th><th>Decsription </th> <th>Percent Payout</th><th>Status </th><th>Payout Type</th><th>Expire Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;



foreach($offer['response']['data'] as $result){ 


	
	echo '<tr><td>'.$i.'</td><td>'.$result['Offer']['name'].'</td><td>'.substr($result['Offer']['description'], 0,150).'</td><td>'.$result['Offer']['percent_payout'].'</td><td>'.$result['Offer']['approval_status'].'</td><td>'.$result['Offer']['payout_type'].'</td><td>'.$result['Offer']['expiration_date'].'</td></tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
