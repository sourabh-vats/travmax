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
			  
			  <!-----Recharge----->
				<section class="recharge1 main-form py-0" style="position: relative;">
<div class="container">
<div class="row">
<div class="flipcard effect__click">
                    <div class="card__front posrel">
                <div class="recharge-bills recharge-bills-home">
<div class="tabs" style=" outline: currentcolor none medium;" tabindex="7">
<form class="form" action="" method="post" id="recharge">  
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Prepaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Prepaid"><i class="fa fa-mobile"></i>Prepaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Postpaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Postpaid"><i class="fa fa-mobile"></i>Postpaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline mo-dc" data-cls=".op-Datacard"><input type="radio" name="optradio" value="Datacard"><i class="fa fa-credit-card"></i>Datacard</label>
		</li>
		
		<li role="presentation" class="operator-radio">
			<label class="radio-inline dth-op" data-cls=".op-DTH"><input type="radio" name="optradio" value="DTH"><i class="fa fa-television"></i>DTH</label>
		</li>
		<li role="presentation" class="operator-radio active">
			 <label class="radio-inline elec" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-lightbulb-o"></i>Electricity</label>
		</li>
		
	</ul>
</form></div>
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
	  
  
<div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="mobile">
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class="radio"> 
					<label>
					<span class="mobno" style="display: none;">Mobile Number</span>
					<span style="display: none;" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="" class="elec-sh">Consumer Number</span>
					</label>
                </div>
            </div>  
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                        <div class="field-mobilerecharge-service_number required">
<div class="input-group"><!--span class="input-group-addon rupee1">+91</span--><input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="phone" maxlength="10" autocomplete="off"></div>
</div>  
<div class="clearfix"></div>
 <div class="field-mobilerecharge-operator required">
<select id="mobilerecharge-operator" class="form-control  with-arrow custom-select-operator" name="operator" required="">
	<option class="op-first-operator" value="" style="">Select</option> 
			  <option class="op-Prepaid-Mobile" value="BILAVAIRTEL001" style="display: none;">AIRTEL</option>			  </select><input type="hidden" name="circle" value="18">
			  <input type="hidden" name="operator_commision" id="operator_commision" value="0"> 
			  <input type="hidden" name="operator_cashback" id="operator_cashback" value="0"> 
			  <input type="hidden" name="merchant_cashback" id="merchant_cashback" value="0"> 

<div class="help-block"></div>
</div>
<div class="clearfix"></div>
<div class="field-mobilerecharge-amount required">
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="amount" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div> 
</div>
 
 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>  

            </div>
            </div>
            
            
           
            
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
				 <span class="mobno" style="display: none;"><img src="<?php echo base_url(); ?>assets/front/images/mobile.jpg" alt=""></span>
				 <span style="display: none;" class="dth-sh"><img src="<?php echo base_url(); ?>assets/front/images/DTH-RECHAGE.jpg" alt=""></span>
					<span style="" class="elec-sh"><img src="<?php echo base_url(); ?>assets/front/images/electricty.jpg" alt=""></span>   
                             
				</div>
            </div> 
		
			 
			<p><span>  <b class="br_plan"><a href="JavaScript:void(0);">Browse Plans</a> </b>of all operators</span></p>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">

<button type="button" id="button-mobile-recharge" data-toggle="modal" data-target="#registerLoginModal" class="btn btn-primary btn-block num-show-button " name="submit">Pay Here</button>

				</div>		
				</div>		
 
				 

    <div id="rechargeModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title text-center">Please Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="red">Please fill all required fields.</p>
        <p class="greenn">Your <span class="mobno" style="display: none;">Mobile Number</span>
					<span style="display: none;" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="" class="elec-sh">Consumer Number</span> is <b><span class="phone-div"></span></b> and Amount is Rs. <b><span class="amount-div"></span></b> <br>		<br>	<b>Payment Type</b>	&nbsp; &nbsp; 
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
<div class="input-group"><input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="uid" maxlength="10" autocomplete="off"></div>
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
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
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

			<li class="operator-radio">

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

			   

              </div>

                </section>
			  
			  
			  <!-----end Recharge----->
			  
		

		  
		  <section class="webstore1">
		  <div class="container" >
		  <div class="col-lg-12">
			<div class="alert alert-danger alert-dismissible newss" role="alert">
		  
				<marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="4">
					<p> <!-- <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> -->
					
					IMPORTANT NOTE : Upload your Bill/Invoice after your purchase via wishzon to get cashback
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
	
	echo ' <a href="'.base_url().'online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"> <div class="col-md-3 col-sm-4 col-xs-6 '.$class.'"><div class="chain-grid"><img class="img-responsive center-block deal-img" src="'.base_url().'main-admin/images/webstores/'.$bdc['web_img'].'" alt=" " />
	   		     	
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
				  <img class="img-responsive center-block im" src="<?php echo base_url(); ?>assets/front/images/wishzon1.png" alt=" ">
	   		     	 <div class="clearfix"> </div>-->


				

					
				
			<script src="<?php echo base_url(); ?>assets/front/js/jquery.wmuSlider.js"></script> 
				  <script>
	       			jQuery('.example1').wmuSlider();         
	   		     </script> 	

	<div class="clearfix"> </div>