<?php $this->load->view('includes/front/leftsidebar');?>
	<div class="container-fluid" style="padding:0px;box-shadow: 0 2px 15px rgba(202, 201, 201, 0.8);">
		<div class="shoes-grid">
			
			<div class="wrap-in">
			 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	
				<?php
if(!empty($slider)) { 
$i=0;
foreach($slider as $slide) {
	
	if($this->session->userdata('is_customer_logged_in')){ $url='<a href="javascript:void(0)">';}else{$url='';}
	
	if($i==1){$class='active';}else{$class='';}
	
	echo '<div class="item '.$class.'">
	  '.$url.'
        <img class="img-responsive" src="'.base_url().'main-admin/images/product/'.$slide['image'].'" alt=" " />
		</a>
      </div>';
	  
	  $i++;
	}
}  ?>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="fa fa-angle-left"></span>
      <span class="sr-only"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="fa fa-angle-right"></span>
      <span class="sr-only"></span>
    </a>
  </div>
			
				
	          </div>
	          </div>
	          </div>
			  
		<section class="zoogal_partner">
        <div class="container">
          <div class="partner_main">
            <div class="row">
                    <div class="col-sm-4">
                        <div class="part_back part_1">
							<div class="part_botm">
                                <img src="<?php echo base_url(); ?>assets/images/z1.jpg" class="img-responsive">
                            </div> 
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="part_back part_2">
                            <div class="part_botm">
                                <img src="<?php echo base_url(); ?>assets/images/z2.jpg" class="img-responsive">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="part_back part_3">
                            <div class="part_botm">
                                <img src="<?php echo base_url(); ?>assets/images/z3.jpg" class="img-responsive">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>	



<!---new recharge ------->

			<section class="recharge1 main-form py-0" style="position: relative;">
<div class="container">
<div class="row">
	<div class="col-sm-7">
	<div class="card__front posrel">
                <div class="recharge-bills recharge-bills-home">
<div class="tabs" style=" outline: currentcolor none medium;" tabindex="7">
<form class="form" action="" method="post" id="recharge">  
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Prepaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Prepaid"><i class="fa fa-mobile"></i>Prepaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Postpaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Postpaid"><i class="fa fa-mobile"></i>Postpaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			<label class="radio-inline dth-op" data-cls=".op-DTH"><input type="radio" name="optradio" value="DTH"><i class="fa fa-television"></i>DTH</label>
		</li>
		<li role="presentation" class="operator-radio" id="electricity">
			 <label class="radio-inline elec" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-lightbulb-o"></i>Electricity</label>
		</li>
		
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
        if($this->session->flashdata('recharge') == 'Pending' || $recharge=='Pending') {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your recharge request has been submitted successfully. You will be notified by SMS on your registered mobile number.';
          echo '</div>'; 
          $this->session->set_userdata('recharge','');   
         $_POST = array();    
        } 
	  
      //form validation
      echo validation_errors();
      echo $this->session->flashdata('recharge');
	  ?>
<div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="mobile">
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
         <!--   <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class="radio">
					<label>
					<span class="mobno">Mobile Number</span> 
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span>
					</label>
                </div>
            </div>  ----->
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                        <div class="field-mobilerecharge-service_number required">
<div class="input-group"><!--span class="input-group-addon rupee1">+91</span--><input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="phone" maxlength="10" autocomplete="off" placeholder="Mobile Number"></div>
</div>  
            </div>
            </div>
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
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="amount" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div>
</div>              
  </div>
            </div>


<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">

<!-- <button type="button" id="button-mobile-recharge" data-toggle="modal" data-target="#registerLoginModal" class="btn btn-primary btn-block num-show-button " name="submit">Pay Here</button> -->


<button class="btn btn-primary btn-block num-show-button " type="button" id="button-mobile-recharge" data-toggle="modal" <?php if($this->session->userdata('is_customer_logged_in')){ echo 'data-target="#rechargeModal"  class="btn btn-primary btn-block num-show-button"'; } else { echo 'data-target="#registerLoginModal"  class="btn btn-primary btn-block num-show-button "'; } ?> name="submit">Pay Here</button>


