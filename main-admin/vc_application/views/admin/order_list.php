<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>

<style>
 .table-striped > tbody > tr.Delivered {background:#5cb85c}
 .table-striped > tbody > tr.Accepted {background:#ec971f}
 .table-striped > tbody > tr.Pending {background:#31b0d5}
 .table-striped > tbody > tr.Cancel {background:#c9302c}
</style>

<div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/order/add'; ?>">Add New</a>
        <h2>Order</h2>
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
      
      echo form_open('admin/category/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table table-striped"> 
<thead> <tr> <th>Sr.no.</th><th>OrderID.</th><th>Name</th><th>Phone</th><th>Amount</th><th>Payment type</th><th>Status</th><th>Date</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($order as $con){ 
	
	echo '<tr class='.$con['status'].'><td>'.$i.'</td>
	<td>'.$con['id'].'</td>
	<td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_name'].'</a></td>
	<td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_phone'].'</a></td>
	<td>'.$con['total_amount'].'</td>
	<td>'.$con['how_to_pay'].'</td><td>';
	if($con['emi']=='no' || $con['emi']=='yes') { echo $con['status']; }
	else { echo 'EMI Payment'; }
	echo '</td><td>'.$con['o_date'].'</td>';
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php //echo base_url().'admin/order/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
 <?php echo form_close(); ?>