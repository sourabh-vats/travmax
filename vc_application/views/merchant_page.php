<?php $this->load->view('includes/front/leftsidebar');?>


<?php if(empty($merchant)) { ?>
<div class="col-sm-12 text-center">
	<h2>Merchant not found</h2>
	<p>This merchant not found please check the url.</p>
</div>
	<?php } else { 
	$merchant = $merchant[0]; 
	?>





<div class="ABC hidden-xs">
<h1 style="margin-left: 637px;"><?php echo $merchant['d_name'];?></h1>
</div>
<img src="/images/bnr1.jpg" class="img-responsive hidden-xs">

<?php /* if($merchant['brand_proof']!='') { 
   echo '<img src="/images/merchant/bnr1.jpg" class="img-responsive">';
} else {
	echo '<img src="/merchants/images/profile/business_details/'.$merchant['brand_proof'].'" class="img-responsive">';
} */ ?>



<div class="container-fluid pics">

<div class="clearfix"></div>
						<div class="col-sm-12 col-xs-12 dtpage">
							<div class="col-sm-4 col-xs-12 padding0 leftdt">

								
		<div class="col-sm-12 col-xs-12 padding0 paddingR0">
	<div id="phgal_dtl" class="seoshow "></div>

	<div id="gal_img">
	<div class="col-sm-12 col-xs-6">
	<?php if($merchant['brand_proof']=='') {$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'/merchants/images/profile/business_details/'.$merchant['brand_proof'].'';	} ?>
	
			<?php echo '<img src="'.$image_url.'" class="img-responsive merchnat-img">'; ?>
			
			<?php if($merchant['images']!=''){
				$imagesArray = json_decode($merchant['images'],true);
				$count = 1; 
				foreach($imagesArray as $imagesVal) {
					echo '<div class="form-group col-sm-4"><img class="img-responsive" src="'.base_url().'merchants/images/profile/business_details/'.$imagesVal.'" ></div>';
					$count++;
				}
			} ?>
			</div>
			<div class="col-sm-12 col-xs-6">
				<ul class="comp-contact" id="comp-contact">
						  <span class="telnowpr"><a class="tel ttel"><span class="mobilesv icon-nm"><?php //echo $merchant['phone']; ?></span> 
						</a><!-- <span class="contct">click to contact</span> -->
											<li>
							<span class="comp-icon fa fa-home hidden-xs"></span> <!-- Address Priority Set to Area > Streat >LandMark >City-Pin -->
							<span class="comp-text">
								<span class="adrstxtr" id="fulladdress">
									<span >
										<span class="lng_add"><?php echo $merchant['address_s_1'].' '.$merchant['address_s_2'].' '.$merchant['city'].' '.$merchant['state'].' '.$merchant['zip'].' '.$merchant['country'];?></span>
									 </span>
																
											</span>
							</span>
						</li>
														<li onclick="_ct('alsolstdin', 'dtpg');">
							<span class="comp-icon rsotroptn hidden-xs"></span>
							 

						</li>
					
			   
							<li><i class="web_ic sprite_wb comp-icon"></i>
						
						
						</li>
				</ul>
				</div>
			<iframe width="100%" height="280" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowfullscreen="" src="https://maps.google.it/maps?q=<?php echo $merchant['address_s_1'].' '.$merchant['address_s_2'];?>,<?php echo $merchant['city'];?>&output=embed"></iframe>
			
			
	</div>

</div>
</div>


<div class="col-sm-8 col-xs-12 ">
<div class="category-tab shop-details-tab"><!--category-tab-->
								<div class="col-sm-12 count">	
								<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li class=""><a href="#reviews" data-toggle="tab">Reviews</a></li>
								<li class=""><a href="#video" data-toggle="tab">Video</a></li>
								
								</ul>
								</div>	
								
								<div class="tab-content">
								<div class="tab-pane fade active in" id="details">
								<div class="col-sm-12">
								<h3>Merchant Details</h3>
<p><?php echo $merchant['b_details'];?></p>								

<a href="#" data-toggle="modal" data-target="#login-modal1" style="color:#fff"><button type="button" class="btn btn-warning grab-btn" >Buy Wishzon privliege Card   <span>To get all deals + Cashback </span> <span>listed from nearby Store</span></button>
</a>
</div>
								</div>
								
								<div class="tab-pane fade" id="reviews">
								<div class="col-sm-12">	

                <?php if(!empty($review)) 
				{foreach($review as $reviews) { 

					//print_r ($reviews);
					
				echo '';
					
				echo	'<div class="cust_review"><ul>						
								<li><a href=""><i class="fa fa-user"></i>'.$reviews['name'].'</a></li>
								<li><a href=""><i class="fa fa-clock-o"></i>'.date('h:i A',strtotime($reviews['r_date'])).'</a></li>
								<li><a href=""><i class="fa fa-calendar-o"></i>'.date('d F Y',strtotime($reviews['r_date'])).'</a></li>
							 <div class="line"></div>
								</ul>									
								<p>'.$reviews['comment'].'</p> </div>';
					} 
				} ?>

								<h3>Write Your Review</h3>	
								<div class="col-sm-12">	
								 <form class="form" action="" method="post" id="review">
								<span>					
								<input required="" type="text" name="name" placeholder="Your Name">
								<input required="" type="email" name="email" placeholder="Email Address">
								<input type="hidden" name="mer_id" value="<?php echo $merchant['merchant_id'];?>">										
								</span>
								</div>								
								<div class="col-sm-12">			
								<textarea required placeholder="Be specific and relevant to the place you're reviewing and describe what other visitor are likely to experience. Be authentic and describe why you liked or disliked the place. Include aspects like the ambiance, service quality, value for money, credibility of the vendor, timely delivery," name="comment"></textarea></div>
								 
                                
								
								<div class="col-sm-6">
								 <b>Please rate your experience</b>
								 <input class="star star-5" id="star-5" name="rating" value="5" type="radio">
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" id="star-4" name="rating" value="4" type="radio">
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" id="star-3" name="rating" value="3" type="radio">
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" id="star-2" name="rating" value="2" type="radio">
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" id="star-1" name="rating" value="1" type="radio">
								<label class="star star-1" for="star-1"></label>
								
								 </div>
								 
								 
								 <div class="col-sm-6">	
								<input name="submit" value="Submit" class="btn btn-primary popup-register-button" type="submit"></div>
								
								</form>	
								</div>	
								</div>	
								
								<div class="tab-pane fade " id="video">
								<div class="col-sm-12">
								<h3>Video</h3>
						
<iframe width="854" height="480" src="<?php echo $merchant['video'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>


</div>
								</div>
								
								
								</div>	
								</div>
                                
  <div class="features_items"><!--features_items-->
		
			<?php if(!empty($products)) { 
			  foreach($products as $product) {
				  
				  if($product['image']=='') { 	$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'merchants/images/product/'.$product['image'].'';	}
				  
						echo '<a target="_blank" href="/product/'.$product['p_id'].'"><div class="col-md-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										
										if($product['p_d_price'] < $product['cost']) {
											$discount = ($product['p_d_price'] * 100) / $product['cost'];
											$discount = 100 - round($discount,1);
										echo '<p class="disc">'.round($discount).'% OFF </p>';
										}
											
								echo '<img src="'.$image_url.'" class="img-responsive">									
                                        <h2>';
										if($product['p_d_price']==$product['cost'] || $product['p_d_price']=='' || $product['p_d_price']==0) {
											echo '<i class="fa fa-inr"></i>'.$product['cost'];
										} else {
											echo '<i class="fa fa-inr"></i>'.$product['p_d_price'].' <span><i class="fa fa-inr"></i>'.$product['cost'].'</span>';
										}
										
										echo '</h2>
											<p class="txt ptxt">'.$product['pname'].'</p> 
											<p class=" ptxt">Pro ID: #'.$product['id'].'</p> '; ?>
											

											
											
										<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" class="form form-inline sell-btn">	
								<div class="hide">	
								<input type="hidden" name="name" value="<?php echo $product['pname'];?>">	
								<input type="hidden" name="id" value="<?php echo $product['p_id'];?>">	
								<input type="hidden" name="image" value="<?php echo $image_url;?>">	
	                            <input type="hidden" name="tax" value="<?php echo $product['p_d_price']*$product['t_class']/100;?>">
								<input type="hidden" name="qty"  value="1" >
								</div>
								<button type="button" class="btn btn-warning grab-btn" ><a href="#" data-toggle="modal" data-target="#login-modal1" style="color:#fff">Grab This Deal</a></button>
								
								</form>
											
											
											
									<?php 	echo '
										</div> 
								</div> 
							</div>
						</div></a>';
			  }
			}
		?>
						  
                        				
						
</div><!---FEATURE--->                              
</div><!---COL-8-->
</div>

</div>


<div class="container-fluid other">
<h3>You may also like:</h3>
<?php if(!empty($similar)) { 
			  foreach($similar as $same) {
				  
				  if($same['brand_proof']=='') { 	$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'/merchants/images/profile/business_details/'.$same['brand_proof'].'';	}
				  
echo '<div class="col-md-3"><div class="ther"><a href="'.base_url().'merchant/'.$same['merchant_id'].'"><img src="'.$image_url.'" class="img-responsive deal-img2"><h5>'.$same['d_name'].'</h5></a></div></div>';

 }
			}
		?>

</div>

</div>

<?php } ?>



