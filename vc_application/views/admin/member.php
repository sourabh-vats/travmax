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
}
.main-body {
    
    padding: 0 !important;
}
</style>
<div class="smry smry4  text-center" >
<h2>Member's Details</h2>     
      </div>
 
	  <div class="col-md-12 col-sm-12 martintb">
	  <div class="table-responsive">
	  <div>
	  <table cellspacing="0" rules="all" class="table table-bordered table-striped" border="1" id="ContentPlaceHolder1_GridView1" style="border-collapse:collapse;width: 100%">
	 <tbody>
<tr>
<th scope="col">S.No</th><th scope="col">Member ID</th><th scope="col">Member Name</th><th scope="col">DOJ</th><th scope="col">Sponser ID</th><th scope="col">Action</th>

</tr>
<?php $no_user_found = 'true';
if(!empty($show_direct)) {
	$i = 1;
	foreach($show_direct as $friends) {
		
		echo '<tr><td>'.$i.'</td><td>'.$friends['customer_id'].'</td><td>'.$friends['f_name'].' '.$friends['l_name'].'</td><td>'.date('d F Y',strtotime($friends['rdate'])).'</td><td>'.$friends['parent_customer_id'].'</td><td><a href="'.base_url().'admin/member/'.$friends['id'].'">View</a></td></tr>';
		$i++; 
	}
	
		
	}
	else{
		if($no_user_found == 'true') { echo '<tr><td colspan="9">No user found</td></tr>'; } 
	
} 


?>
</tbody>  
	  </table></div></div></div><span id="ContentPlaceHolder1_Label2" style="color:Red;font-weight:bold;display: none;"></span></div></div>
 <?php //echo form_close(); ?>