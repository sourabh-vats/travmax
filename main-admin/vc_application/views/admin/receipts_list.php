<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lsb.css"> 
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
<h2>Receipts List </h2>
</div>
<div class="table-responsive"> 
<table class="table table-bordered table-hover product-table"> 
<thead> <tr><th>S No.</th><th>Customer ID</th><th>Product Name </th><th>website </th><th>Amount</th><th>Image</th><th>Description</th><th>Status</th><th>Delete</th></tr> </thead> 
<tbody> 
<?php 


foreach($all_receipt as $con){ 

$image = '';
 if(!empty($con['image'])){
	 $image =  base_url().'../images/receipt/'.$con['image'];
 }

$i = 1;
echo '<tr>
<td>'.$con['id'].'</td>

<td><a href="'.base_url().'admin/uploadreceipts/edit/'.$con['id'].'">'.$con['customer_id'].'</a></td>
<td>'.$con['website'].'</td>
<td>'.$con['product'].'</td>
<td>'.$con['amount'].'</td>
<td><a target="_blank" href="'.$image.'">View Receipts</a></td>
<td>'.$con['description'].'</td><td>'.$con['status'].'</td>'; 
?>
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/uploadreceipts/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>

		<?php echo '</tr>';
$i++;

}
?>
</tbody> 
</table>
</div>
