<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Wishzon</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container">

<div class="col-lg-12 register-form">
<div class="col-lg-12  text-center"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/images/rlogo.jpg"></a></div>
<div class="clearfix"></div>
      <?php 
if(isset($message_error) && $message_error){
          echo '<br><div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> email or password is wrong.';
          echo '</div>';             
      }
if($this->session->flashdata('register') && $this->session->flashdata('register')=='already'){
          echo '<br><div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email already exist. Please try with other email.';
          echo '</div>';             
      }

?>
<?php echo validation_errors(); ?>
<div class="clearfix"></div>

<?php
      $attributes = array('class' => 'col-sm-6 col-sm-offset-3');
      echo form_open(base_url().'admin/create_member', $attributes);
?>
      <h4 class="text-center">Register New Membership</h4>

<input type="text" required value="<?php if($this->input->post('dname')!='') { echo $this->input->post('dname'); } ?>" class="form-control" name="dname" placeholder="Display Name"> 
	  <br>
	  <input type="text" required value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } ?>" class="form-control" name="phone" placeholder="Phone"> 
	  <br>
	  <input type="email" required value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } ?>" class="form-control" name="email" placeholder="Email"> 
	  <br>
<input type="password" required  value="" class="form-control" name="password" placeholder="Password">
    <br>
	<input type="password" required  value="" class="form-control" name="cpassword" placeholder="Retype Password">
      <br />
	  <div class="col-sm-6 lik"><a href="<?php echo base_url(); ?>admin">Sign In</a>
	  </div>
	  <div class="col-sm-6 text-right">
<input type="submit" value="Register" class="btn btn-large btn-primary" name="submit"></div>
     
 
<p></p>
<?php 
      echo form_close();
      ?>      

    </div>
	</div><!--container-->

  </body>
</html>