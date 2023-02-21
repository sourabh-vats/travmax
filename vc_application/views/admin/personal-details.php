<style>

<?php error_reporting(0); ?>

.wip {
    max-width: 1080px;
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
	
	
}

.sd h3 {
    margin-bottom: 15px;
    font-size: 36px;
}
.sd h3 {
    font-size: 40px;
    width: 100%;
    text-align: center;
    background: #E0E0E0;
    /* margin: 30px 0 20px; */
    font-family: 'proxima_novasemibold';
    color: #414042;
    padding: 10px 0;
    clear: both;
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


.main-wallet {
    display: none;
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

</style>
<div class="smry smry4  text-center" >
 My Purchases & Summary
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

$cashback = $moneyback = 0;

if(!empty($incomes)) {
    foreach($incomes as $inc) {
        if($inc['type']=='Cashback') { $cashback = $cashback + $inc['tamount']; }
        if($inc['type']=='MoneyBack') { $moneyback = $moneyback + $inc['tamount']; }
    }
}
?>

<!--h2 class="wella">Welcome <?php echo $this->session->userdata('user_name');?></h2-->
<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'redeem')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Account upgrade request sumited successfully. upgrade process will may take 1-2 working days.';
          echo '</div>';       
        }  
		if($this->session->flashdata('flash_message') == 'emi_bliss_perks')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Thank you for shopping with us. We will be shipping your order to you soon.';
          echo '</div>';       
        }
		if($this->session->flashdata('flash_message') == 'emi_payment_error')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your order info or email to admin.';
          echo '</div>';       
        }
      }   
	  
      //flash messages
        if(!empty($invite_email))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Invitation sent successfully';
          echo '</div>';       
        } 

if($profile[0]['account_name']=='' || $profile[0]['account_no']=='' || $profile[0]['aadhar']=='' || $profile[0]['pancard']=='') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please update your profile';
          echo '</div>';
           }elseif($profile[0]['var_status']=='no') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your profile is under review please wait 2 working days';
          echo '</div>';
           }
	 echo validation_errors();
?>
</div>
<div class="col-sm-12 right-bar">

<!---------- cash ---------------->

<div class="main-wallet">
  <div class="row">

    <div class="col-sm-3 text-center"><a href="<?php echo base_url(); ?>admin/upgrade_account"><h4 style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;">Activation Wallet : <?php echo $user['activation_wallet']; ?></h4></a></div>

    <div class="col-sm-3 text-center"><a href="<?php echo base_url(); ?>admin/payment"><h4 style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;">Load Wallet</h4></a></div>
    <div class="col-sm-3 text-center"><h4 style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;">Wallet Amount : INR <?php echo array_sum(array_column($incomes, 'tamount'));?></h4></div>
    <div class="col-sm-3 text-center"><h4 style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;"
style=" font-size: 20px;
    color: #f97e76;
    font-weight: 600;">Wallet Balance : INR <?php echo $profile[0]['income_wallet']; ?></h4></div>
  </div>
</div> 

<div class="sd sdfg  text-center">
	<h3>Account history</h3> 
<div class="gm fst_gm clr1 col-sm-4">
  <a href="<?php echo base_url(); ?>admin/income/show">
	<div class="pgn"><div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
<span>My Wallet<big>  
<i class="fa fa-inr" ></i>
 <?php echo array_sum(array_column($incomes, 'tamount'));?></strong></big> </span></div> 
</div>
   </a> 
</div>

<!-- <div class="gm fst_gm col-sm-3">
  <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
<div class="pgn"><img src="images/img12.jpg"> <div class="df"><span>Approved Cashback  <big><i class="fa fa-inr"></i><?php echo $achived;?></big> </span></div> 
</div>
 </a>     
</div> -->    

<div class="gm fst_gm clr2 col-sm-4">
<div class="pgn">		
	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df">
	<span>My Credits <big><?php echo count($products)+count($online_purchase);?></big> </span>
