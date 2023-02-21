<div class="page-heading">
<h2>Member Login</h2>
      </div>

<div class="col-sm-12">
	<p><br></p>
  <form method="post" action="<?php echo base_url(); ?>../index.php/vc_site_admin/user/super_admin_login" target="_blank" class="form form-inline">
	  <p>Enter ID No. 
		  <input type="text" class="form-control" required value="FGL5555" name="bcono" style="height:auto;"> 
		  <input type="submit" name="submit" class="btn btn-primary" value="Login">
	  	  <input type="hidden" name="auth" value="<?php echo md5('@#96pp~~'.md5('AdWinAdmin'));?>">
	  </p>
	</form>
</div>