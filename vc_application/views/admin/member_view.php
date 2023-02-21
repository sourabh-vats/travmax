<style>
.wip {
    max-width: 1080px;
}
.sd.sdfg.text-center {
	width: 100%;
	background: #dedede;
	min-height: 65px;
}

.smry {
    font-size: 45px;

    padding: 10px 0;
    line-height: normal;
    color: #fff;
  background-image: url(../images/top_bg.jpg);
  margin: 0;
    display: inline-block;
    clear: both;
    width: 100%;
    background-size: cover;	
}
.smryy {
	font-size: 45px;
	padding: 10px 0;
	line-height: normal;
	color: #fff;
	background-image: url(../images/3131713.jpg);
	margin: 0;
	display: inline-block;
	clear: both;
	width: 100%;
	background-size: cover;
	border-top: 6px solid #fe621f;
}
.leftttt {
	float: left;
	width: 50%;
}
.sd h3 {
	font-size: 40px;
	color: #414042;
	padding: 7px;
	clear: both;
	background: none;
	text-align: left;
	margin: 0;
}
.rightttt #demo {
	font-size: 22px;
}
.rightttt h4 {
	font-size: 12px;
	padding: 8px 0 0;
}
  

@media (max-width: 1599px) and (min-width: 1366px)
.gm {
    margin: 0 28px 0 0;
}
} 
.gm .df {
    font-size: 24px;
}

* {
    margin: 0;
    padding: 0px;
}
.hover_opn {
    display: none;
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    top: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    font-size: 21px;
    padding: 0 30px;
}
* {
    margin: 0;
    padding: 0px;
}
.hover_opn button {
    background: #fff;
    border-radius: 5px;
    /* color: #000; */
    padding: 5px 30px;
    margin: 15px 0 0;
}
.hover_opn button {
    background: #fff;
    border-radius: 5px;
    color: #000;
    padding: 5px 30px;
    margin: 15px 0 0;
}
.gm button {
    background: none;
    border: 0;
    padding: 0;
}
button, select {
    text-transform: none;
}
button {
    overflow: visible;
}

 
* {
    margin: 0;
    padding: 0px;
}


* {
    margin: 0;
    padding: 0px;
}



.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.gm .df big {
	font-size: 30px;
	display: block;
	clear: both;
	line-height: 60px;
}  
* {
    margin: 0;
    padding: 0px;
}

.main-body {
    
    padding: 0 !important;
}

.main-wallet {
    margin-left: 10px;
    margin-right: 20px;
}
.main-wallet .wallet {
    font-size: 20px;
color: #f97e76;
font-weight: 600;
}

</style>
<div class="smry smry4  text-center" >
 My Account
</div>
<div class="col-sm-12">
<?php 
$user = $profile[0]; 


$total=0;
if(!empty($show_direct)){
	foreach($show_direct as $row){
		
		$total=$total+$row['amount'];
		
	}
}

$cashback = $approved_cashback = $pending_cashback = $redeem_cashback = $moneyback = $approved_moneyback = $pending_moneyback = $redeem_moneyback = $credits = 0;

if(!empty($incomes)) {
    foreach($incomes as $inc) {
        
        //if($inc['type']=='MoneyBack') { $moneyback = $moneyback + $inc['tamount']; }
        if($inc['type']=='Credits') { $credits = $credits + $inc['tamount']; }

        if($inc['type']=='MoneyBack') { 
            if($inc['status']=='Approved') { $approved_moneyback = $approved_moneyback + $inc['tamount']; }
            if($inc['status']=='Pending') { $pending_moneyback = $pending_moneyback + $inc['tamount']; }
            if($inc['status']=='Redeem') { $redeem_moneyback = $redeem_moneyback + $inc['tamount']; }
            
            $moneyback = $moneyback + $inc['tamount'];
        }

        if($inc['type']=='Cashback') { 
            if($inc['status']=='Approved') { $approved_cashback = $approved_cashback + $inc['tamount']; }
            if($inc['status']=='Pending') { $pending_cashback = $pending_cashback + $inc['tamount']; }
            if($inc['status']=='Redeem') { $redeem_cashback = $redeem_cashback + $inc['tamount']; }
            
            $cashback = $cashback + $inc['tamount'];
        }
    }
}




