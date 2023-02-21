<?php $this->load->view('includes/front/leftsidebar');?>

	<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid">
			<img src="<?php echo base_url() ?>assets/front/images/offline.png" class="img-responsive" alt=" " />

	          </div>
	          </div>
			  
			  <div class="container-fluid">
			  
			    <div class="container-fluid mainn">
				  <div class="products" style="margin-bottom: 0;margin-top:30px;">
	
	<h5 class="latest-product">Near by Store</h5>
	</div>
	   		     <div class="product-left col-sm-12">
			  
			  				 	 <?php
if(!empty($merchant)) { 
$i=0;
foreach($merchant as $bcd) {

	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid ">
	   		     		<a href="'.base_url().'merchant/'.$bcd['merchant_id'].'"><img class="img-responsive center-block deal-img1" src="'.base_url().'merchants/images/profile/business_details/'.$bcd['brand_proof'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
	   		     			<h6 class="text-center txt">'.$bcd['d_name'].'</a></h6>
	   		     			
	   		     			<a href="'.base_url().'merchant/'.$bcd['merchant_id'].'" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn nearb" >Go To Store</button></a>
							</center>
	   		     		</div>
						</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>

 <div class="clearfix"> </div>
	   		     </div>	
			  
			  </div>
			