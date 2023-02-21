<?php $this->load->view('includes/front/leftsidebar');?>
<style>
.btn.btn-default.add-to-cart {
	padding: 9px 12px;
}
</style>
<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid">
			<img src="<?php echo base_url() ?>assets/front/images/online1.png"  class="img-responsive" alt=" " />

	          </div>
</div>
			  

					<div class="container-fluid ">
	<?php if(empty($products)) { ?>
<?php } else { ?>				

                 <div class="product-left col-sm-12 ">
				 
 
	
             <div class="products" style="margin-bottom:0;">
	   		     	<h5 class="latest-product">Near by Store</h5>	
	   		     	  
	   		     </div>
								
<?php if(!empty($products)) { 	foreach($products as $prod) {	
									if($prod['cost']==$prod['p_d_price']){$discount="";}
									else{$disc=$prod['cost']-$prod['p_d_price'];		
									$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}				
									if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> ₹".$prod['cost']."</span>";}						
									echo ' <div class="col-sm-3">						
									<div class="product-image-wrapper">					
									<div class="single-products">						
									<div class="productinfo text-center">'.$discount.'';																			
									if($prod['image']==''){ echo '<img src="'.base_url().'merchants/assets/front/images/products1.jpg" class="img-togg">'; }		    
									else { echo '<img src="'.base_url().'merchants/images/product/'.$prod['image'].'" class="img-responsive">'; }											
									echo'<h2>₹'.$prod['p_d_price'].'</h2>
									<p>'.$prod['pname'].'</p>
									<a href="'.base_url().'merchant/'.$prod['mid'].'"><p style="margin-bottom:10px;">'.$prod['d_name'].'</p></a>
									<a href="'.base_url().'wish-product/'.$prod['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>										</div>																		</div>								
																
									</div>	</div>						';				
									}
									} ?>							
									
									
									</div>
<?php } ?>									
									</div>		
										

						
					<div class="container-fluid">
				

                 <?php if(!empty($merchant)) { ?>
                
 <div class="product-left" Style="float:left;width:100%">
  <div class="products" style="margin-bottom:0;">
	   		     	<h5 class="latest-product">Near by Store</h5>	
	   		     	  		     
	   		     </div>
				 <?php } ?>
                 
								
<?php if(empty($merchant)) { ?><!-- <h2> not found. Please try with other keyword.</h2> -->
<?php } else { ?> 
		
									
 	 <?php
					
if(!empty($merchant)) { 
$i=0;
foreach($merchant as $bcd) {

	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid chain-grid121">
	   		     		<a href="'.base_url().'merchant/'.$bcd['id'].'"><img class="img-responsive center-block deal-img2" src="'.base_url().'merchants/images/profile/business_details/'.$bcd['brand_proof'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$bcd['d_name'].'</a></h6>
	   		     			
	   		     			
	   		     			<div class="star-price text-center"></a> 
	   		     				
								
							
							<a href="#" data-toggle="modal" data-target="#login-modal1"><button type="button" class="btn btn-warning grab-btn">Grab This Deal</button></a>

		  </div>
	   		     		</div>
						</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>						
											
									</div>			
									</div>		
									</div>
									<?php } ?>
						
						
						
					<div class="container-fluid  ">
			

                 <?php if(!empty($webstore)) { ?>
                
				 
				  <div class="product-left col-sm-12">
				   <div class="products" style="margin-bottom:0;">
	   		     	<h5 class="latest-product">Webstore</h5>	
	   		     	  		     
	   		     </div> 
				 <?php } ?>
               
				 	
						
						<?php if(empty($webstore)) { ?><!-- <h2> not found. Please try with other keyword.</h2> -->
<?php } else { ?> 
									
									<?php
								if(!empty($webstore)) { 
$i=0;
foreach($webstore as $bdc) {
	
/* if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bdc['url'].$this->session->userdata('bliss_id').'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
 */	
	if($i==2 || $i==5) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class=" margin_set col-md-2 col-sm-2 col-xs-6 '.$class.'">
	<div class="chain-grid  ">
	<img class="img-responsive center-block deal-img" src="'.base_url().'main-admin/images/webstores/'.$bdc['web_img'].'" alt=" " />
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
						<h5 class="text-center txt">'.$bdc['web_name'].'</h5>
	   		     			<h6 class="text-center ">'.$bdc['web_s_dis'].'</h6>
	   		     			
	   		     			<a href="online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"><button type="button" class="btn btn-warning grab-btn">Grab This Deal</button></a>
							</center>
	   		     		</div>
	   		     	</div>
					</div>
					';
	
		
	$i++;
	}
}  ?>

										
										
									</div>		
									</div>		
									
	   	
		<?php } ?>							
									
						
			