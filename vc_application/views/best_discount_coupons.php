<?php $this->load->view('includes/front/sidebar');?>
<div class="clearfix"></div>
<div class="container inner">
<div class="women-product">
<div class="row">    	
		    		
					<div class="col-sm-12"> 
					<h2 class="title text-center">Best Discount Coupons</h2>						
</div>
			 								</div>
											<?php
if(!empty($b_d_coupon)) { 
$i=0;
foreach($b_d_coupon as $bdc) {
	
if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bdc['url'].'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
	
	if($i==2 || $i==5) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid">
	   		     		'.$url.'<img class="img-responsive center-block" src="'.base_url().'main-admin/images/product/'.$bdc['image'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$url.''.$bdc['pname'].'</a></h6>
                            <p class="text-center txt">'.$bdc['s_name'].'</p>
	   		     			<div class="star-price">
							</div>
	   		     		</div>
	   		     		</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>
											
											</div></div>