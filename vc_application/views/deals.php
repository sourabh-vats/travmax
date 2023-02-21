	<?php $this->load->view('includes/front/leftsidebar');?>
	
	
	<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid" style="box-shadow: 0 4px 9px rgba(0, 0, 0, 0.6);">
			<img src="<?php echo base_url() ?>assets/front/images/banner-deal1.jpg"  class="img-responsive" alt=" " />

	          </div>
	          </div>
	
	<div class="container-fluid mainn">
<div class="clearfix"> </div>
                 <?php if(!empty($deals)) { ?>
                 <div class="products"  style="margin-bottom: 0;">
	   		     	<h5 class="latest-product">Near by Store</h5>	
	   		     	  		     
	   		     </div> 
				 <div class="product-left col-sm-12" style="float:left;">

				 <?php } ?>
                 
								
<?php if(empty($deals)) { ?><!-- <h2> not found. Please try with other keyword.</h2> -->
<?php } else { ?> 
		
									
 	 <?php
					
if(!empty($deals)) { 
$i=0;
foreach($deals as $bcd) {

	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-2 col-sm-3 col-xs-6 '.$class.'"><div class="chain-grid">
	   		     		<a href="'.base_url().'merchant/'.$bcd['id'].'"><img class="img-responsive center-block deal-img1" src="'.base_url().'merchants/images/profile/business_details/'.$bcd['brand_proof'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$bcd['d_name'].'</a></h6>
	   		     			
	   		     			
	   		     			<div class="star-price text-center"></a> 
	   		     				
								
							
							<a href="'.base_url().'merchant/'.$bcd['id'].'"><button type="button" class="btn btn-warning grab-btn">Get Best Deal</button></a>

		  </div>
	   		     		</div>
						</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>						
									</div>			
									</div>	


<div class="container-fluid buy-banner" style="margin-top: 25px;
margin-bottom: 20px;">

<img style="width:100%;" src="<?php echo base_url(); ?>assets/front/images/banner-microsite.jpg" class="girl img-responsive" alt="" />

</div>


					<div class="container-fluid mainn">
<div class="clearfix"> </div>
<?php if(!empty($deals)) { ?>
                 <div class="products" style="margin-bottom: 0;">
	   		     	<h5 class="latest-product">Webstore</h5>	
	   		     	  
	   		     </div> <?php } ?>
                 <div class="product-left col-sm-12" style="float:left;">

				 				 	 <?php
if(!empty($b_d_coupon)) { 
$i=0;
foreach($b_d_coupon as $bdc) {
	
/* if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bdc['url'].$this->session->userdata('bliss_id').'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
 */	
	if($i==2 || $i==5) { $class='grid-top-chain'; }else{$class='';}
	
	echo ' <div class="col-md-2 col-sm-3 col-xs-6 '.$class.'">
	<a href="online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"> 
	<div class="chain-grid deal-img1 deal-img4"><img class="img-responsive center-block online-images" src="'.base_url().'main-admin/images/webstores/'.$bdc['web_img'].'" alt=" " />
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
	   		     			<h6 class="text-center txt">'.$bdc['web_s_dis'].'</h6>
	   		     			<a href="online-store/'.$bdc['web_name'].'/'.$bdc['id'].'"><button type="button" class="btn btn-warning grab-btn">Get Best Deal</button></a>
							</center>
	   		     		</div>
	   		     	</div></div> </a>';
	
		
	$i++;
	}
}  ?>
	   		     
	   		     										</div>
</div>									
									
									
									
						
							
									</div>		
									</div>
								</div>
									<?php } ?>