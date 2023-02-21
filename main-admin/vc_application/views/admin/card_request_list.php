<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> tax updated successfully.';
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
 

      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Card Request
        
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
          <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
			
		 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/tax/', $attributes);
      ?>	
		
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr> <th>Sr no.</th><th>user_id</th><th>Name</th><th>cr_no</th><th>phone</th><th>status</th><th>Action</th> </tr>
                </thead>
                <tbody>
                <?php 
$i = 1;
foreach($tax as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/card_request/edit/'.$con['id'].'">'.$con['customer_id'].'</a></td><td>'.$con['f_name'].' '.$con['l_name'].'</td><td><a href="'.base_url().'admin/card_request/edit/'.$con['id'].'">'.$con['cr_no'].'</a></td><td>'.$con['phone'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/card_request/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
          
                </tbody>
                <tfoot>
               <tr> <th>Sr no.</th><th>user_id</th><th>Name</th><th>cr_no</th><th>phone</th><th>status</th><th>Action</th> </tr>
                </tfoot>
              </table>
			   <?php echo form_close(); ?>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
 