<!-- <button class="btn btn-default btn-radius nav-link content-popup num-show-button" type="button" id="button-mobile-recharge" data-toggle="modal" <?php if($this->session->userdata('is_customer_logged_in')){ echo 'data-target="#rechargeModal"  class="btn btn-primary btn-block num-show-button"'; } else { echo 'data-target="#registerLoginModal"  class="btn btn-primary btn-block num-show-button "'; } ?> name="submit" >Pay Here</button> -->
<!--	<p><span class="mt-2">  <b class="br_plan"><a href="JavaScript:void(0);">Browse Plans</a> </b>of all operators</span></p> -->
				</div>	
			<!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
                 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>              
  </div>
            </div> -->	
			
				

				

    <div id="rechargeModal" class="modal fade" role="dialog">
  <div class="modal-dialog wd"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title text-center">Please Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="red">Please fill all required fields.</p>
        <p class="greenn">Your <span class="mobno">Mobile Number</span>
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span> is <b><span class="phone-div"></span></b> and Amount is Rs. <b><span class="amount-div"></span></b> <br>		<br>	<b>Payment Type</b>	&nbsp; &nbsp; 
		<label class="radio-inline">
		<input type="radio" name="paytype" value="Wallet" checked="">		</label> 
		</p>

      </div>

      <div class="modal-footer foot-back"><input type="submit" name="confirm" value="Confirm" class="btn btn-success butn">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
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
						<div class="input-group">
							<input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="uid" maxlength="10" autocomplete="off"></div>
						</div>                
                </div>
            </div>          
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group operator-name">
                        <div class="field-mobilerecharge-amount required">
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="MobileRecharge[amount]" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div>
</div>  
<div class="form-group operator-name">
                 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>              
  </div>            
  </div>
  </div>			
			

			

			

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">



<button type="button" id="button-mobile-recharge" data-toggle="modal" data-target="#registerLoginModal" class="btn btn-primary btn-block " name="submit">Recharge Now</button>

				</div>		 

        </div>

                           

	</div>

        


<div class="" id="sh_plan" style=" display:none; ">

<div class="alert alert-success">

      <a href="#" class="close">×</a>

     

	<h3>Browse Plans</h3>

	<!-- required for floating -->

	<!-- Nav tabs -->

	<div class="plan-cnt">

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
	<div class="col-sm-5">
		<div class="how-it-works"><h2>How It Works</h2></div>
	<div class="youtube-video">
	<iframe width="100%" height="255" src="https://www.youtube.com/embed/SJydrbrMo88" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
	</div>
	</div>
                    

 </div>		

			   

              </div>

                </section>




