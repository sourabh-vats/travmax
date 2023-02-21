
<div class="page-heading">
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/wallet/add'; ?>">Add New</a>
        <h2>Wallet History</h2>
      </div>
 
   <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
<thead> <tr><th>Sr. no.</th><th colspan="2">Name</th><th>Zkey</th><th>Amount</th><th>Type</th><th>Status</th><th>Date</th></tr> </thead> 
<tbody>
<?php 

if(!empty($summary)) {
	$i=1;
	foreach($summary as $data) { 
	$date = date('d M Y',strtotime($data['rdate']));
echo '<tr>
<td>'.$i.'</td><td colspan="2">'.$data['f_name'].'</td><td>'.$data['customer_id'].'</td><td>'.$data['amount'].'</td><td>'.$data['type'].'</td><td>'.$data['status'].'</td><td>'.$date.'</td></tr>';	
	$i++;
	}
}
	
	?>

</tbody>

	</table>


</div>

