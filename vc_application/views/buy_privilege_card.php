<?php $this->load->view('includes/front/leftsidebar');?>
<style>
.smart-pricing .pricing-tables, .smart-pricing .pricing-tables .colm-list {
	display: block;
	position: relative;
}
.smart-pricing, .smart-pricing * {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-o-box-sizing: border-box;
	box-sizing: border-box;
}
.smart-pricing {
	font-family: "Roboto Condensed",sans-serif;
	line-height: 1.231;
	font-weight: 400;
	font-size: 14px;
	color: #626262;
}
.colm-list {
	margin-bottom: 50px;
}
.smart-pricing .dark-style .colm-list, .smart-pricing .elegant-style .colm-list {
	-webkit-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-moz-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-o-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-webkit-transition: all .2s ease;
	-moz-transition: all .2s ease;
	-ms-transition: all .2s ease;
	-o-transition: all .2s ease;
	transition: all .2s ease;
}
.smart-pricing .dark-style .pricing-header, .smart-pricing .elegant-style .pricing-header {
	margin-left: 0px;
	text-align: center;
}
.smart-pricing .pricing-tables .pricing-header {
	position: relative;
}
.smart-pricing .dark-style .pricing-header h2, .smart-pricing .elegant-style .pricing-header h2, .smart-pricing .dark-style .pricing-header h2 span, .smart-pricing .elegant-style .pricing-header h2 span {
	-webkit-transition: font-size .4s;
	-moz-transition: font-size .4s;
	-ms-transition: font-size .4s;
	-o-transition: font-size .4s;
	transition: font-size .4s;
}
.pricing-header .ftr {
	background: #2d3a91
}
.ftr {
	color: #fff;
	text-align: left;
	padding: 6px 16px 35px !important;
}
.smart-pricing .dark-style .pricing-header h2 span, .smart-pricing .elegant-style .pricing-header h2 span {
	display: block;
	font-size: 46px;
	font-weight: 300;
}
.brown{
	display: inline-block;
width: auto;
vertical-align: middle;
width: 100% !important;
margin-bottom: 22px !important;
}
.smart-pricing .dark-style .features-list .pricing-header h2 span, .smart-pricing .elegant-style .features-list .pricing-header h2 span, .smart-pricing .dark-style .features-list:hover .pricing-header h2 span, .smart-pricing .elegant-style .features-list:hover .pricing-header h2 span {
	text-transform: none;
	margin-top: 46px;
	font-size: 39px;
}
.smart-grids {
	/* max-width: 1140px; */
	margin: 0 auto;
	padding: 40px 0;
}
.smart-wrapper {
	display: block;
	padding: 0px;
}
.pricing-header.header-colored h3 {
	background: #2d3a91;
	padding-top: 5px;
	margin: 0;
	padding-bottom: 4px;
	margin-bottom: 4px;
	padding-left: -22px;
	position: relative;
	color: #fff;
	font-size: 17px;
	
	font-weight: bold;
}
.smart-pricing .elegant-style .features-list ul {
	border: 1px solid #d2d2d2;
	border-bottom: 0;
	margin-top: -10px ;
}
.smart-pricing .pricing-tables ul, .smart-pricing .pricing-tables ul li {
	list-style-type: none!important;
}

.smart-pricing .elegant-style ul {
	border: 1px solid #d2d2d2;
	background-color: #f5f5f5;
	border-top: 0;
}
.smart-pricing {
	font-family: "Roboto Condensed",sans-serif;
	line-height: 1.231;
	font-weight: 400;
	font-size: 14px;
	color: #626262;
}

.smart-pricing .elegant-style ul li {
	color: #000;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #d2d2d2;
	text-shadow: 0 1px rgba(255, 255, 255, 0.9);
}
.smart-pricing .dark-style ul li, .smart-pricing .elegant-style ul li {
	line-height: 24px;
	padding: 2px 6px;
	text-align: center;
}
.cross {
	color: #A8CF45;
}
.double-cross {
	color: #F65A5B;
}
.smart-pricing .dark-style .features-list ul li, .smart-pricing .elegant-style .features-list ul li {
	text-align: left;
}

