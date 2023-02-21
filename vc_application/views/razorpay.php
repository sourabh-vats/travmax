<section>	
<div class="container">


<div class="breadcrumbs">	
	<ol class="breadcrumb">		
	<li><a href="#">Home</a></li>
	<li class="active">Check out</li>
	<li class="active">Payment</li>	</ol>
	</div><!--/breadcrums-->		
 <div class="stepwizard text-center">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step text-left">
        <a href="<?php echo base_url();?>checkout" type="button" class="btn btn-primary btn-circle">Step 1</a>
        <p>Shipping</p>
      </div>
          <div class="stepwizard-step">
        <a href="javascript:;" type="button" class="btn btn-primary btn-circle" disabled="disabled">Step 2</a>
        <p>Payment</p>
      </div>
          <div class="stepwizard-step text-right">
        <a href="javascript:;" type="button" class="btn btn-default btn-circle" disabled="disabled">Step 3</a>
        <p>Thank you</p>
      </div>
        </div>
  </div>
  
<?php
$productinfo = 'Order ID #'.$order_id;
$txnid = time();
$surl = base_url().'thankyou';
$furl = base_url().'checkout/failed';       
$key_id = RAZOR_KEY_ID;
$currency_code = 'INR';            
$total = ($order_amt * 100); 
$amount = $order_amt;
$merchant_order_id = $order_id;
$card_holder_name = $oname;
$email = $email;
$phone = $phone;
$name = 'Wishzon';
$return_url = base_url().'checkout/callback';
?>   
  <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
  
  <input type="hidden" name="merchant_phone" id="merchant_phone" value="<?php echo $phone; ?>"/>
  <input type="hidden" name="merchant_email" id="merchant_email" value="<?php echo $email; ?>"/>
</form>
 <div class="row">
        <div class="col-lg-12 text-center">
         
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;
 
  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>
<script>
    jQuery('document').ready(function(){
        jQuery( "#submit-pay" ).trigger( "click" );
    });
</script>

	
</div>
</section>