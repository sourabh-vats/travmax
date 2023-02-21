<div class="container inner"><div class="row">    			    		<div class="col-sm-12">    			   								<h2 class="title text-center">New Arrivals</h2>														</div>			 					</div> 


<?php 
if(!empty($products)) { 
	foreach($products as $prod) {
	  echo '<div class="col-sm-3">
                <div class="col-img-2"><a href="'.base_url().'bliss-product/'.$prod['p_id'].'">';
              if($prod['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$prod['image'].'" class="img-responsive">'; }
       echo           '<img src="'.base_url().'assets/front/images/str.png" class="srt-0"></a>
                </div>
               <h4>'.$prod['pname'].'</h4>
              <strong>₹'.$prod['price'].'</strong>
              <p><a class="btn btn-primary" href="'.base_url().'bliss-product/'.$prod['p_id'].'">BUY NOW</a></p>
            </div>';	
	}
} ?>
</div>