.pricing-header.header-colored {
	padding-bottom: 99px;
	background: #eee;
}
.smart-pricing .dark-style .colm-list, .smart-pricing .elegant-style .colm-list {
	-webkit-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-moz-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-o-box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.04);
	-webkit-transition: all .2s ease;
	-moz-transition: all .2s ease;
	-ms-transition: all .2s ease;
	-o-transition: all .2s ease;
	transition: all .2s ease;
}
.smart-pricing .elegant-style ul {
	border: 1px solid #d2d2d2;
	background-color: #f5f5f5;
	border-top: 0;
}
.smart-pricing .dark-style .pricing-footer, .smart-pricing .elegant-style .pricing-footer {
	padding: 20px;
	margin-top: -12px !important;
	margin-left: -0px !important;
	text-align: center;
}
.smart-pricing .elegant-style .pricing-footer {
	border: 1px solid #d2d2d2;
	background-color: #f9f9f9;
	background-image: -webkit-linear-gradient(top, #fbfbfb, #ededed);
	background-image: -moz-linear-gradient(top, #fbfbfb, #ededed);
	background-image: -ms-linear-gradient(top, #fbfbfb, #ededed);
	background-image: -o-linear-gradient(top, #fbfbfb, #ededed);
	background-image: linear-gradient(to bottom, #fbfbfb, #ededed);
	-webkit-box-shadow: inset 0 1px #fff, inset 0 0 0 1px rgba(255, 255, 255, 0.5);
	-moz-box-shadow: inset 0 1px #fff, inset 0 0 0 1px rgba(255, 255, 255, 0.5);
	-o-box-shadow: inset 0 1px #fff, inset 0 0 0 1px rgba(255, 255, 255, 0.5);
	box-shadow: inset 0 1px #fff, inset 0 0 0 1px rgba(255, 255, 255, 0.5);
}
.smart-pricing .elegant-style.stripped-tables ul li:nth-child(2n) {
	background: #ebebeb;
}
.smart-pricing .pricing-tables .header-colored h1, .smart-pricing .pricing-tables .header-colored h2 {
	color: #fff;
}
.pricing-header.header-colored h2 {
	font-size: 16px;
}
.smart-pricing .dark-style .pricing-footer, .smart-pricing .elegant-style .pricing-footer {
	padding: 20px;
	margin-top: -2px;
	margin-left: -1px;
	text-align: center;
}

.features-list {
	margin-top: -18px;
}
.btc {
	background-color: #445af2 !important;
	border-color: #2d3a91 !important;
}
.btc:hover {
	color: #fff;
	background-color: #2d3a91 !important;
	border-color:#445af2!important;
}
.pricing-header.header-colored img {
	width: 147px;
	
}
.custom-modal-header {
	text-align: center;
	color: #f65a5b;
	text-transform: uppercase;
	letter-spacing: 2px;
	border-top: 4px solid;
}

.modal-content {
	position: relative;
	background-color: #fff;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	border: 1px solid #999;
	border: 1px solid rgba(0, 0, 0, .2);
	border-radius: 6px;
	outline: 0;
	-webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
	box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
}
.form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.btn.btn-default.pull-right.btn-submit {
	margin-bottom: 15px;
}


.btn.btn-default.pull-right.btn-submit:hover {
	background:#445af2;
	color:#fff;
}
@media (max-width:600px){
.pricing-header.header-colored {
	padding-bottom: 11px;
	background: #2d3a91;
}
.small {
	vertical-align: middle;
	width: 140px !important;
	top: 52px !important;
	position: absolute;
	right: 62px !important;
	align-content: center;
}
.sizes.yello {
	font-size: 25px !important;
	margin-bottom: 30px !important;
}
.cross {
	color: #fbfcf9;
	background: #99d119;
	border-radius: 50%;
	float: right;
	padding-right: 6px;
	padding-left: 6px;
}
.sizes {
	font-size: 30px !important;
	margin-top: 5px !important;
	margin-bottom: 66px !important;
}
}
@media (max-width:576px){
	.smart-pricing .dark-style ul li, .smart-pricing .elegant-style ul li {
	line-height: 24px;
	padding: 4px 5px;
	text-align: center;
}
.cross {
	color: #fbfcf9;
	background: #99d119;
	border-radius: 50%;
	float: right;
	padding-right: 6px;
	padding-left: 6px;
	margin-bottom: 7px;
}
.cross.sp {
	
	top: -5px;
	position: relative;
}
}
</style>
<div class="buy_wrapper">
<div class="container hidden-xs">
<div class="pages">
<h2 class="text-center" style="margin-top: 50px;font-size: 37px;">Buy Privilege Card</h2>


<div class="smart-grids">
<div class="smart-wrapper">
<div class="smart-pricing">
<div class="pricing-tables elegant-style stripped-tables comparison-table four-colm">
    <div class="col-sm-8 col-md-8 col-xs-12">
    <div class="colm-list features-list">
    <div class="pricing-header">
    <h2 class="ftr"><span>Features of Cards</span></h2>
    </div>
    <ul>
   
    <li data-feature="Discount from 3% upto 30% over more than 3000's outlets.">Discount from 3% to upto 30% over more than 3000's outlets.</li>
    
    <li data-feature="Minimum 6 Exclusive offers from wishzon apart from discounts.">Minimum 6 Exclusive offers from wishzon apart from discounts.</li>
    <!--<li data-feature=" Home delivery service for Grocery in Discounted Price."> Home delivery service for Grocery in Discounted Price.</li>-->
    <li data-feature="Discount Coupons from premium brands and Merchants.">Discount Coupons from premium brands and Merchants.</li>
    <li data-feature="Refer and Earn Program.">Refer and Earn Program.</li>
   
    <li data-feature="Discount on Mobile Recharge,Flight,Bus,Holidays and Hotel bookings.">Discount on Flight,Bus,Holidays and Hotel bookings.</li>
    <!--<li data-feature="Deals/Discounts on Tour Packages.">Deals/Discounts on Tour Packages.</li>-->
    <!--<li data-feature="Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.">Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.</li>-->
    
    <li data-feature="Deals/Discounts on Tour Packages.">Deals/Discounts on Tour Packages.</li>   
	 <li>1 Business Kit.</li>
  <li>5 Cash Vouchers of listed nearby stores.</li>
  <li>Unlimited Discount Vouchers of listed stores worth Rs. 10000/- </li>
 <li>Upto 50% Discount on all listed stores.</li>
  <li>Chance to win Surprise gift every month.</li>
 
    </ul>
    </div>
    </div>
      
	<div class="col-sm-3 col-md-3 col-xs-12">
<div class="colm-list noh">
<div class="pricing-header header-colored">
<h3>PRIVILEGE CARD</h3>
<div class="col-md-12">

<img src="<?php echo base_url(); ?>assets/front/images/Wishzon-Card.png" >

 </div>



</div>
<ul>


 	<li data-feature="Discount from 3% up to 30% over more than 3000's outlets."><span class="cross">&#10004;</span></li>
    <li data-feature="Special Price on Vehicle Insurance renewal."><span class="cross">&#10004;</span></li>
    
    <li data-feature="Minimum 6 Exclusive offers from wishzon apart from discounts."><span class="cross">&#10004;</span></li>
    <!--<li data-feature=" Home delivery service for Grocery in Discounted Price."> Home delivery service for Grocery in Discounted Price.</li>-->
    <li data-feature="Discount Coupons from premium brands and Merchants."><span class="cross">&#10004;</span></li>
    <li data-feature="Refer and Earn Program."><span class="cross">&#10004;</span></li>
    <li data-feature="Health package coupons."><span class="cross">&#10004;</span></li>
    <li data-feature="Online / Offline Gift Vouchers."><span class="cross">&#10004;</span></li>
    <!--<li data-feature="Participation in charitable activities.">Participation in charitable activities.</li>-->
    <li data-feature="Webstore Facility."><span class="cross">&#10004;</span></li>
    <li data-feature="Discount on Mobile Recharge,Flight,Bus,Holidays and Hotel bookings."><span class="cross">&#10004;</span></li>
    <!--<li data-feature="Deals/Discounts on Tour Packages.">Deals/Discounts on Tour Packages.</li>-->
    <!--<li data-feature="Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.">Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.</li>-->
    <li data-feature="SMS, E-mail and Voice call notifications."><span class="cross">&#10004;</span></li>
    <li data-feature="Deals/Discounts on Tour Packages."><span class="cross">&#10004;</span></li>
   

</ul> 
<div class="pricing-footer">
<form name="buypc" id="buypc" action="purchase.php" method="post">
<input type="hidden" name="choosedCardType" id="choosedCardType" value="5" />
<input type="hidden" name="currentPromo" id="currentPromo" value="no" />
<input type="hidden" name="u_code" id="u_code" value="" />
<input type="hidden" name="p_code" id="p_code" value="" />
<input type="hidden" name="trackid" id="trackid" value="" />
<td><button type="button" class="btn btn-danger buy-btn btc" data-toggle="modal" data-target="#buy_franchize">Buy Now</button></td>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
  
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"> Privilege Card</h2>
      </div>
      <div class="modal-body">
        <form class="form" action="" method="post" id="popup-register-form">
       <p><label>First Name</label> <input required="required" type="text" name="f_name" class="form-control input-empty"></p>
       <p><label>Last Name</label> <input required="required" type="text" name="l_name" class="form-control input-empty"></p>
       <p><label>Email</label> <input required="required" type="email" name="email" class="form-control input-empty"></p>
       <p><label>Phone</label> <input type="number" min="1" maxlength="10" name="phone" class="form-control input-empty"></p>
	   <p><label>&nbsp;</label> <input type="submit" name="submit" value="Register" class="btn btn-primary popup-register-button"> </p>
     </form>
	
      </div>

    </div> 

 </div>
</div>
</div>
</div>

<!------ Include the above in your HEAD tag ---------->
<div class="container hidden-md hidden-sm hidden-lg">
<div class="pages">
<h2 class="text-center" style="margin-top: 50px;font-size: 37px;">Buy Privilege Card</h2>


<div class="smart-grids">
<div class="smart-wrapper">
<div class="smart-pricing">
<div class="pricing-tables elegant-style stripped-tables comparison-table four-colm">
    <div class="col-sm-8 col-md-8 col-xs-12">
    <div class="colm-list features-list">
    <div class="pricing-header">
    <h2 class="ftr"><span class="sizes">Features of Cards</span></h2>
	<img class="small" src="<?php echo base_url(); ?>assets/front/images/Wishzon-Card.png" >
    </div>
    <ul>
   
    <li data-feature="Discount from 3% upto 30% over more than 3000's outlets.">Discount from 3% to upto 30% over more than 3000's outlets.<span class="cross">&#10004;</span></li>
    
    <li data-feature="Minimum 6 Exclusive offers from wishzon apart from discounts.">Minimum 6 Exclusive offers from wishzon apart from discounts.<span class="cross">&#10004;</span></li>
    
    <li data-feature="Discount Coupons from premium brands and Merchants.">Discount Coupons from premium brands and Merchants.<span class="cross">&#10004;</span></li>
    <li data-feature="Refer and Earn Program.">Refer and Earn Program.<span class="cross">&#10004;</span></li>
   
 
    
    <li data-feature="Discount on Mobile Recharge,Flight,Bus,Holidays and Hotel bookings.">Discount on Flight,Bus,Holidays and Hotel bookings.<span class="cross">&#10004;</span></li>
    <!--<li data-feature="Deals/Discounts on Tour Packages.">Deals/Discounts on Tour Packages.</li>-->
    <!--<li data-feature="Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.">Hospital cash benefit of Rs. 500/Day subjected to Max. of 90,000/Year.</li>-->
    
    <li data-feature="Deals/Discounts on Tour Packages.">Deals/Discounts on Tour Packages.<span class="cross">&#10004;</span></li>
	 <li>1 Business Kit.<span class="cross">&#10004;</span></li>
  <li>5 Cash Vouchers of listed nearby stores.<span class="cross">&#10004;</span></li>
  <li>Unlimited Discount Vouchers of listed stores worth Rs. 10000/- <span class="cross">&#10004;</span></li>
 <li>Upto 50% Discount on all listed stores.<span class="cross sp">&#10004;</span></li>
  <li>Chance to win Surprise gift every month.<span class="cross">&#10004;</span></li>
 
    </ul>
	<div class="pricing-footer">
<form name="buypc" id="buypc" action="purchase.php" method="post">
<input type="hidden" name="choosedCardType" id="choosedCardType" value="5" />
<input type="hidden" name="currentPromo" id="currentPromo" value="no" />
<input type="hidden" name="u_code" id="u_code" value="" />
<input type="hidden" name="p_code" id="p_code" value="" />
<input type="hidden" name="trackid" id="trackid" value="" />
<td><button type="button" class="btn btn-danger buy-btn btc" data-toggle="modal" data-target="#buy_franchize">Buy Now</button></td>
</form>
</div>
    </div>
    </div>
      
	
</div>
</div>
</div>
</div>
</div>
</div>
	<!--for mobile -->
	


<div id="buy_franchize" class="modal fade in" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content row">
				<div class="modal-header custom-modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Buy Privilege Card Now</h4>
				</div>
				<div class="modal-body">
					<form name="info_form" class="form-inline" action="" method="post">
						<div class="form-group col-sm-12">
							<select required class="form-control  brown" name="card_type" id="card_type" >
								<option value="" selected disabled>Card Type</option>
								<option value="Privilege Card">Privilege Card</option>
								
							</select>
						</div>
						
						<div class="form-group col-sm-12">
							<select required class="form-control  brown" name="price" id="f_period" >
								<option value="" selected disabled>Packages</option>
								<option value="500~~1"> 500</option>
								<option value="1000~~2">1000</option>
								
								
							</select>
						</div>
						<input type="hidden" value="0~~1" name="qty" id="f_qty">
						
						
					
						
								 <input type="hidden" name="total" id="f_total_amount">
								
								<input type="hidden" name="image" value="<?php echo base_url(); ?>assets/front/images/Wishzon-Card.png">	
	                            <input type="hidden" name="tax" value="0">
								
								<input type="hidden" name="desc"  value="Privilege Card" >
						<div class="form-group col-sm-12">
							<div id="f_message"></div>
						</div>
						<div class="form-group col-sm-12">
							<button type="submit" class="btn btn-default pull-right btn-submit">Submit</button>
						</div>
					</form>
				</div>
				
			</div>
			
		</div>
	</div>
	</div>
		<script>
	    $(doucument).ready(function(){
			
		$('#card_open').click(function{
		 setTimeout(function() {
                $('#buy_bronze').modal('show');
        }, 1500);		
		});
       
            });
			

	</script>
	

	