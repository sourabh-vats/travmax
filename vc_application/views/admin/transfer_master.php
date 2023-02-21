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
.col-sm-10 {
    
    padding: 0 !important; 
}  
</style>    
<div class="mainbar no-print hidden-xs" >  
<nav class="">
<div class="container">
   
	</div> <!-- /.container --> 
	</nav>
	</div> 
 
 <div class="container">
  <div class="content">
    <div class="content-container">
 <div class="smry smry4  text-center"><h2><b>Transfer to Wallet</b></h2>
</div>
<div class="col-sm-12 right-bar">
<br>
<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Successfully Transfered.';
          echo '</div>';       
        } elseif($this->session->flashdata('flash_message') == 'password')
        {
          echo '<div class="alert alert-danger">';   
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Incorrect Password.';
          echo '</div>';       
        } elseif($this->session->flashdata('flash_message') == 'less')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your Wallet have less Amount.';
          echo '</div>';       
        }  elseif($this->session->flashdata('flash_message') == 'no')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Incorrect Member ID.';
          echo '</div>';       
        } /*elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		}*/
      }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open('', $attributes);
      ?>
	  

	

		 <div class="form-group col-sm-12">
            <label>Amount To Be Transfer to Wallet</label>
             <input type="number" name="amount" placeholder="Amount To Be Transfer" required class="form-control">
          </div>

        
		  <div id="sponsr_name"></div>
       <!--  <input type="hidden" name="type" value="bliss_amount"> -->


	
        <div class="form-group col-sm-12 hide">
            <label>Transaction Code</label>
             <input type="password" name="transaction" placeholder="Transaction Code" class="form-control">
          </div>
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" name="submit" value="submit" type="submit">Submit</button> &nbsp;  
          </div>
		  
		  <?php echo form_close(); ?>
		  
</div>


</div>
</div>
</div>