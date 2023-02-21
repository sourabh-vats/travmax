 <style>
.imgbox {width: 100%;}
.center-fit {width: 100%; height: 100%;max-height: 100%; margin: 0;padding: 0;background-image: url('img/IMAG0360.jpg');background-size:100% 100%;background-repeat: no-repeat;}
 </style>

<!-- products-breadcrumb -->
	
<!-- //products-breadcrumb -->
<!-- banner -->

  <div class="w3l_banner_nav_right uu">
  <img src="<?php echo base_url(); ?>assets/front/images/rech-banner.png">
  </div>
    <div class="main-content res-margin">
                    <div class="container">
                        <div class="row">
	<div class="">
		<?php if($maintanance[0]['maintenance']=='Yes'){  ?>
		
		 <div class="imgbox">

   <img class="center-fit" src='http://www.33infotech.com/wp-content/uploads/2018/08/under_construction.jpg'>

  </div>
  
	<?php 	}else {?>
		
		
<!-- about -->
		<div class="privacy about">
			<h3>Recharge or Pay For</h3>
			<div class="row">
	 <section class="recharge1 main-form py-0" >
	   <div class="container">
<div class="row">
                <div class="flipcard effect__click">
                    <div class="card__front posrel">
                <div class="recharge-bills recharge-bills-home">
<div class="tabs" style=" outline: currentcolor none medium;" tabindex="7">
<form class="form" action="" method="post" id="recharge">  
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Prepaid-Mobile"><input id="abc" type="radio" checked name="optradio" value="Prepaid"><i class="fa fa-mobile"></i>Prepaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Postpaid-Mobile"><input id="abc" type="radio" checked name="optradio" value="Postpaid"><i class="fa fa-mobile"></i>Postpaid</label>
		</li>	
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline mo-dc" data-cls=".op-Datacard"><input type="radio" name="optradio" value="Datacard"><i class="fa fa-file"></i>Insurance</label>
		</li>
		
		<li role="presentation" class="operator-radio">
			<label class="radio-inline dth-op" data-cls=".op-DTH">
				<input type="radio" name="optradio" value="DTH" id="dth"><i class="fa fa-television"></i>DTH
			</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline elec" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-lightbulb-o"></i>Electricity</label>
		</li>
		
<?php if($this->session->userdata('merchant_id')){ ?>
		<li role="presentation" class="operator-radio">
			<label href="" aria-controls="electricity" role="tab" data-toggle="tab" aria-expanded="false">
				<i class="fa fa-lightbulb-o"></i>Money Transfer
			</label>
		</li>
		<?php } ?>
	</ul>
</div>
<script>
$(document).ready(function () {
    $('.nav li label').click(function(e) {
        $('.nav li.active').removeClass('active');
        var $parent = $(this).parent();
        $parent.addClass('active');
        e.preventDefault();
    });
});
</script>
	  
<?php 
$error_msgss = $this->session->flashdata('recharge_msg');
$recharge = $this->session->userdata('recharge');
//echo '('.$this->session->flashdata('recharge').' '.$recharge.')';
		if($this->session->flashdata('recharge') == 'Failure' || $recharge=='Failure') {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            if(!empty($error_msgss)) { echo 'Recharge failed please try again.'; }
            
          echo '</div>';
          $this->session->set_userdata('recharge','');      
        } 
        if($this->session->flashdata('recharge') == 'updated' || $recharge=='updated') {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your recharge request has been submitted successfully. You will be notified by SMS on your registered mobile number.';
          echo '</div>';  
          $this->session->set_userdata('recharge','');    
         $_POST = array();  
        }  
        if($this->session->flashdata('recharge') == 'pending' || $recharge=='pending') {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your recharge request has been submitted successfully. You will be notified by SMS on your registered mobile number.';
          echo '</div>'; 
          $this->session->set_userdata('recharge','');   
         $_POST = array();    
        } 
	  
      //form validation
      echo validation_errors();
	  ?>   
<div class="tab-content">
        <div role="tabpanel" class="tab-pane  active" id="mobile">
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
            <div class="col-xs-12 col-sm-7 col-md-12 col-lg-12">
                <div class="radio">
					<label>
					<span class="mobno">Mobile Number</span>
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span>
					</label>
                </div>
            </div>
			
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                        <div class="field-mobilerecharge-service_number required">
<div class="input-group"><!--span class="input-group-addon rupee1">+91</span-->

 <input  type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="phone" maxlength="10" autocomplete="off" <?php if($this->input->post('phone')!='') {
echo $this->input->post('phone'); }?>>
</div>
</div>  
            </div>
            </div>
<style type="text/css">
	.radio {
    display: block;
    display: block !important;
}
.space {
    min-height: 0px !important;
}
</style>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <div class="field-mobilerecharge-operator required">
<select id="mobilerecharge-operator" class="form-control  with-arrow custom-select-operator" name="operator" required>
	<option class="op-first-operator" value="">Select Operator</option> 
			  <?php if(!empty($operator)) {
				  foreach($operator as $value) {
					  echo '<option class="op-'.$value['Service_Type'].'" value="'.$value['Operator_Code'].'" ';
					  if($value['Service_Type']=='Prepaid-Mobile') { echo 'style="display:block"'; }
					  else {  echo 'style="display:none"'; }
					  echo '>'.$value['oper_name'].'</option>';
				  }
			  } ?>
			  <input type="hidden" name="circle" value="18">
			  <input type="hidden" name="operator_commision" id="operator_commision" value="0"> 
			  <input type="hidden" name="operator_cashback" id="operator_cashback" value="0"> 
			  <input type="hidden" name="merchant_cashback" id="merchant_cashback" value="0"> 
</select>
<div class="help-block"></div>
</div>           
     </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group operator-name">
            <div class="field-mobilerecharge-amount required">
<div class="input-group"><!--<span class="input-group-addon rupee">₹</span>-->

<input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="amount" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div>
</div>              
  </div>
            </div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
                 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password"  class="form-control integerOnly nozero input-empty pin-input" placeholder="Transaction PIN" maxlength="4" name="pin"></div>
</div>              
  </div>
            </div>  
		<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p><span>  <b class="br_plan"><a href="JavaScript:void(0);">Browse Plans</a> </b>of all operators</span></p>
			</div> -->

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">

<button class="btn btn-default btn-radius nav-link content-popup num-show-button" type="button" id="button-mobile-recharge" data-toggle="modal" <?php if($this->session->userdata('is_customer_logged_in')){ echo 'data-target="#rechargeModal"  class="btn btn-primary btn-block num-show-button"'; } else { echo 'data-target="#registerLoginModal"  class="btn btn-primary btn-block num-show-button "'; } ?> name="submit" >Pay Here</button>

				</div>		

				

    <div id="rechargeModal" class="modal fade" role="dialog">
  <div class="modal-dialog wd"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Please Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="red">Please fill all required fields.</p>
        <p class="greenn">Your <span class="mobno">Mobile Number</span>
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span> is <b><span class="phone-div"></span></b> and Amount is Rs. <b><span class="amount-div"></span></b> <br/>		<br/>	<b>Payment Type</b>	&nbsp; &nbsp; 
		<label class="radio-inline">
		<input type="radio" name="paytype" value="Wallet" checked><?php if($this->session->userdata('is_customer_logged_in')){ ?>
		Wallet
		<?php } ?>
		</label> 
		</p>

      </div>

      <div class="modal-footer foot-back"><input type="submit" name="confirm" value="Confirm" class="btn btn-success butn" >
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </div>                         
	</div>
	<div role="tabpanel" class="tab-pane fade hide in" id="electricity">           
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class="radio">
					<label><span class="mobno1">Customer Id</span></label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                        <div class="field-mobilerecharge-service_number required">
<div class="input-group"><input  type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="uid" maxlength="10"  autocomplete="off" <?php if($this->input->post('uid')!='') { 
echo $this->input->post('uid'); }?>></div>
</div>                
                </div>
            </div>          
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group operator-name">
                        <div class="field-mobilerecharge-amount required">
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="MobileRecharge[amount]" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div>
</div>              
  </div>
  </div>	

			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
                 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password"  class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>              
  </div>
            </div>

		
			

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">



<button type="button" id="button-mobile-recharge" data-toggle="modal" <?php if($this->session->userdata('is_customer_logged_in')){ echo 'data-target="#rechargeModal"  class="btn btn-primary btn-block "'; } else { echo 'data-target="#registerLoginModal"  class="btn btn-primary btn-block "'; } ?> name="submit" >Recharge Now</button>

				</div>		 

        </div>

                           

	</div>
</div>

  </form>      


<div class="" id="sh_plan" style=" display:none; ">

<div class="alert alert-success">

      <a href="#" class="close">&times;</a>

     

	<h3>Browse Plans</h3>

	<!-- required for floating -->

	<!-- Nav tabs -->

	<div  class="plan-cnt">

		<ul class="nav nav-tabs list rc_web">

			<li class="active operator-radio">

				<label href="#best-offer" data-toggle="tab">Best Offer</label>

			</li>

			<li class="operator-radio">

				<label href="#full-talktime" data-toggle="tab">Full Talktime</label>

			</li>

			<li class="operator-radio">

				<label href="#3gdata" data-toggle="tab">3G/4G Data</label>

			</li>

			<li class="operator-radio">

				<label href="#2gdata" data-toggle="tab">2G Data</label>

			</li>

			<li class="operator-radio">

				<label href="#topup" data-toggle="tab">Top Up</label>

			</li>

			<li class="operator-radio">

				<label href="#sprecharge" data-toggle="tab">Special Recharge</label>

			</li>

			<li class="operator-radio">

				<label href="#roaming" data-toggle="tab">Roaming</label>

			</li>

		</ul>





		<!-- Tab panes -->

		<div class="tab-content">

			<div class="tab-pane active" id="best-offer">

				<div class="table-responsive">

					<table class="table oo">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='Best Offer') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="full-talktime">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='Full Talktime') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="3gdata">

				<div class="table-responsive">

					<table class="table oo">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='3G/4G Data') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="2gdata">

				<div class="table-responsive">

					<table class="table ">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='2G Data') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="topup">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='Top Up') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="sprecharge">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='Special Recharge') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="roaming">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($operator_plan as $plan){						if($plan['plan']=='Roaming') {							echo '

							<tr class="opr-coman opr-'.$plan['mobile_operator'].'">

								<td>

									<button class="amtvalue">Rs. '.$plan['price'].'</button>

								</td>

								<td>'.$plan['talktime'].'</td>

								<td>'.$plan['validity'].'</td>

								<td>'.$plan['description'].'</td>

							</tr>';													}					} ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

	</div>

</div>

      </div>







  </div>

  
				</div>

                    </div>

			  </div>		

			   

              </div>

                </div>

            </section>

	
			</div>
		
	<div class="col-sm-12" id="sh_plan" style="min-height:300px; display:none; ">
    
        <h3>Browse Plans</h3>

        
            <!-- required for floating -->
            <!-- Nav tabs -->
			    <div  class="plan-cnt">
            <ul class="nav nav-tabs list rc_web">
                <li class="active"><a href="#best-offer" data-toggle="tab">Best Offer</a></li>
                <li><a href="#full-talktime" data-toggle="tab">Full Talktime</a></li>
                <li><a href="#3gdata" data-toggle="tab">3G/4G Data</a></li>
                <li><a href="#2gdata" data-toggle="tab">2G Data</a></li>
                <li><a href="#topup" data-toggle="tab">Top Up</a></li>
                <li><a href="#sprecharge" data-toggle="tab">Special Recharge</a></li>
                <li><a href="#roaming" data-toggle="tab">Roaming</a></li>
            </ul>
			
			
			
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="best-offer">  
<div class="table-responsive">
				 <table class="table oo">
			
					<thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='Best Offer') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
				  </table></div>
				</div> 
				
                <div class="tab-pane" id="full-talktime">
				<div class="table-responsive">
				 <table class="table">
    <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='Full Talktime') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table></div>

				</div>
                <div class="tab-pane" id="3gdata">
				<div class="table-responsive">
				 <table class="table oo">
   <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='3G/4G Data') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table>