</div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr2 col-sm-4">
  <a href="<?php echo base_url(); ?>admin/uploadreceipts">
<div class="pgn">     
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df"><span>My Total earnings<big> <?php echo count($online_purchase);?></big> </span></div> 
</div>
 </a> 
</div>
<div class="gm fst_gm clr4 col-sm-4">
  <a href="<?php echo base_url(); ?>admin/order">
<div class="pgn">  
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df"><span>My Cashback<big> <?php echo count($products);?></big> </span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr5 col-sm-4">
<a  href="<?php echo base_url(); ?>admin/income/Cashback">
<div class="pgn"> 

<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>

	<div class="df"><span>My Moneyback<big> </i><i class="fa fa-inr"></i> <?php echo $cashback;?></big> </span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr6 col-sm-4">
  <a  href="<?php echo base_url(); ?>admin/income/MoneyBack">
<div class="pgn">  
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df"><span>My Business Income<big> <i class="fa fa-inr"></i><?php echo $moneyback;?></big> </span></div> 
</div>
</a> 
</div> 



<!-- <div class="gm fst_gm clr5 col-sm-4">
  <a  href="<?php echo base_url();?>admin/downlineall">
<div class="pgn">  

<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	<div class="df"><span>My Cashback <big> <?php echo count($total_partner);?></big> </span></div> 
</div>
 </a> 
</div>
<div class="gm fst_gm clr6 col-sm-4 hide">
 <a href="javascript:;">
<div class="pgn">  
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df"><span>Active Circles <big> <?php // echo $total;?>0</big> </span></div> 
</div>
   </a> 
</div>

<div class="gm fst_gm clr7 col-sm-4">
   <a href="javascript:;">
<div class="pgn">
<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
<div class="df"><span>My Moneyback<big> <?php if(array_key_exists(1, $macro_partner)) { echo $macro_partner[1]; }  ?></big> </span></div> 
</div>
 </a> 
</div>

<div class="gm fst_gm clr8 col-sm-4">
<div class="pgn">  <div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df"><span class="text-center">My Income </span><big> <i class="fa fa-inr"></i><?php echo $user['eligibility'];?></big></div> 
</div>
</div> 

<div class="gm fst_gm clr3 col-sm-4">
 <a href="javascript:;">
<div class="pgn">	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df"><span>Virtual Cashback<big> <i class="fa fa-inr"></i><?php echo $user['bliss_amount'];?></big> </span></div> 
</div>
 </a> 
</div> 

 <div class="gm fst_gm clr2 col-sm-4">
   <a href="javascript:;">
<div class="pgn">	<div class="imggg">
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df"><span>Approved Cashback<big> <i class="fa fa-inr"></i><?php echo $user['wallet'];?></big> </span></div> 
</div>
 </a> 
</div> 

 <div class="gm fst_gm clr1 col-sm-4">
   <a href="<?php echo base_url();?>admin/Payment_request">
<div class="pgn">		
<div class="imggg">   
	<img src="images/img12.jpg"> 
	</div>
	
<div class="df"><span>Redeem Amount<big><i class="fa fa-inr" ></i><?php echo $user['income_wallet']+0;?></big> </span></div> 
</div>
 </a>  
</div>  -->

 
 </div> 

<ul class="main-div">
    <li><button class="main-inner-bouuon active" id="my-cashback" onclick="openCity(event, 'London')">My Cashback</button></li>
    <li> <button class="main-inner-bouuon" id="moneyback" onclick="openCity(event, 'Paris')">My Moneyback</button></li>
    <li><button class="main-inner-bouuon" onclick="openCity(event, 'Tokyo')">My Income</button></li>
