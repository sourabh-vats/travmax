

 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2><?php echo$page_title; ?></h2>
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
      //echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> 
<th class="text-center">Sr. No.</th>
<th class="text-center">Type</th>
<!-- <th class="text-center">Send To / Send By</th> -->
<th class="text-center">Used By</th>
<th class="text-center">Detail</th>
<th class="text-center">Date</th>
<th class="text-center">Amout</th>
</tr> </thead> 
<tbody> 
<?php 
/*if($this->session->userdata('cust_id')==1) {
    echo '<pre>'; print_r($working_wallet); echo '</pre>';
    die();
}
 */
$Credit = $Debit = $online =  0;
$i = 1;   
if(!empty($working_wallet)) {
foreach($working_wallet as $con){  
$tamount = '';
if($con['status'] == 'Credit' || $con['status'] == 'Approved' || $con['status'] > 0) { $class = 'style="color:green;"'; $amount = $con['qty']*$con['tamount']; $send = $con['dcustomer_id']; $status ='Credit'; $Credit = $Credit+$amount;

if($con['status'] == 'Approved') { $online = $online + $amount; }
elseif($con['status'] == 'Credit') { $tamount = '('.$con['amount'].')';  } 

  
}
else { $class = 'style="color:red;"';  $send = $con['customer_id'];  $amount = ' - '.$con['amount']; $status ='Debit'; $Debit = $Debit+$con['amount'];  }
	
  if($send=='' || $send == 0) { $send = '--'; }
  //if($con['acustomer_id'] == '' || $con['acustomer_id'] == 0)  { $con['acustomer_id'] = '--'; }  
  if($con['acustomer_id'] == '')  { $con['acustomer_id'] = '--'; }  
	echo '<tr><td>'.$i.'</td><td>'.ucfirst($con['type']).'</td><td>'.$con['acustomer_id'].'</td><td>'.$status.'</td><td>'.$con['rdate'].'</td><td '.$class.'>Rs '.$amount.' '.$tamount.'</td>';  
	$i++;
} }
?>
</tbody>
<tfoot>
  <tr>
    <th colspan="2">Credit : <?php echo $Credit; ?> (Online: <?php echo $online; ?> + Transfered : <?php echo $Credit-$online; ?> ( Rs <?php echo ($Credit-$online); ?> ) )</th>
    <th></th>
    <th></th>
    <th></th>
    <th>Debit : <?php echo $Debit; ?></th>
  </tr>
</tfoot> 
</table>
</div>
</div>
 
 

 <?php //echo form_close(); ?>