<!---end new recharge ------->  
			  
					 <!----mini inner-0 banner start here----> 
			 
			 <section class="mini-inner-banner-0.1">
	<!-- 		 <div class="banner-inner" style="background-image: url(../);"> -->
			 	<img src="assets/front/images/banner-video.png">
			 </div>
			 <div class="container">
			 	<div class="row mt-3 text-center">
			 		<div class="col-sm-12">
			 			<button type="button" class="watch-video">Watch More Videos <i class="fa fa-play" aria-hidden="true"></i></button>
			 		</div>
			 	</div>
			 </div>
			 </section>
			 
			 
			 
			 <!----mini inner-0 banner end here---->   
			  
			  
			 <!----mini inner banner start here----> 
			 
			 <section class="mini-inner-banner">
	<!-- 		 <div class="banner-inner" style="background-image: url(../);"> -->
			 	<img src="assets/front/images/bannner14.png">
			 </div>
			 </section>
			 
			 
			 
			 <!----mini inner banner end here----> 
			  
			  
			  
			  
			  
			  
			<section class="webstore1 bannerrr">
				  <div class="container" >
					<div class="col-sm-12">
					<div class=" buy-banner-top" style="background-image: url(../assets/front/images/bannner15.png);">

					<!-- <img style="width:100%;" src="<?php echo base_url(); ?>assets/front/images/bannner15.jpg" class="girl img-responsive" alt="" /> -->
			<!--		<a class="btn btn-default genreate_linkk" href="/genratelink">Generate Cashback Link</a>  -->
						<div class="row">
							<div class="col-sm-8"></div>
							<div class="col-sm-4">
								<div class="buy-tittle">
							<h2 class="h2-buy-title text-center text-dark">The Pre Launch <br>Offer <br>(Limted State)</h2>
						</div>
						<div class="submit-intrest mt-5">
							<a href="#"><strong>S U B M I T   I N T E R E S T</strong></a>
						</div>
							</div>
						</div>
					</div> 
					</div>
					<div class="col-sm-6">
					<div class=" buy-banner-left" style="background-image: url(../assets/front/images/banner16.jpg.png">
						<div class="banner-left-titile">
							<div class="left-title">
								<h2 class="left-h2">BIGGER + FASTER <br>MONEYBACK</h2>
								<strong class="text-center mt-2">Be a Macro Partner</strong>
								<p class="text-center mt-2">Earn upto 1.11 Lakh per month</p>
								<div class="upgrade mt-5">
									<a href="#"><strong>U P G R A D E</strong></a>
								</div>
							</div>
						</div>

					</div>
					</div>
					<div class="col-sm-6">
					<div class=" buy-banner-right" style="background-image: url(../assets/front/images/banner17.png">
				<div class="banner-right-titile">
							<div class="left-title">
								<h2 class="right-h2">10X AWESOME <br>INCOME</h2>
								<strong class="text-center mt-2">Be a Mega Partner</strong>
								<p class="text-center mt-2">Earn upto 5.55 Lakh per month</p>
								<div class="upgrade mt-5">
									<a href="#"><strong>C O M I N G S O O N</strong></a>
								</div>
							</div>
						</div>

					</div>
					</div>
			</div> 

</section>
<!-- how it work banner start here  -->
<section class="how-it-work-banner">
	  <div class="container" >
					<div class="col-sm-6">
						<h3 class="text-dark text-left bg-dark" style="background:#fff;"><a href="what_is_zoogol">What is Zoogol </a>!</h3>
					<div class=" buy-banner-left" style="background-image: url(../assets/front/images/bannner18.png">

					</div>
					</div>
					<div class="col-sm-6">
						<h3 class="text-dark text-left" style="background:#fff;"><a href="why_to_zoogol">Why to Zoogol</a> !</h3>
					<div class=" buy-banner-right" style="background-image: url(../assets/front/images/178446676@2x-2.png">
					</div>
					</div>
					<div class="col-sm-12 mt-5" style="margin-top: 20px;">
						<h3 class="text-dark text-left" style="background:#fff;"><a href="how_to_start">How To Start !</a></h3>
					<div class=" buy-banner-top" style="background-image: url(../assets/front/images/iBT59mfVVs.png);">
					</div> 
					</div>
			</div> 
</section>


<!-- how it work baneer end here -->
		  
		  <section class="webstore1">
		  <div class="container" >
		  <div class="col-lg-12">
			<div class="alert alert-danger alert-dismissible newss" role="alert">
		  
				<marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="4">
					<p> <!-- <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> -->
					
					IMPORTANT NOTE : Upload your Bill/Invoice after your purchase via zoogol to get cashback
					<!-- <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> --></p>
				</marquee>
			</div>
		</div>
		 <div class="col-lg-12">
		  <div class="webstore-container" > 

                 <div class="products">
	   		     	<h5 class="latest-product">Get Cashback From Leading Websites</h5>	
	   		     	  <a class="view-all" href="<?php echo base_url(); ?>online_stores">VIEW ALL<span class="fa fa-angle-right"> </span></a> 		     
	   		     </div>
                 <div class="product-left">
				 
				 
				 				 	 <?php
