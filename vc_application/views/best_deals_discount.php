<?php $this->load->view('includes/front/sidebar');?>
<div class="clearfix"></div>
<div class="container inner">
<div class="women-product">
<div class="row">  
  			    		<div class="col-sm-12"> 
						<h2 class="title text-center">Best Deals & Discounts</h2>
						</div>			 		
						</div> 
<?php
if(!empty($b_d_discount)) { 
$i=0;
foreach($b_d_discount as $bcd) {
	
if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$bcd['url'].'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '	<div class="col-md-2 col-sm-2 col-xs-6 '.$class.'"><div class="chain-grid">
	   		     		'.$url.'<img class="img-responsive center-block" src="'.base_url().'/main-admin/images/product/'.$bcd['image'].'" alt=" " /></a>
	   		     	
	   		     		<div class="grid-chain-bottom">
	   		     			<h6 class="text-center txt">'.$url.''.$bcd['pname'].'</a></h6>
	   		     			<div class="star-price text-center txt">
	   		     			
	   		     				'.$url.'Shop Now</a> 
	   		     				<div class="clearfix"> </div>
							</div>
							</div>
	   		     		</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>
	   	

</div>



</div>