</div>
				</div>
                <div class="tab-pane" id="2gdata">
				<div class="table-responsive">
				 <table class="table ">
   <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='2G Data') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table>
</div>
				</div>
                <div class="tab-pane" id="topup">
				<div class="table-responsive">
				 <table class="table">
     <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='Top Up') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table>
</div>
				</div>
                <div class="tab-pane" id="sprecharge">
				<div class="table-responsive">
				 <table class="table">
   <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='Special Recharge') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table>
</div>
				</div>
                <div class="tab-pane" id="roaming">
				<div class="table-responsive">
				 <table class="table">
  <thead><tr><th>Price</th><th>Talktime</th><th>Validity</th><th>Description</th></tr></thead>
					
					
					<tbody>
					<?php foreach($operator_plan as $plan){
						if($plan['plan']=='Roaming') {
							echo '<tr class="opr-coman opr-'.$plan['mobile_operator'].'"><td><button class="amtvalue">Rs. '.$plan['price'].'</button></td><td>'.$plan['talktime'].'</td><td>'.$plan['validity'].'</td><td>'.$plan['description'].'</td></tr>';
							
						}
					} ?> 
					</tbody>
  </table>
</div>
				</div>
            </div>
        </div>
        <div class="clearfix"></div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
	</div>
	
			
		</div>
