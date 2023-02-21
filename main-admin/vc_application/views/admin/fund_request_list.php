<?php // error_reporting(0); ?>

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

.table > tbody > tr.act {

    background: #5cb85c;

}



.table > tbody > tr.rej {

    background: red;

}



 </style>

 

<div class="page-heading">

<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 

        <h2>Wallet Request List </h2>

		  

		

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

 <?php

      //form data

      $attributes = array('class' => 'form form-inline', 'id' => '');



      //form validation

      echo validation_errors();

	  //print_r($editor);

      

      //echo form_open('admin/customer/', $attributes);

      ?>

	  <div class="col-sm-12">

	   <form class="form form-inline" method="post" action="">

     

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

		  </form>

			  <div class="form-group col-sm-3">

		  

		  </div>



  

  </div>

  &nbsp;

	  

	  

	  <div class="table-responsive">

<table id="example" class="table table-bordered table-hover customer-table"> 

	<thead> <tr><th>ID</th> <th>Customer ID</th><th>Amount</th><th> description</th><!-- <th>Payment On</th> --><th>Payment Mode</th><th>UTR No</th><th>Date</th><!--th>Earnings</th--><th>status</th><!--th>Delete</th--> </tr> </thead> 

<tbody> 

<?php 

$i = 1;

foreach($customer as $con){ 

	if($con['status'] == 'accepted') { $st='act'; } elseif($con['status'] == 'rejected') {  $st='rej'; } else { $st=''; }

	echo '<tr class='.$st.'><td>'.$i.'</td><td><a href="'.base_url().'admin/fund_request/edit/'.$con['id'].'">'.$con['customer_id'].'</a></td><td>'.$con['amount'].'</td><td>'.$con['description'].'</td><!-- <td>'.$con['payment_no'].'</td>--><td>'.$con['mode'].'</td><td>'.$con['neft'].'</td><td>'.$con['date'].'</td><td>'.$con['status'].'</td>';

/* if($con['user_level']=='5') { echo 'Supper Admin'; }

elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }

elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }

else { echo ''; } */

?>

	

<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/customer/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->

		<?php echo '</tr>';

$i++;

}

?>

</tbody> 

</table></div>

</form>

 <?php echo form_close(); ?>