if(!empty($b_d_coupon)) { 
$i=0;
foreach($b_d_coupon as $bdc) {
	
/* if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bdc['url'].$this->session->userdata('bliss_id').'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
 */	
	if($i==2 || $i==5) { $class='grid-top-chain'; }else{$class='';}
	
	echo ' <a href="'.base_url().'online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"> <div class="col-sm-3 '.$class.'"><div class="chain-grid"><img class="img-responsive center-block deal-img" src="'.base_url().'main-admin/images/webstores/'.$bdc['web_img'].'" alt=" " />
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
						<h5 class="text-center txt">'.$bdc['web_name'].'</h5>
	   		     			<h6 class="text-center ">'.$bdc['web_s_dis'].'</h6>
	   		     			<a href="'.base_url().'online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"><button type="button" class="btn btn-warning grab-btn yes">Get Cashback</button></a>
							</center>
	   		     		</div>
	   		     	</div></div> </a>';
	
		
	$i++;
	}
}  ?>

 <div class="col-md-12  col-sm-12 col-xs-12 btn-center">
	   		     	<a href="<?php echo base_url(); ?>online_stores"><button type="button" class="btn btn-warning view_btn">View All Websites</button></a>
					</div>
	 <div class="clearfix"> </div>
	   		     
	   		     
	   		     </div>
				
				 
	   		     </div>
	   		     </div>
	   		     </div>
	   		     </section>
				<section class="local-store">
					<div class="comming-soon">
						<!-- <div class="comming-soon-laocal" style="background-image: url(../"> -->
							<img src="assets/front/images/1-01-01.png">
							</div>
							<div class="comin-title">
								<h3 class="text-center">Shop at Zoogol Merchants</h3>
								<h2 class="text-center">Get Cashback + Earn Moneyback + Make Income</h2>
							</div>
							<div class="local-store-card">
								<div class="container">
									<div class="row">
									<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 13.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">M. G. Supermarket</h3>
												<small class="text-dark text-center">Sector 9-D, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 14-super-ele.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">New Super Electronics</h3>
												<small class="text-dark text-center">Sector 35-C, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 15-hair-dreser.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">Studio Strands</h3>
												<small class="text-dark text-center">Sector 17-C, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 16-flowers.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">Dew Drops Florists</h3>
												<small class="text-dark text-center">Sector 35-A, Chandigarh</small>
												<div class="view-store-btn" mt-4><a href="#">View Store Page</a></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/4Z8D1DFoyM-chair.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">The Furniture Mart</h3>
												<small class="text-dark text-center">Sector 9-D, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
									<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/CDCxGhKPBR-mobile-store.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">S. J. Mobile Store</h3>
												<small class="text-dark text-center">Sector 35-C, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 17-car-store.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">Goel Auto Lines</h3>
												<small class="text-dark text-center">Sector 17-C, Chandigarh</small>
												<div class="view-store-btn"><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="store-box">
												<img src="assets/front/images/Image 18-black-vhil.png" class="img-responcive store-img">
												<h3 class="text-dark text-center">S. P. Tyre House</h3>
												<small class="text-dark text-center">Sector 35-A, Chandigarh</small>
												<div class="view-store-btn" mt-4><a href="#">View Store Page</a></div>
											</div>
										</div>
										<div class="ciew-all-store"><a href="#">+ View All</a></div>
									</div>
								</div>
							</div>
					</div>

				</section> 
				<!-- <section class="Avail-Services-via-Zoogol">
					<div class="container">
						<div class="row">
							<h2 class="text-center">Avail Services via Zoogol</h2>
							<h2 class="text-center">Get Cashback + Earn Moneyback + Make Income</h2>
							<ul class="arival-service">
								<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							<li>
									<a href="#">
										<img src="assets/front/images/Image 13.png">
									</a>
							</li>
							</ul>
						</div>
					</div>
				</section> -->


				<!-- shop by category -->
				<section class="shop-by">
					<div class="container">
						<h3 class="text-center shop-by-h3">Shop Via Category</h3>
						<h2 class="text-center">Get Cashback + Earn Moneyback + Make Income</h2>
						<div class="row">
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image-2.png" class="shop-by-img">
								<h3 class="text-center">Automobile</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/education-2.png" class="shop-by-img">
								<h3 class="text-center">Education</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/appliance2.png" class="shop-by-img">
								<h3 class="text-center">Electronics</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/cinema-cinema-attributes-cinemas-films-online-viewing-popcorn-glasses_99433-1588.png" class="shop-by-img">
								<h3 class="text-center">Entertainment</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 4-fashion.png" class="shop-by-img">
								<h3 class="text-center">Fashion</h3>
								</div>
							</div>
						<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 5food.png" class="shop-by-img">
								<h3 class="text-center">Food & Grocery</h3>
								</div>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-sm-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 6-health.png" class="shop-by-img">
								<h3 class="text-center">Health</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/home18-sofa.png" class="shop-by-img">
								<h3 class="text-center">Home & Living</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 7-inversement.png" class="shop-by-img">
								<h3 class="text-center">Investment</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 8-bulding.png" class="shop-by-img">
								<h3 class="text-center">Real Estate</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image-2.png" class="shop-by-img">
								<h3 class="text-center">Travel</h3>
								</div>
							</div>
							<div class="col-sm-2 col-md-2">
								<div class="shop-by-cat">
									<img src="assets/front/images/Image 9-mix-bag.png" class="shop-by-img">
								<h3 class="text-center">Mix Bag</h3>
								</div>
							</div>
						</div>
					</div>
				</section>

				<!-- shop by category -->
				<!-- Macro product cat start here -->

				<section class="macro-cat">
					<div class="container">
						<h3 class="text-center shop-by-h3">Macro Products Categories</h3>
						<h2 class="text-center">Get Cashback + Earn Moneyback + Make Income</h2>
						<div class="row">
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/health2.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/insurance.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/education.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/travel.png" class="macro-cat-img">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 mt-5">
								<div class="macro-cat">
									<img src="assets/front/images/gadgets.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/electronic.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/fashion.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/jewellery.png" class="macro-cat-img">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 mt-5">
								<div class="macro-cat">
									<img src="assets/front/images/gorocery.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/home.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/inverstment.png" class="macro-cat-img">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="macro-cat">
									<img src="assets/front/images/real-stic.png" class="macro-cat-img">
								</div>
							</div>
						</div>
					</div>
					<div class="comming-soon-banner-bottom">
						<div class="container">
							<div class="row">
								<div class="col-sm-12">
									<img src="assets/front/images/dealis-comming-soon.JPG">
								</div>
							</div>
						</div>
					</div>
					<div class="how-zoogolworks">
						<div class="container">
							<div class="row">
								<h2 class="text-center text-dark">How Zoogol Works !</h2>
								<p class="text-center">Get Cashback + Earn Moneyback on all your Spending online. Same Products, Same Prices, But Extra Cashback. <br> Follow the simple steps given below to enjoy Extra Cashback everytime you shop online.</p>
								<div class="col-sm-3">
									<div class="how-work-zoogol-box">
										<div class="white-box"><img src="assets/front/images/online-shop.png" class="online-store"></div>
										<strong class="text-center">1. Shop</strong>
										<p class="text-center mt-3">Click out via Zoogol and buy</p>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="how-work-zoogol-box">
										<div class="white-box"><img src="assets/front/images/money.png" class="online-store"></div>
										<strong class="text-center">2. Get Cashback</strong>
										<p class="text-center mt-3">on all your purchases via Zoogol</p>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="how-work-zoogol-box">
										<div class="white-box"><img src="assets/front/images/22-mobile.png" class="online-store"></div>
										<strong class="text-center">3. Share</strong>
										<p class="text-center mt-3">with easy sharing systems</p>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="how-work-zoogol-box">
										<div class="white-box"><img src="assets/front/images/online-shop.png" class="online-store"></div>
										<strong class="text-center">4. Earn Moneyback</strong>
										<p class="text-center mt-3">earn moneyback again and again</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="last-sec">
						<div class="container">
							<div class="row">
								<h2 class="text-center mt-4" style="font-size: 25px; font-weight: bold;">Invite Friends & Earn</h2>
								<div class="col-sm-6">
									<div class="last-sec-left-img">
										<img src="assets/front/images/last-img.png">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="last-title">
										<h2>Refer Zoogol to Friends and Earn Everytime they Shop Via Zoogol !</h2>
										<p class="last-sc-content">Do your friends a real favor by Inviting them to join Zoogol using your Zkey and when they purchase you get moneyback in your account. So its an awesome Win Win.</p>
										<div class="last-sec-btn"><a href="#">Start Shareing Now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>