</ul>
<div id="London" class="tabcontent">
  <div class="row">
    <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Approved Cashback</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">This amount is the approved cashback after verification</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Pending Cashback</p>
        <big> <i class="fa fa-inr"></i> 75.00</big>
        <p class="mt-5 ammount-txt">This amount is the pending cashback yet to be verified</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Total Redeemed Cashback</p>
        <big> <i class="fa fa-inr"></i> 0.00</big>
        <p class="mt-5 ammount-txt">This is the amount of the cashback transferred to me</p></div>
    </div>
</div>
</div>
 <div class="row mt-5 main-inner-ro" id="show-inner">
    <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Moneyback Eligibility</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">This is the total amount of moneyback I can earn</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Amount of Purchases</p>
        <big> <i class="fa fa-inr"></i> 75.00</big>
        <p class="mt-5 ammount-txt">This amount is the total of all my purchases</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Approved Moneyback</p>
        <big> <i class="fa fa-inr"></i> 0.00</big>
        <p class="mt-5 ammount-txt">This amount is the total amount which has been approved. I can take it to bank</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Pending Moneyback</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">This is the amount waiting for appoval</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Redeem Moneyback</p>
        <big> <i class="fa fa-inr"></i> 00.00</big>
        <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Total Redeemed Moneyback</p>
        <big> <i class="fa fa-inr"></i> 0.00</big>
        <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p></div>
    </div>
</div> 


<div id="Tokyo" class="tabcontent">

</div>

<div class="co">
    <div class="row">
        <div class="col-sm-12">
            <div class="db-nner">
                <h6>Total Redeemed Earnings ( Redeemed Cashback + Redeemed Moneyback + Redeemed Earnings ) : <i class="fa fa-inr" aria-hidden="true"></i> 00</h6>
            </div>
        </div>
    </div>
</div>
<div class="co-middel">
    <div class="row">
        <div class="col-sm-12">
            <ul class="inner-content">
                <li><div class="db-">
              <img src="https://www.zoogol.blissinfosys.com/images/mypurchases.png">
              <h2>My Purchases</h2> <br>
            </div>
            <div> <span>These are all my purchases</span></div>
        </li>
            <li class="flex-end"><a href="#" ></a>
                 <button class="" id="purchases-view">View <i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </li>
            </ul>
            <div id="purchases-inner">
                  <div class="row mt-5 main-inner-ro">
    <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Amount of Purchases</p>
        <big><i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">This is the amount of all my purchases</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">No. of Purchases</p>
        <big> 0</big>
        <p class="mt-5 ammount-txt">These are total number of my Online purchases</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Online Purchases</p>
        <big> <i class="fa fa-inr"></i>0</big>
        <p class="mt-5 ammount-txt">These are total number of my Online purchases</p></div>
    </div>
     </div>
   <div class="row">
        <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Micro Purchases</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">This is the amount waiting for appoval</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Macro Purchases</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">Macro Purchases</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Mega Purchases</p>
        <big> <i class="fa fa-inr"></i> 0.00</big>
        <p class="mt-5 ammount-txt">This amount is the moneyback transferred to me</p></div>
    </div>
    <div class="row btns">
        <div class="col-sm-4">
           <div class="inner-btn"><a href="#"><img src="https://www.zoogol.blissinfosys.com/images/instorecancellation.png">Untraced Purchase</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div> 
        </div>
         <div class="col-sm-4">
           <div class="inner-btn"><a href="#"><img src="https://www.zoogol.blissinfosys.com/images/instorecancellation.png">Upload Purchase</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div> 
        </div>
         <div class="col-sm-4">
           <div class="inner-btn"><a href="#"><img src="https://www.zoogol.blissinfosys.com/images/instorecancellation.png">Recent Purchases</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div> 
        </div>
        <div class="col-sm-4 mt-5" id="btn-true">
           <div class="inner-btn"><a href="#"><img src="https://www.zoogol.blissinfosys.com/images/instorecancellation.png">Online Cancellations</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div> 
        </div>
        <div class="col-sm-4" id="btn-true">
           <div class="inner-btn"><a href="#"><img src="https://www.zoogol.blissinfosys.com/images/instorecancellation.png">Instore Cancellations</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div> 
        </div>
    </div>
     </div>
   </div>
        </div>
    </div>
