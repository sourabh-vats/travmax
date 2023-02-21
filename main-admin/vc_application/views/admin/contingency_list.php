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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/franchise/add'; ?>">Add New</a>
        <h2>Franchise Area</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> franchise updated with success.';
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
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr><th>S.No</th> <th>Title</th><th>Code</th><th>Status</th><th>Percentage</th><th>Type</th> <th>Action</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($category as $con){ 

if($con['p_id']=='0'){$type='(State)';}else{$type='';}
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/franchise/edit/'.$con['id'].'">'.$con['c_name'].' '.$type.'</a></td><td>'.$con['code_no'].'</td><td>'.$con['status'].'</td><td>'.$con['percentage'].'</td><td>'.$con['type'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/franchise/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