<script>

$(document).ready(function() { 
$('.cat_store').click(function() { 
	 $(".onl").attr("href", "online_stores_cat/");
	 $(".ofl").attr("href", "offline_stores_cat/");
	var data_url =  $(this).attr('data-url');
	var value = $('.onl').attr('href');
	var value1 = $('.ofl').attr('href');
	$('.onl').attr('href',value + data_url);
	$('.ofl').attr('href',value1 + data_url);

 });
 } );
</script>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container text-center" style="height: 409px;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000;
opacity: 0.8;">
          <span aria-hidden="true">&times;</span>
        </button>
				<div class="popup-box">
				
				
		<div class="tt">
		<h2> </h2>
					
					<a href="<?php echo base_url(); ?>online_stores_cat/"  class="Webstore-cnt data-url onl"> <button type="button" class="btn btn-default web-btn spy">Webstore</button></a>
					
					
					<a href="<?php echo base_url(); ?>offline_stores_cat/" class="Webstore-cnt data-url ofl"> <button type="button" class="btn btn-default web-btn spi">Near by Store</button></a> 
				
					
					</div>
				  
				</div>
				</div>
				 
			</div>
		  </div>



	<script>
            jQuery(document).ready(function() {
              jQuery('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
				autoplay:true,
               autoplayTimeout:2000,
               autoplayHoverPause:true,
                responsive: {
                  0: {
                    items: 2,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items:4,
                    nav: true,
                    loop: true,
                    margin: 10
                  }
                }
              })
            })
			
			
          </script> 
		  <link href="<?php echo base_url(); ?>assets/front/css/owl.carousel.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/owl.carousel.js"></script>		  

	<div class=" buy-banner" >