<!--<div id="testo" class="message">
    <div class="message_pad">
        <div id="message"></div>
        <div class="message_leave">
		<section class="jpbg">
		<span class="jcl">X</span>
		<section>
		<section>
			
			<span class="jbt"> While we connect you with relevant Merchants, help us with these details to serve you better</span>
			<section class="bdc">
				<form class="form" action="" method="post" id="contct">
<input type="hidden" name="mer_no" value="<?php echo $merchant['phone']; ?>">
<input type="hidden" name="mer_nm" value="<?php echo $merchant['d_name']; ?>">
<div class="form-group">
    <label class="control-label col-sm-3">Your Name <sup>*</sup></label>
	<div class="col-sm-9">  
    <input type="text" required class="form-control" name="name" value="" >
  </div>
  </div>
  
  
  <div class="form-group">
    <label class="control-label col-sm-3">Your Mobile Number <sup>*</sup></label>
	<div class="col-sm-9">  
    <input type="text" required class="form-control" type="text" name="mobile" >
  </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-3" >Email ID <span>(Optional)</span></label>
	<div class="col-sm-9">  
    <input type="email" class="form-control" tabindex="7"  name="email">
  </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-3">Requirement</label>
	<div class="col-sm-9">  
   <textarea name="Message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
  </div>
  </div>
   <div class="col-sm-12">	
	<input name="contct" value="Submit" class="btn btn-primary popup-register-button" type="submit">
	</div>


</form>
				
						
				</section>		
				</section>
				
	
		
            
        </div>
    </div>
</div>--->



<script>
  jQuery(".contct").click(function()
    {
       jQuery("#testo").show();
    });
	
	  jQuery(".jcl").click(function()
    {
       jQuery("#testo").hide();
    });
	
	jQuery(".message").css({
		'height': $(document).height()+'px'
	});
    jQuery(".message_pad").css({
        'left': ($(document).width()/2 - 500/2)+'px'
    });
	
	jQuery(window).resize(function(){
	jQuery(".message").css({
		'height': $(document).height()+'px'
	});
    jQuery(".message_pad").css({
        'left': ($(document).width()/2 - 500/2)+'px'
    });
});	
</script>
