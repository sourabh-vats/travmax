<?php $this->load->view('includes/front/leftsidebar');?>



<?php //print_r($products); ?>
<section>		
<div class="container pd">


						<?php if(empty($products)) { ?>	<p>Product not found.</p><?php } else { 	$prod = $products[0];	?>			
						
						<?php if($prod['cost']==$prod['p_d_price']){$discount="";}else{$disc=$prod['cost']-$prod['p_d_price'];
		$discount="<p class='disc'>".round($disc/$prod['cost']*100) ."% OFF </p>";}
		
		if($prod['cost']==$prod['p_d_price']){$procost="";}else{$procost="<span> ₹".$prod['cost']."</span>";}
		?>
						
						
						<div class="row">			
						<div class="col-sm-12 padding-right" style="background:#fff;padding: 30px 0;">
						<div class="product-details"><!--product-details-->	
						<div class="col-sm-4">	
						<div class="view-product imgBox">	
						<?php if($prod['image']=='') { 	$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'merchants/images/product/'.$prod['image'].'';	} ?>	
						<img src="<?php echo $image_url;?>" alt="" class="img-responsive" data-origin="<?php echo $image_url;?>">
						
						
						</div>	
						
						
						</div>	
						<div class="col-sm-1"></div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
							<?php echo $discount;?>
							<!--img src="<?php echo base_url(); ?>assets/front/images/new.jpg" class="newarrival" alt="" /-->	
								
							<h2><?php echo $prod['pname'];?></h2>							
<p>Pro. ID: <?php echo $prod['sku'];?></p>
<p><span class="p_d_price"><?php echo $procost;?></span> </p>
<p class="mrp">	<span><?php echo '₹'.$prod['p_d_price'];?></span></p>								
								<!--<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" class="form form-inline crt-btn">-->
                                <label>Quantity:</label>								
								<div class="hide">	
								<input type="hidden" name="name" value="<?php echo $prod['pname'];?>">	
								<input type="hidden" name="id" value="<?php echo $prod['id'];?>">	
								<input type="hidden" name="image" value="<?php echo $image_url;?>">	
								</div>
								<input type="number" required min="1" name="qty"  value="1" class="form-control qty-no" placeholder="Qty.">
								<span><button type="submit" class="btn btn-warning grab-btn"  data-toggle="modal" data-target="#login-modal1" style="color:#fff">	
								Grab this deal					
								</button></span>
								<!--</form>	-->
								<p><b>Availability:</b> In Stock</p>
								
								
								
								<!--a href=""><img src="<?php echo base_url().'assets/front/images'; ?>/share.png" class="share img-responsive"  alt="" /></a-->
								</div><!--/product-information-->	
								</div>			
								</div><!--/product-details-->
								<div class="category-tab shop-details-tab"><!--category-tab-->
								<div class="col-sm-12">	
								<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li ><a href="#reviews" data-toggle="tab">Reviews</a></li>
								</ul>
								</div>	
								
								<div class="tab-content">
								<div class="tab-pane fade  active in" id="details" >
								<div class="col-sm-12">
								<p><?php echo $prod['s_discription']; ?></p>
								<?php echo $prod['description'];?>																		</div>
								</div>
								
								<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">	

                <?php if(!empty($review)) 
				{foreach($review as $reviews) { 

					//print_r ($reviews);
					
				
					
				echo	'<ul>						
								<li><a href=""><i class="fa fa-user"></i>'.$reviews['name'].'</a></li>
								<li><a href=""><i class="fa fa-clock-o"></i>'.date('h:i A',strtotime($reviews['r_date'])).'</a></li>
								<li><a href=""><i class="fa fa-calendar-o"></i>'.date('d F Y',strtotime($reviews['r_date'])).'</a></li>

								</ul>									
								<p>'.$reviews['comment'].'</p>';
					} 
				} ?>


								<p><b>Write Your Review</b></p>	
								<div id="review-msg-div"></div>
								 <form class="form" action="" method="post" id="review">
								<span>					
								<input required type="text" name="name" placeholder="Your Name"/>
								<input required type="email" name="email" placeholder="Email Address"/>
								<input  type="hidden" name="pro_id" value="<?php echo $prod['id'];?>"/>										
								</span>		
								<textarea required name="comment" ></textarea>
								
								<input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" id="star-3" type="radio" name="rating"value="3"/>
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
								<label class="star star-1" for="star-1"></label>
								
								<input type="submit" name="submit" value="Submit" class="btn btn-primary popup-register-button">
								</form>	
								</div>	
								</div>	
								</div>	
								</div><!--/category-tab-->										
								
								
								</div>	
								</div>	
								<?php } ?>		
								</div>	
								</section>	


<style>
	#owl-product .owl-nav{text-align:center;}
	#owl-product .owl-nav div {position: relative;top: 0;font-size: 22px !important;width: 55px;height: 40px;display: inline-block;margin: 1px 23px;}
	
.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 1px;
  font-size: 23px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