<img style="width:100%;" src="<?php echo base_url(); ?>assets/front/images/banner14.jpg" class="girl img-responsive" alt="" />
<a class="btn btn-default genreate_linkk" href="/genratelink">Generate Cashback Link</a>

</div>




<!--<div class="container-fluid" style="margin-top: 50px;">

<div class="demand-cnt">
<div class="demand">
<div class="door">
<h3>Product<a class="view-all" href=""><span class=""> </span></a> </h3>
</div>

<div class="grey grey1">
<div class="row">
<div class="owl-carousel">	
		
			<?php if(!empty($featured_product)) { 
			  foreach($featured_product as $ffood) {
				  
				  if($ffood['image']==''){$img='merchants/images/profile/business_details/No-image-available.jpg';}else{$img="merchants/images/product/".$ffood['image'];}
						echo '<a href="'.base_url().'wish-product/'.str_replace(' ','-',$ffood['p_id']).'" ><div class="item">
							<div id="search_category" class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										
										echo '<img src="'.$img.'" class="img-responsive black1">									
                                        ';
										?>
										
										
                           
                                <input type="hidden" name="search" value="<?php  echo $ffood['pname']; ?>">
      
									
										
										<?php
										
										
										echo '
											<p class="fd_a">'.$ffood['pname'].'</p> 
											<p style="color:#000;" class="fd_a">'.$ffood['d_name'].'</p> 
											
											
									<button  class="btn btn-warning grab-btn">Get Best Deal</button>
							
							
							
										</div> 
										
								</div> 
							</div>
						</div></a>';
			  }
			}
		?>