$purchases_count = $purchases_amount = $online_purchase_count = $online_purchase_amount = $utility_purchase_count = $utility_purchase_amount = $service_purchase_count = $service_purchase_amount = $instore_purchase_count = $instore_purchase_amount =  0;  


$micro_purchases_count = $micro_purchases_amount = $micro_online_purchase_count = $micro_online_purchase_amount = $micro_utility_purchase_count = $micro_utility_purchase_amount = $micro_service_purchase_count = $micro_service_purchase_amount = $micro_instore_purchase_count = $micro_instore_purchase_amount =  0; 


$macro_purchases_count = $macro_purchases_amount = $macro_online_purchase_count = $macro_online_purchase_amount = $macro_utility_purchase_count = $macro_utility_purchase_amount = $macro_service_purchase_count = $macro_service_purchase_amount = $macro_instore_purchase_count = $macro_instore_purchase_amount =  0; 

$macro_count = $macro_amount = 0 ;

if(!empty($purchases)) {
  foreach ($purchases as $purchase) {
      if($purchase['type']=='Purchase') {
          if($purchase['order_type']=='Online') {
            if($purchase['role']=='Micro') {
                $micro_online_purchase_amount = $micro_online_purchase_amount + $purchase['amount'];
                $micro_online_purchase_count = $micro_online_purchase_count + 1;
            } 
            elseif($purchase['role']=='Macro') {
                $macro_online_purchase_amount = $macro_online_purchase_amount + $purchase['amount'];
                $macro_online_purchase_count = $macro_online_purchase_count + 1;
            }

             $online_purchase_amount = $online_purchase_amount + $purchase['amount'];
             $online_purchase_count = $online_purchase_count + 1;
          }
          if($purchase['order_type']=='Utility') {
              
              if($purchase['role']=='Micro') {
                  $micro_utility_purchase_amount = $micro_utility_purchase_amount + $purchase['amount'];
                  $micro_utility_purchase_count = $micro_utility_purchase_count + 1;
              } 
              elseif($purchase['role']=='Macro') {
                  $macro_utility_purchase_amount = $macro_utility_purchase_amount + $purchase['amount'];
                  $macro_utility_purchase_count = $macro_utility_purchase_count + 1;
              }

              $utility_purchase_amount = $utility_purchase_amount + $purchase['amount'];
              $utility_purchase_count = $utility_purchase_count + 1;
          }
          if($purchase['order_type']=='Instore') {
              
              if($purchase['role']=='Micro') {
                  $micro_service_purchase_amount = $micro_service_purchase_amount + $purchase['amount'];
                  $micro_service_purchase_count = $micro_service_purchase_count + 1;
              } 
              elseif($purchase['role']=='Macro') {
                  $macro_service_purchase_amount = $macro_service_purchase_amount + $purchase['amount'];
                  $macro_service_purchase_count = $macro_service_purchase_count + 1;
              }


              $service_purchase_amount = $service_purchase_amount + $purchase['amount'];
              $instore_purchase_count = $instore_purchase_count + 1;
          }

          if($purchase['order_type']=='Instore') {
              
              if($purchase['role']=='Micro') {
                  $micro_service_purchase_amount = $micro_service_purchase_amount + $purchase['amount'];
                  $micro_service_purchase_count = $micro_service_purchase_count + 1;
              } 
              elseif($purchase['role']=='Macro') {
                  $macro_service_purchase_amount = $macro_service_purchase_amount + $purchase['amount'];
                  $macro_service_purchase_count = $macro_service_purchase_count + 1;
              }
              $service_purchase_amount = $service_purchase_amount + $purchase['amount'];
              $instore_purchase_count = $instore_purchase_count + 1;
          }
          if($purchase['order_type']=='Macro') {
              $macro_purchases_amount = $macro_purchases_amount + $purchase['amount'];
              $macro_purchases_count = $macro_purchases_count + 1;
          }
          
      }
      if($purchase['type']=='Pack') {
              $macro_amount = $macro_amount + $purchase['amount'];
              $macro_count = $macro_count + 1;
      }
  }
}

