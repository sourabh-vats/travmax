<section>
		<div class="container">
			<div class="row">
				<?php $this->load->view('includes/front/leftsidebar');?>
				<div class="col-sm-9 padding-right">
              <h2 class="title text-center">Products</h2>

<?php 
if(!empty($products)) { 
	foreach($products as $prod) {
		
		
		if($prod['cost']==$prod['p_d_price']){$discount="";}else{$disc=$prod['cost']-$prod['p_d_price'];
		$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}
		
		if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> ₹".$prod['cost']."</span>";}
		
		if($prod['on_hover']!=''){ $hover='<a href="'.base_url().'bliss-product/'.$prod['p_id'].'"><div class="product-overlay">
											<div class="overlay-content">
											<img src="'.base_url().'merchants/images/product/'.$prod['on_hover'].'" class="img-responsive">
											<h2>₹'.$prod['p_d_price'].'</h2>
												<p>'.$prod['pname'].'</p>
												<!--a href="'.base_url().'bliss-product/'.$prod['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a-->
											</div>
										</div></a>';}else{$hover='';}
		
	  	
	echo '<a href="'.base_url().'bliss-product/'.$prod['p_id'].'"><div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center"> '.$discount.'';
										
											if($prod['image']==''){ echo '<img src="'.base_url().'merchants/assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'merchants/images/product/'.$prod['image'].'" class="img-responsive">'; }
											
		echo'									<h2>₹'.$prod['p_d_price'].$procost.'</h2>
											<p>'.$prod['pname'].'</p>
											<p>Pro ID: '.$prod['sku'].'</p>
											<!--a href="'.base_url().'bliss-product/'.$prod['p_id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a-->
										</div>
										'.$hover.'
							</div>
						</div>
						</div></a>
						';	
	}
} ?>
</div>
</div>
</div>

</section>	