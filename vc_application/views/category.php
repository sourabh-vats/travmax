<?php $this->load->view('includes/front/leftsidebar');?>

	<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid">
			<img src="<?php echo base_url() ?>assets/front/images/offline1.png" class="img-responsive" alt=" " />

	          </div>
	          </div>
			  
			  <div class="container-fluid">
			  
			   <div class="product-left">
			 
			  				 	 <?php
if(!empty($merchant)) { 
$i=0;
foreach($merchant as $bcd) {

	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid">
	   		     		<a href="'.base_url().'merchant/'.$bcd['merchant_id'].'"><img class="img-responsive center-block   deal-img2" src="'.base_url().'merchants/images/profile/business_details/'.$bcd['brand_proof'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$bcd['d_name'].'</a></h6>
	   		     			
	   		     			
	   		     			<div class="star-price text-center"></a> 
	   		     				<div class="clearfix"> </div>
								
							</div>
	   		     		</div>
						</div>
	   		     	</div>';
	
		
	$i++;
	}
} else { ?>
<center><h1>Coming Soon...</h1></center>

<?php } ?>

 <div class="clearfix"> </div>
	   		     </div>	
			  
			  </div>
			