<?php $this->load->view('includes/front/leftsidebar');?>

<?php  	 if($this->session->userdata('is_customer_logged_in')){ $url='<a  href="'.base_url().'redirecting/'.$store[0]['id'].'/'.$store[0]['web_name'].'" target="_blank">';}else{$url='<a data-link="'.base_url().'redirecting/'.$store[0]['id'].'/'.$store[0]['web_name'].'" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}  ?>
<?php echo $url;?>
<div  class="container-fluid single_store">
<div  class="store-banner">
<img class="img-responsive web_image" src="<?php echo base_url(); ?>main-admin/images/webstores/<?php echo $store[0]['web_img']; ?>"> 
<p class="text-center" style="margin-top:10px;">
Buy any Product via Zoogol to get Cashback
</p>


	<?php  	 if($this->session->userdata('is_customer_logged_in')){ $link='<a class="btn btn-primary get_deal openPopup " href="'.base_url().'redirecting/'.$store[0]['id'].'/'.$store[0]['web_name'].'" target="_blank">';}else{$link='<a data-link="'.base_url().'redirecting/'.$store[0]['id'].'/'.$store[0]['web_name'].'" class="btn btn-primary get_deal openPopup" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}  ?>
		<center><?php echo $link;?>Go TO Website</a></center>
					





</div>
</div>
</a>
<!--<div  class="container-fluid str_con">
<h2 class="store_heading"><?php echo $this->uri->segment(2);?></h2>
</div>-->

	<div class="container overlay">
		
		
		<!--<div class="row">
	<div class="cashh">
      <h2 class="font16"> <?php echo $store[0]['web_name']; ?> Cashback Category </h2>
      <table class="table-bordered table-striped">
        <thead class="app-bg">
          <tr>
            <th data-field="id" class="textCenter"> Category </th>
            <th class="textRight" data-field="name"> Cashback </th>
          </tr>
        </thead>
        <tbody>
		<?php if(!empty($store_product)) { 
			foreach($store_product as $product) {
				
				 if($this->session->userdata('is_customer_logged_in')){ $url='<a href="'.$product['url'].$this->session->userdata('bliss_id').'" target="_blank">';}else{$url='<a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';} 
			?>
              <tr>
                  <td width="70%"><?php  echo $url; ?><p><?php  echo $product['s_discription']; ?></p></a></td>
                  <td width="30%"><?php  echo $url; ?><?php echo $product['pname']; ?></a></td>
              </tr>
			  
		<?php } } ?>
      </table>
    </div>
		
		</div>-->
		
	<div class="clearfix"> </div>
	
	<div class="container-fluid mainn">
	<div class="products" style="margin-bottom: 0;">
	
	<h5 class="latest-product">Best Deals + Cashback </h5>
	</div>
	<?php if(!empty($store_product)) { 
			foreach($store_product as $product) {
			?>
	<div class=" col-sm-12">
	<div class="product-left">
	
	   		     <div class="col-md-6  product-left1 st">
	   		    
				 <div class="col-md-4 str_img">
				 <img class="img-responsive center-block" width="150px" src="<?php echo base_url(); ?>main-admin/images/product/<?php  echo $product['image']; ?>"> 
				</div>
				<div class="col-md-8 inclusions inclusions1">
<p class="fw fw1 title" id="lblVoucherTitle1"><span><?php  echo $product['pname']; ?></span>
                            
							  </p>
                    <div class="">
                            <div class="collapse" id="collapseExample<?php  echo $product['id']; ?>">
								<?php  echo $product['description']; ?>
                            </div>

                        </div>
						<?php  	 if($this->session->userdata('is_customer_logged_in')){ $url='<a class="openPopup btn btn-primary " href="'.base_url().'redirecting/'.$product['id'].'" target="_blank">';}else{$url='<a data-link="'.base_url().'redirecting/'.$product['id'].'" class="openPopup btn btn-primary link aa" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';}  ?>
						<input type="hidden" id="due_link" name="due_link" value="">
						
						<?php  echo $url; ?>Get Deal</a>
						
						



</div>
</div>



                    
                
	   		     	
	   		     </div>
				   
				 </div>
				  <?php } } ?> 
				 </div>
				 
				 <div class="col-lg-12 col-md-12 col-sm-12 terms1" id="trmcdys"> 
<h3>Terms &amp; Conditions</h3> 
<ul>
<li>   To earn Cashback, visit website via  Zoogol and then shop.</li>
  <li> To start earning Cashback, you must complete your purchase in the same session after clicking from Zoogol.</li>
  <li>  Don't close the website while shopping. If you do, you must again click through Zoogol to start a new session.</li>
  <li>
  You will not get cashback, if you pay for your order using retailers' credits, gift cards or vouchers.</li>
  <li>
 Make sure your shopping cart is empty when you click through to the store from Zoogol. If you add products before you click via Zoogol, your purchase will not track.</li>
  <li> 
 Don't click on other links to go to a website or click on pop-up ads while searching and shopping.</li>
  <li>
 Do not visit any other price comparison, coupon or deal site before placing your order. Else your Cashback will not be tracked.</li>
  <li>
 Don't open multiple tabs of a website. Make sure the website is opened only via Zoogol. If you want to shop some more after checking out the first time, you must go back to Zoogol and click back through to the website again.</li>
  <li>
 Cashback is not payable if you return any part of your order. Even if you exchange any part of your order, Cashback will be Cancelled.</li>
  <li>
 Cashback will not be paid on GST, delivery, card payment fees, taxes or any other additional charges.</li>
</ul>
 
</div>
</div>


	<!---->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body store_body">

            </div>
            <div class="modal-footer">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        </div>
      
    </div>
</div>