</div>
<div class="co-middel">
    <div class="row">
        <div class="col-sm-12">
            <ul class="inner-content">
                <li><div class="db-">
              <img src="https://www.zoogol.blissinfosys.com/images/mypartners.png">
              <h2>My Partners</h2> <br>
            </div>
            <div> <span>These are all my partners</span></div>
        </li>
            <li class="flex-end"><a href="#"></a>
                 <button class="" id="partners-view">View <i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </li>
            </ul>
              <div id="partners-inner">
                  <div class="row mt-5 main-inner-ro">
    <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Total Partners</p>
        <big> 0</big>
        <p class="mt-5 ammount-txt">This is the total number of my partners</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Active Partners</p>
        <big> 0</big>
        <p class="mt-5 ammount-txt">These are my partners who have made purchases</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Inactive Partners</p>
        <big> <i class="fa fa-inr"></i>0</big>
        <p class="mt-5 ammount-txt">These partners are yet to make a purchase</p></div>
    </div>
     </div>
   <div class="row">
        <div class="col-sm-4">
        <div class="my-cashback-inner-first">
        <p class="p-inner">Macro Partners</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">These are partners in my circles who have upgraded to Macro Partners</p>
    </div>
    </div>
   <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Mega Partners</p>
        <big> <i class="fa fa-inr"></i> 0</big>
        <p class="mt-5 ammount-txt">These are partners in my circles who have upgraded to Mega Partners</p></div>
    </div>
    <div class="col-sm-4">
        <div class="my-cashback-inner">
        <p class="p-inner">Total Redeemed Moneyback</p>
        <big> <i class="fa fa-inr"></i> 0.00</big>
        <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p></div>
    </div>
              </div>
   </div>
</div>
        </div>
   
</div>
<div class="col-sm-12" id="bliss-wallet">
<?php 
$independent = $total_friend = $stage = $achivers = 0;
$referrals = '';
if(!empty($myfriends)) {
	$total_friend = count($myfriends); 
	foreach($myfriends as $friend){
		if($friend['level']=='1') { 
			$independent = $independent + 1; 
			$referrals .= '<tr><td>'.$friend['name'].'</td><td>'.$friend['friends'].'</td></tr>';
		}
		if($friend['level'] > $stage) { $stage = $friend['level']; }
		
	}
}
?>
<!--<div class="sd sdfg  text-center">
<h3>Sales Associate</h3>
<div class="gm fst_gm col-sm-3">
<div data-toggle="modal" data-target="#referralModal">
<div class="pgn">
<img src="images/img20.jpg">
<div class="df">
<span>Independent <big>

<?php echo $independent; ?></big> </span>
</div>
</div></div></div>
<div id="referralModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Independent Sales Associate</h4>
      </div>
      <div class="modal-body">
        <table class="table">
		<tr><th class="text-center">Name</th><th class="text-center">Friends</th></tr>
		<?php if($referrals=='') { echo '<tr><td colspan="2">No friends.</td></tr>';} 
		else { echo $referrals; } ?>
		</table>
      </div> 
    </div> 
  </div>
</div>
<div class="gm fst_gm col-sm-3">
  <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
<div class="pgn"><img src="images/img6.jpg"> <div class="df"><span>Total <big><?php echo $total_friend; ?></strong></big> </span></div> 
<div class="hover_opn"><span>
This is the total  of all
my purchases  </br><button>Enter</button></span>
</div>
</div></a> 
</div>
<div class="gm fst_gm col-sm-3">
  <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
