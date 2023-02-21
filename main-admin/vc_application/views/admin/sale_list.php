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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/sale/add'; ?>">Add New</a><a class="btn btn-primary flr" href="<?php echo base_url().'admin/allsale'; ?>">All sale</a>
        <h2>Manage sale</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> sale updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  
	  if($distributeall == 'done') {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Amount distribution successfully.';
          echo '</div>';       
        }
      ?>
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/sale/');
      ?>
	  
	  
	  <div class="col-sm-12">
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
	
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
</div> 
 <?php echo form_close(); ?>
<p>&nbsp;</p>


<?php
    
      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/sale/');
      ?>
	  
	  
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S.NO.</th> <th>Card No.</th><th>TxnId</th><th>Total Paid</th><th>Date</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
$bv=0;
$dist_id='';
foreach($sale as $con){

 if($i!='1') { $dist_id .= ','; }
 $dist_id .= $con['id'];
 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['customer'].'</a></td><td>'.$con['id'].'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['gtotal'].'</a></td><td>'.date('d F Y',strtotime($con['tdate'])).'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/sale/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 

<tfoot>
<tr>
<th colspan='4'>Total</th>
<th><?php echo $bv;?></th>
<th colspan='2'><input type="submit" name="destribute" class="btn btn-primary" value="Distribute amount"></th>
</tr>
</tfoot>
</table>
<input type="hidden" name="dis_id" value="<?php echo $dist_id ;?>">
<input type="hidden" name="dis_amt" value="<?php echo $bv ;?>">
 <?php echo form_close(); ?>