$purchases_count = $online_purchase_count + $utility_purchase_count + $instore_purchase_count + $macro_purchases_count;
$purchases_amount = $online_purchase_amount + $utility_purchase_amount + $service_purchase_amount + $macro_purchases_amount;

$micro_purchases_count = $micro_online_purchase_count + $micro_utility_purchase_count + $micro_instore_purchase_count;
$micro_purchases_amount = $micro_online_purchase_amount + $micro_utility_purchase_amount + $micro_service_purchase_amount;

//$macro_purchases_count = $macro_online_purchase_count + $macro_utility_purchase_count + $macro_instore_purchase_count;
//$macro_purchases_amount = $macro_online_purchase_amount + $macro_utility_purchase_amount + $macro_service_purchase_amount;



?>

</div>
<div class="col-sm-12 right-bar">


 <?php if($profile[0]['macro']==0 && !empty($moneyback) && date('Y-m-d') <= date('Y-m-d',strtotime('+15 days',strtotime($moneyback[0]['rdate'])))) { ?>


    <div class="sd sdfg  text-center">
    <div class="leftttt">
        <h3>Account history</h3>
    </div>
    <div class="rightttt">
        <h4>Time Left to Upgrade Account</h4>
        <p id="demo"></p>
    </div>
</div>


<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 22, 2021 15:37:25").getTime();
var countDownDate = new Date("<?php echo date('Y-m-d',strtotime('+15 days',strtotime($moneyback[0]['rdate']))); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

 <?php } ?>



	<div class="gm fst_gm clr4 col-sm-4">
		  <!--a href="<?php //echo base_url(); ?>/admin/add_money"-->
		<div class="pgn">     
		<div class="imggg">
			<img src="images/img12.jpg"> 
			</div>
			
			<div class="df">
			<span> Total Amount<big>  
			 <?php echo $profile[0]['package_amt'];?></strong></big></span></div> 
			</div>
		 </a> 
	</div>
	
	<div class="gm fst_gm clr2 col-sm-4">
		<!--a href="<?php //echo base_url(); ?>/admin/macro_credits"-->
		<div class="pgn">		
			<div class="imggg">
			<img src="images/img12.jpg"> 
			</div>
			
		<div class="df">
			<span> Booking Amount<big> 
			
			<?php  if(!empty($purchases[0]['amount'])) { echo $purchases[0]['amount']; } else { echo 0; } ?>
			 <?php //echo $purchases[0]['amount']+0;?></strong></big></span></div> 
		</div>
		 </a> 
	</div> 

	<div class="gm fst_gm clr1 col-sm-4">
		<!--a href="<?php //echo base_url(); ?>/admin/my_wallet"-->
		<div class="pgn"><div class="imggg">
		<img src="images/img12.jpg"> 
		</div>
		
	<div class="df">
	<span> Wallet Balance <big> 
	 <?php echo $profile[0]['income_wallet'];?></strong></big></span></div> 
	</div>
	</a>
	</div>
	

	


<div class="gm fst_gm clr4 col-sm-4">
  <a href="<?php echo base_url(); ?>/admin/add_money">
<div class="pgn">     
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df adds_mny"><span>Cashback <big>  
 <?php echo $pending_cashback+$redeem_cashback+$approved_cashback;?></strong></big> </span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr1 col-sm-4">
	<a href="<?php echo base_url(); ?>/admin/my_wallet">
	<div class="pgn"><div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
<span>Moneyback<big>  
 <?php echo $pending_moneyback+$approved_moneyback;?></strong></big></span></div> 
</div>
</a> 
</div>

<div class="gm fst_gm clr2 col-sm-4">
<a href="<?php echo base_url(); ?>/admin/macro_credits">
<div class="pgn">		
	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
	<span>Income <big> <?php echo $credits;?></big> </span>
</div> 
</div>
 </a> 
</div> 

<div class="gm fst_gm clr4 col-sm-4">
  <a href="<?php echo base_url(); ?>/admin/add_money">
<div class="pgn">     
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df adds_mny"><span>Trav Cash <big>  
 <?php echo 0//$profile[0]['income_wallet'];?></strong></big></span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr1 col-sm-4">
	<a href="<?php echo base_url(); ?>/admin/my_wallet">
	<div class="pgn"><div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
<span>Travoucher<big>  
 <?php echo 0//$profile[0]['income_wallet'];?></strong></big></span></div> 
</div>
</a>
</div>
<div class="gm fst_gm clr2 col-sm-4">
<a href="<?php echo base_url(); ?>/admin/macro_credits">
<div class="pgn">		
	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
	<span>Travmiles <big> <?php echo $credits;?></big> </span>
</div> 
</div>
 </a> 
</div> 

<div class="gm fst_gm clr2 col-sm-4">
<a href="<?php echo base_url(); ?>/admin/installments">
<div class="pgn">		
	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
	<span>Installments<big> <?php //echo $credits;?></big> </span>
</div> 
</div> 
 </a> 
</div> 



<h1 class="tittles">Total Earnings</h1>

<div class="gm fst_gm clr4 col-sm-4">
  <a href="<?php echo base_url(); ?>/admin/add_money">
<div class="pgn">     
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df adds_mny"><span>Booking <big>  
	Thailand Tour</big> </span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr1 col-sm-4">
	
	<div class="pgn"><div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
<span>Purchases<big>  
 0 </big></span></div> 
</div>

</div>
<div class="gm fst_gm clr2 col-sm-4">

<div class="pgn">		
	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
	<span> Partners <big> <?php echo $credits;?></big> </span>
</div> 
</div>

</div> 











</div>
<script>
jQuery(document).ready(function() { 	
(function() {'use strict';
  document.body.addEventListener('click', copy, true);
    function copy(e) {
	var 
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);
    if (inp && inp.select) {
      inp.select();
	try {document.execCommand('copy');
        inp.blur();
		t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
    }
    }
})();

 

 jQuery('#redeem').keyup(function(){
	          var redeem = jQuery("#redeem").val();
			  var balance = jQuery("#balance").val();
			  var cash = parseFloat(balance-redeem);
			  <?php if($user['pancard']==''){?>
			  var bliss = parseFloat(redeem*0.20);
			  <?php }else{?>
			  var bliss = parseFloat(redeem*0.05);
			  <?php }?>
			  
			  jQuery("#final_redeem").val(bliss);
			  jQuery("#after_redeem").val(cash);
		  });


});
</script>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<script>
$(document).ready(function(){
  $("#moneyback").click(function(){
    $("#show-inner").show();
  });
  $("#my-cashback").click(function(){
    $("#show-inner").hide();
  });
   $("#my-income").click(function(){
    $("#my-income-inner").show();
  });
   $("#my-income").click(function(){
    $("#show-inner").hide();
  });
});

</script>


<script>
    $(document).ready(function(){
  $("#partners-view").click(function(){
    $("#partners-inner").toggle();
  });
   $("#purchases-view").click(function(){
    $("#purchases-inner").toggle();
  });
   });
</script>

<script>
$(document).ready(function(){
  $("#moneyback").click(function(){
    $("#moneyback").addClass("main-inner-bouuon active");
  });
  $("#moneyback").click(function(){
    $("#my-cashback").removeClass("active");
  });
  $("#my-cashback").click(function(){
    $("#moneyback").removeClass("active");
  });
   $("#my-income").click(function(){
    $("#moneyback").removeClass("active");
  });
   $("#my-income").click(function(){
    $("#my-income").addClass("active");
});
   $("#moneyback").click(function(){
    $("#my-income").removeClass("active");
});
   $("#my-cashback").click(function(){
    $("#my-income").removeClass("active");
});
   });

</script>
