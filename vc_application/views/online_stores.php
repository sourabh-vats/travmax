<?php $this->load->view('includes/front/leftsidebar');?>

	<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid">
			<img src="<?php echo base_url() ?>assets/front/images/online.png"  class="img-responsive" alt=" " />

	          </div>
	          </div>
			  <section class="webstore1">
		  <div class="container" >
			  <div class="webstore-container">
				  <div class="products" style="margin-bottom: 0;">
	
	<h5 class="latest-product">Online Store</h5>
	</div>
	   		     <div class="product-left">
				 
				 <?php

$content = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_Offer&Method=findAll&filters[allow_website_links]=1&limit=20');

$json_decode = json_decode($content,true);
//echo '<pre>'; print_r($json_decode); die();




if(!empty($json_decode)) { 
$i=0;
foreach($json_decode['response']['data']['data'] as $bco) {
	

	$content1 = file_get_contents('https://vcm.api.hasoffers.com/Apiv3/json?api_key=9621e2a3331a6ae5c8eb43e2ce7d8a706d9d97380221ea0c0d153ee1b8c12d39&Target=Affiliate_Offer&Method=getThumbnail&ids[]='.$bco['Offer']['id']);

	$json_decode1 = json_decode($content1,true);
	
	//echo '<pre>'; print_r($json_decode1['response']['data'][0]['Thumbnail']); echo '</pre>';

	foreach($json_decode1['response']['data'][0]['Thumbnail'] as $value)
	{
	   $thumbnail = $value['url'];
	}


$url='<a href="'.base_url().'online-store/'.$bco['Offer']['name'].'/'.$bco['Offer']['id'].'">';
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class="col-md-3 col-sm-3 col-xs-6 '.$class.'"><div class="chain-grid chain-grid2">
	   		     		'.$url.'<img class="img-responsive center-block online-images" src="'.$thumbnail.'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
						<h5 class="text-center txt">'.$url.''.$bco['Offer']['name'].'</h5>
	   		     			<h6 class="text-center">'.$url.''.$bco['Offer']['name'].'</h6>
							

							<a href="https://tracking.vcommission.com/aff_c?offer_id='.$bco['Offer']['id'].'&aff_id=34650&aff_click_id=DL&aff_sub='.$this->session->userdata('cust_id').'" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn" >Go To Store</button></a>
							
							</center>
	   		     		</div>
                        
							</div>
	   		     	</div>';
	
		
	$i++;
	}
}









if(!empty($webstore) && 1==2) { 
$i=0;
foreach($webstore as $bco) {
	
$url='<a href="'.base_url().'online-store/'.$bco['web_name'].'/'.$bco['id'].'">';
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class="col-md-3 col-sm-3 col-xs-6 '.$class.'"><div class="chain-grid chain-grid2">
	   		     		'.$url.'<img class="img-responsive center-block online-images" src="'.base_url().'/main-admin/images/webstores/'.$bco['web_img'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
						<center>
						<h5 class="text-center txt">'.$url.''.$bco['web_name'].'</h5>
	   		     			<h6 class="text-center">'.$url.''.$bco['web_s_dis'].'</h6>
							<a href="'.base_url().'online-store/'.$bco['web_name'].'/'.$bco['id'].'" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn" >Go To Store</button></a>

							<!--a href="'.$bco['web_link'].'" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn" >Go To Store</button></a-->
							
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
	   		   </div>
	   		   </section>
			   
			   
			   
                               
         <!--      <?php //$this->load->view('includes/front/leftsidebar');?> -->
				
	

	