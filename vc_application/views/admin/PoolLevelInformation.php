<div class="page-heading"> 


        <h2>Level Information</h2>


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


      ?><div class="row"><div class="col-md-12 col-sm-12">


	  <div class="row">


	  <div class="col-md-5">


	  <div class="form-group"><label class="control-label col-md-5">RD Code :</label>


	  <div class="col-md-6"><span id="ContentPlaceHolder1_DistributorId" class="form-control" style="font-weight: bold;font-size: 12px; border: none;"><?php echo $profile[0]['customer_id'];?></span>


	  </div>


	  </div>


	  </div>


	  </div>


	  


	  <div class="row">


	  <div class="col-md-5"><div class="form-group"><label class="control-label col-md-5">RD Name :</label><div class="col-md-6"><span id="ContentPlaceHolder1_txtName" class="form-control" style="font-weight: bold;                                    font-size: 12px; border: none;"><?php echo $profile[0]['f_name'].' '.$profile[0]['l_name'];?></span></div></div></div>


	  


	  </div>


	  


	  <h2 class="page-title">Levels</h2>


	  <div class="col-md-12 col-sm-12">


	  <div class="row">
	<div style="overflow-x:auto;">

	  <form method="post" action="<?php echo base_url(); ?>admin/pool_information">


	  <div class="table-responsive">


	  <table id="ContentPlaceHolder1_rb" class="ver12bldgray" style="width:100%;">


	  <tbody>


	  <tr><td><span class="btn green" style="margin-bottom: 2px;"><label><input onclick="this.form.submit();" type="radio" name="level" value="1" <?php if($this->input->post('level')=='' || $this->input->post('level')=='1') { echo 'checked="checked"'; } ?>> Level 1</label></span></td>

       <td><span class="btn green" style="margin-bottom: 2px;"><label><input type="radio" name="level" value="2" onclick="this.form.submit();" <?php if($this->input->post('level')=='2') { echo 'checked="checked"'; } ?>> Level 2</label></span></td>
     
   	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='3') { echo 'checked="checked"'; } ?> type="radio" name="level" value="3" onclick="this.form.submit();"> Level 3</label></span></td>

       <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='4') { echo 'checked="checked"'; } ?> type="radio" name="level" value="4" onclick="this.form.submit();"> Level 4</label></span></td>
	  
	   <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='5') { echo 'checked="checked"'; } ?> type="radio" name="level" value="5" onclick="this.form.submit();"> Level 5</label></span></td>
	   
	    <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='6') { echo 'checked="checked"'; } ?> type="radio" name="level" value="6" onclick="this.form.submit();"> Level 6</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='7') { echo 'checked="checked"'; } ?> type="radio" name="level" value="7" onclick="this.form.submit();"> Level 7</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='8') { echo 'checked="checked"'; } ?> type="radio" name="level" value="8" onclick="this.form.submit();"> Level 8</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='9') { echo 'checked="checked"'; } ?> type="radio" name="level" value="9" onclick="this.form.submit();"> Level 9</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='10') { echo 'checked="checked"'; } ?> type="radio" name="level" value="10" onclick="this.form.submit();"> Level 10</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='11') { echo 'checked="checked"'; } ?> type="radio" name="level" value="11" onclick="this.form.submit();"> Level 11</label></span></td>
		
		<td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='12') { echo 'checked="checked"'; } ?> type="radio" name="level" value="12" onclick="this.form.submit();"> Level 12</label></span></td>


	  



	  </tr>


	  </tbody>


	  </table>


	  </div>


	  </form>


	  </div>


	  


	  </div>


	  


	  <div id="ContentPlaceHolder1_List">


	  <div class="controls-row">


	  <h1 class="page-title"><span id="ContentPlaceHolder1_LevelNo">Details Of: <?php echo $current_user;?></span> 


	  <?php if($show_inner=='true') { echo '<a class="btn btn-primary flr" href="'.base_url().'admin/DistributorLevelInformation">Back</a>'; } ?></h1>


	  </div>


	  </div>


	  <div class="col-md-12 col-sm-12 martintb">


	  <div class="table-responsive">


	  <div>


	  <table cellspacing="0" rules="all" class="table table-bordered table-striped" border="1" id="ContentPlaceHolder1_GridView1" style="border-collapse:collapse;width: 100%">


	 <tbody>


<tr>


<th scope="col">S.No</th><th scope="col">RD ID</th><th scope="col">RD Name</th><th scope="col">DOJ</th><th scope="col">Status</th>


</tr>


<?php $no_user_found = 'true';


if(!empty($myfriends)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';


	$i = 1;


	foreach($myfriends as $friends) {


		if(!empty($friends['friends']) && (array_key_exists("friends",$friends))) {


			foreach($friends['friends'] as $friend) {


				 $no_user_found = 'false';


				echo '<tr align="center"><td>'.$i.'</td><td>'.$friend['customer_id'].'</td><td>'.$friend['f_name'].' '.$friend['l_name'].'</td><td>'.date('d F Y',strtotime($friend['rdate'])).'</td>';


					echo '<td>'.$friend['status'].'</td></tr>';


				$i++;


			}


		}


	}


} 


if($no_user_found == 'true') { echo '<tr><td colspan="9">No user found</td></tr>'; } 


?>


</tbody>  


	  </table></div></div></div><span id="ContentPlaceHolder1_Label2" style="color:Red;font-weight:bold;display: none;"></span></div></div>


 <?php //echo form_close(); ?>