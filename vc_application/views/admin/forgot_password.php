<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Blisszon</title>
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
            echo '<strong>Error!</strong> email is wrong.';
          echo '</div>';             
      }
	  if($this->session->flashdata('register') && $this->session->flashdata('register')=='true'){
             $this->session->set_flashdata('register', 'false'); 
          echo '<br><div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully please login now.';
            //echo 'Check your email inbox/spam and click the link given in email to verify your account.';
          echo '</div>';             
      }
?>
<?php echo validation_errors(); ?>


<div class="clearfix"></div>

<?php
      $attributes = array('class' => 'col-sm-6 col-sm-offset-3');
      echo form_open(base_url().'admin/forgot-password', $attributes);
?>
      <h4 class="text-center">Forgot password</h4>

<input type="email" required value="<?php if($this->input->post('user_email')!='') { echo $this->input->post('user_email'); } ?>" class="form-control" name="user_email" placeholder="Email">
     
      <br />

 <div class="col-sm-6 lik">
<a href="<?php echo base_url(); ?>admin/signup">Register</a><br>
<a href="<?php echo base_url(); ?>admin">Sign In</a><br>
<!--a href="#">Resend Verification Link</a-->
</div>
 <div class="col-sm-6 text-right"><input type="submit" value="Send" class="btn btn-large btn-primary" name="submit"></div>
 
<?php 
      echo form_close();
      ?>      

    </div> 
	</div><!--container-->

  </body>
</html>