</div>
</div>
</div>
</div>
</div>
</div>
	<div class="container-fluid" style="margin-top: 50px;">
					 
   <div class="products">
	   		     	<h5 class="latest-product">Instore </h5>	
	   		     	  <a class="view-all" href="<?php echo base_url(); ?>offline_stores">VIEW ALL<span class="fa fa-angle-right"> </span></a> 		     
	   		     </div>
	   		     <div class="product-left">
				 
	   		     
				 	 <?php
					 //echo "<pre>"; print_r($merchant); echo "</pre>";
if(!empty($merchant)) { 
$i=0;
foreach($merchant as $bcd) {
	
	if($bcd['brand_proof']==''){$img='No-image-available.jpg';}else{$img=$bcd['brand_proof'];}
	
/* if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bcd['url'].$this->session->userdata('bliss_id').'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';} */
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-3 '.$class.'"><div class="chain-grid1">
	   		     		<a href="'.base_url().'merchant/'.$bcd['merchant_id'].'">
						
						<img class="img-responsive center-block" src="'.base_url().'merchants/images/profile/business_details/'.$img.'" alt=" " />
						
						
	   		     	
	   		     		<div class="grid-chain-bottom grid-chain-bottom1">
						<center>
	   		     			<h6 class="text-center txt">'.$bcd['d_name'].'</a></h6>
	   		     			
	   		     			
	   		     			<a href="'.base_url().'merchant/'.$bcd['merchant_id'].'"><button type="button" class="btn btn-warning grab-btn">Get Best Deal</button></a>
							</center>
	   		     		</div>
						</a>
						</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>
	   		     	
	   		     
                    
                    
	   		     	 <div class="clearfix"> </div>
	   		     </div>				 
	   		     </div>				 
				 
				  
				 
				 <div class="container mainn" style="margin-top: 25px;">
				 <div class="webstore-container">

<div class="demand">
<div class="door">
<h3>Webstore
 <a class="view-all" href="<?php echo base_url(); ?>online_stores">VIEW ALL<span class="fa fa-angle-right"> </span></a> </h3></div>

<div class="grey">
<div class="row">
<div class="owl-carousel">	
		
			<?php if(!empty($featured_admin_product)) { 
			  foreach($featured_admin_product as $ffood) {
				  if($this->session->userdata('is_customer_logged_in')){ $url='<a class="openPopup btn " href="'.base_url().'redirecting/'.$ffood['id'].'" target="_blank">';}else{$url='<a data-link="'.base_url().'redirecting/'.$ffood['id'].'" class="openPopup btn link " title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
				  
				  if($ffood['image']==''){$img='merchants/images/profile/business_details/No-image-available.jpg';}else{$img="main-admin/images/product/".$ffood['image'];}
						echo ' '.$url.'<div class="item">
							<div id="search_category" class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										
										echo '<img src="'.$img.'" class="img-responsive black3">									
                                        ';
										?>
										
      
									
										
										<?php
										
										
										echo '
											
											<p class="fd_a">'.$ffood['pname'].'</p> 
											
									<button  class="btn btn-warning grab-btn">Get Best Deal</button>
                           
							
										</div>  
								</div> 
							</div>
						</div></a>';
			  }
			}
		?>

</div>
</div>
</div>
</div>

</div>
</div>
				 <!--
				  <img class="img-responsive center-block im" src="<?php echo base_url(); ?>assets/front/images/zoogol1.png" alt=" ">
	   		     	 <div class="clearfix"> </div>-->


				

					
				
			<script src="<?php echo base_url(); ?>assets/front/js/jquery.wmuSlider.js"></script> 
				  <script>
	       			jQuery('.example1').wmuSlider();         
	   		     </script> 	

	<div class="clearfix"> </div>