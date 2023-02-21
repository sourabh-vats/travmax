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
        <h2> All Customer's</h2>
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
      
     //echo form_open('admin/category/', $attributes);
      ?>	  

	  <?php 
	  $total_distributer = 0;
	  $distributer_info = '';
if(!empty($myfriends)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';
	$i = 1;
	foreach($myfriends as $friend) {
                if($friend['macro']>0) { $status = 'Macro'; } else { $status = 'Micro'; }
				$total_distributer = $total_distributer + 1;
				$distributer_info .= '<tr align="center"><td>'.$i.'</td><td>'.$friend['customer_id'].'</td><td>'.$friend['f_name'].' '.$friend['l_name'].'</td><td>'.date('d F Y',strtotime($friend['rdate'])).'</td><td>'.$friend['parent_customer_id'].'</td><td>'.$status.'</td></tr>';
				$i++;
			
		}
	}
 ?>
<div class="row">
        <div class="col-md-12 col-sm-12">
            
            <div id="ContentPlaceHolder1_mainDiv" class="col-md-12 col-sm-12 martintb">        
        <div class="table-responsive">
            <div>
<?php //print_r($myfriends); ?>
<div class="table-responsive">
	<table id="example" cellspacing="0" rules="all" class="table table-striped table-bordered table-hover" border="1" id="ContentPlaceHolder1_GridView1" style="width:100%;border-collapse:collapse;">
<tbody><tr>
<th scope="col">S.No</th><th scope="col">WF ID</th><th scope="col">WF Name</th><th scope="col">DOJ</th><th scope="col">Sponser ID</th><th scope="col">Status</th>
</tr>
<?php echo $distributer_info; ?>

</tbody></table></div>
</div>
            </div>
            </div>
            </div> </div>
 <?php //echo form_close(); ?>