<div class="pgn"><img src="images/img8.jpg"> <div class="df"><span>Stage <big><?php echo $stage; ?></strong></big> </span></div> 
<div class="hover_opn"><span>
This is the total  of all
my purchases  </br><button>Enter</button></span>
</div>
</div></a> </div>
<div class="gm fst_gm col-sm-3">
  <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
<div class="pgn"><img src="images/goodness-score.jpg"> <div class="df"><span>Achievers <big><?php echo $achivers;?></strong></big> </span></div> 
<div class="hover_opn"><span>
This is the total  of all
my purchases  </br><button>Enter</button></span>
</div>
</div>
</a> 
</div>
</div>-->


<div class="col-sm-2"></div>
</div>


<!--
<div class="sd sdfg  text-center" id="my-transaction">

 <div class="gm fst_gm col-sm-3">
  <a href="<?php echo base_url();?>admin/directs">
<div class="pgn">
<img src="images/img22.jpg">
 <div class="df" >
 <span >My Referrals  <big>
<?php echo $independent; ?></strong></big> </span></div> 
<div class="hover_opn"><span>
This is the total  of all
my purchases  </br><button>Enter</button></span>
</div>
</div>
</a> 
</div>



<div class="gm fst_gm col-sm-3">
  <a  href="<?php echo base_url();?>admin/income/show">
<div class="pgn"><img src="images/img12.jpg"> <div class="df"><span>Referral Income  <big><i class="fa fa-inr"></i><?php echo $total;?></big> </span></div> 
</div>
 </a> 
</div>
<div class="gm fst_gm col-sm-3">
  <a href="<?php echo base_url();?>feedback">
<div class="pgn"><img src="images/img21.jpg">
<div class="df">
 <span>Feedback</span>
 </div> 
</div>
   </a> 
</div>

<div class="gm fst_gm col-sm-3">
   <a href="<?php echo base_url();?>complaint">
<div class="pgn"><img src="images/img19.jpg">
<div class="df">
<span>Complaint</span>
</div> 
</div>
 </a> 
</div>


</div>  -->
<div class="col-sm-6 col-sm-offset-3">
<div class="frdn" data-toggle="modal" data-target="#invite-friend-modal">Invite Friends</div>
</div>
<!-- Modal -->
<div id="all-transaction-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Wishzon History</h4>
      </div>
      <div class="modal-body">
	  <table class="table" style="width:100%">
  <tr>
   <th>Sr. no</th>
    <th>Redeemed Amt.</th>
    <th>Redeemed Amt. after TDS</th>
    <th>Request</th>
    <th>Date</th>
    <th>Status</th>
  </tr>
	  <?php

if(!empty($bliss_perk_history)) {
	$id=1;
	foreach($bliss_perk_history as $perk_history) {
		echo "<tr><td>".$id."</td><td>".$perk_history['redeem']."</td><td>".$perk_history['after_tds']."</td><td>".$perk_history['my_bliss_req']."</td><td>".$perk_history['rdate']."</td><td>".$perk_history['redeem_status']."</td></tr>";
		$id++;
	}
} ?>
</table> 
      </div> 
    </div> 
  </div>
</div>




<div id="shopping_voucher_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upgrade request</h4>
      </div>
      <div class="modal-body">
	  
	  <?php if($shopping_voucher_modal=='show') { 
	     echo validation_errors();
	  } ?>
        <form method="post" action="<?php echo base_url();?>admin" class="form row">
               
		<div class="col-sm-12 form-group"><label>E-mail</label> <input type="text" name="email" value="" class="form-control"></div>
		<div class="col-sm-12 form-group"><label>Confirm E-Mail</label> <input type="text" name="c_email" value="" class="form-control"></div>
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input type="checkbox" name="declare" value="1"> I hereby declared that the details above correct to the best of my knowledge and belief. Upgrade process will may take 48 hours.</label></div>
		
		<div class="col-sm-12 text-center"><input type="submit" name="confirm_request" value="Upgrade" class="form-control "></div>
		
		</form>
      </div> 
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


