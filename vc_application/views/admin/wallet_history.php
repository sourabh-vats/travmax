<style>
.smry4 {
    background: url(../images/edit-ing.jpg) no-repeat scroll center;
  
}
.smry {
    font-size: 45px;
}
.smry {
	padding: 10px 0;
	line-height: normal; 
	color: #fff;  
	margin-bottom: 24px;
}
.col-sm-10 {
    
    padding: 0 !important; 
}
.smry h2 {
	margin-bottom: 20px !important;
}



</style>

<div class="smry smry4  text-center"><h2><b>Wallet History</b></h2>
</div>

 
   <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
<thead> <tr><th>Sr No</th><th>Type</th><th>Amount</th><th>Status</th><th>Date</th></tr> </thead> 
<tbody>
<?php 
$i=1;
if(!empty($wallet_history)) {
	foreach($wallet_history as $data) { 
	if($data['type']=='Activate Account') { $type = $data['type'].' ('.$data['customer_id'].') '; } else { $type = $data['type']; }
echo '<tr>
<td>'.$i.'</td><td>'.$type.'</td><td>Rs '.$data['amount'].'</td><td>'.$data['status'].'</td><td>'.$data['rdate'].'</td></tr>';	
	$i++;
	}
}
	
	?>

</tbody>

	</table>


</div>