<!-- //about -->

	
		<div class="clearfix"></div>
	</div>

<!--div class="operate">
	 <h3>Operator</h3>
	 <div class="table-responsive">
	 <table class="table first">
    <tbody>
	 <tr>
	  <?php if(!empty($operator)) {
				  foreach($operator as $value) {
					  echo '<td class="opr_box"><center><img class="opr_img" src="'.base_url().'main-admin/images/webstores/'.$value['oper_img'].'"></center></td>';
				  }
			  } ?>
	
</tr>
    </tbody>
  </table>
  </div>
	</div-->	

</div>
	
	<?php } ?>
	
<div class="clearfix"></div>

<!-- newsletter -->

	
	
	
	</div>
	</div>

<!-- //newsletter -->

<script>

jQuery(document).ready(function(){

	jQuery('.operator-radio label').click(function(){
		var cls = jQuery(this).attr('data-cls');
		jQuery('.custom-select-operator option').hide();
		jQuery(cls).show();
		jQuery('.op-first-operator').show();
		jQuery('.custom-select-operator').val(''); 
	});

	var operator = [];
	var operatorcashback = [];
	var merchantcashback = [];
	operator["ATV"] = "1.5";operatorcashback["ATV"] = "2";merchantcashback["ATV"] = "3";operator["BP"] = "0";operatorcashback["BP"] = "0";merchantcashback["BP"] = "0";operator["VP"] = "0";operatorcashback["VP"] = "0";merchantcashback["VP"] = "0";operator["IP"] = "0";operatorcashback["IP"] = "0";merchantcashback["IP"] = "0";operator["PAT"] = "0";operatorcashback["PAT"] = "0";merchantcashback["PAT"] = "0";operator["BR"] = "2";operatorcashback["BR"] = "2";merchantcashback["BR"] = "4";operator["BT"] = "2";operatorcashback["BT"] = "2";merchantcashback["BT"] = "4";operator["I"] = "1";operatorcashback["I"] = "2";merchantcashback["I"] = "2.5";operator["J"] = "3";operatorcashback["J"] = "3";merchantcashback["J"] = "6.5";operator["V"] = "1";operatorcashback["V"] = "2";merchantcashback["V"] = "2.5";operator["A"] = "1";operatorcashback["A"] = "1";merchantcashback["A"] = "2";operator["DTV "] = "1.5";operatorcashback["DTV "] = "2";merchantcashback["DTV "] = "0";operator["VTV"] = "1.45";operatorcashback["VTV"] = "1";merchantcashback["VTV"] = "2.9";operator["STV"] = "1.5";operatorcashback["STV"] = "2";merchantcashback["STV"] = "3";operator["TTV"] = "1.3";operatorcashback["TTV"] = "1";merchantcashback["TTV"] = "2.6";	jQuery('.custom-select-operator').change(function(){
		var valu = jQuery(this).val();
		var cls = '.opr-'+valu;
		jQuery('.opr-coman').hide();
		jQuery(cls).show();
		if(valu=='') {
			jQuery('#operator_commision').val('0');
			jQuery('#operator_cashback').val('0');
			jQuery('#merchant_cashback').val('0');
		} else {
			jQuery('#operator_commision').val(operator[valu]);
			jQuery('#operator_cashback').val(operatorcashback[valu]);
			jQuery('#merchant_cashback').val(merchantcashback[valu]);
		} 
	});
	jQuery('.num-show-button').click(function(){
		if(jQuery('input.phone-input').val()=='' || jQuery('input.amount-input').val()=='' ||  jQuery('.custom-select-operator').val()=='') {
			jQuery('#rechargeModal .red').show();
			jQuery('#rechargeModal .greenn').hide();
		} else {
			jQuery('#rechargeModal .red').hide();
			jQuery('#rechargeModal .greenn').show();
			jQuery('.phone-div').html(jQuery('input.phone-input').val());
			jQuery('.amount-div').html(jQuery('input.amount-input').val());
		}			
	});
	jQuery(".amtvalue").click(function(){
		var amt = jQuery(this).text();
		var intStr1 = amt.replace(/[^d.,]+/,'');
		//alert(intStr1.substr(2, 10));
        jQuery("#amount").val(intStr1.substr(2, 10));
		jQuery('#sh_plan').hide();
    });
	
		jQuery(".close").click(function(){
    jQuery("#sh_plan").hide();
});
	
	jQuery(".dth-op").click(function(){
	jQuery(".elec-sh").hide();
    jQuery(".mobno").hide();
	jQuery(".dth-sh").show();
});

jQuery(".mo-pm").click(function(){
    jQuery(".dth-sh").hide();
	jQuery(".elec-sh").hide();
	 jQuery(".mobno").show();
});
jQuery(".mo-dc").click(function(){
    jQuery(".dth-sh").hide();
	jQuery(".elec-sh").hide();
	jQuery(".mobno").show();
});

jQuery(".mo-po").click(function(){
    jQuery(".dth-sh").hide();
    jQuery(".elec-sh").hide();
	jQuery(".mobno").show();
});

jQuery(".elec").click(function(){
    jQuery(".dth-sh").hide();
	jQuery(".mobno").hide();
	jQuery(".elec-sh").show();
});

jQuery(".br_plan").click(function(){
    jQuery("#sh_plan").toggle();});
    
  

});


</script>
 

 