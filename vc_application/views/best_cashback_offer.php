
<?php $this->load->view('includes/front/sidebar');?>
<div class="clearfix"></div><div class="container inner">
<div class="women-product">
<div class="row">  
					<div class="col-sm-12"> 
					<h2 class="title text-center">Best Cashback Offers</h2>	
					</div>	
					</div> 
					<div class="">
				 
				 <?php
if(!empty($b_c_Offers)) { 
$i=0;
foreach($b_c_Offers as $bco) {
	
if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bco['url'].'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid">
	   		     		'.$url.'<img class="img-responsive center-block" src="'.base_url().'/main-admin/images/product/'.$bco['image'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$url.''.$bco['pname'].'</a></h6>
	   		     		</div>
                        <div class="star-price">
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