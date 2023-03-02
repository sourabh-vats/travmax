<style>
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

  button,
  select {
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

<div class="smry smry4  text-center">
  Dashboard
</div>
<div class="col-sm-12">
  <?php
  $user = $profile[0];
  $total = 0;
  if (!empty($show_direct)) {
    foreach ($show_direct as $row) {

      $total = $total + $row['amount'];
    }
  }
  $cashback = $approved_cashback = $pending_cashback = $redeem_cashback = $moneyback = $approved_moneyback = $pending_moneyback = $redeem_moneyback = $credits = 0;
  if (!empty($incomes)) {
    foreach ($incomes as $inc) {
      if ($inc['type'] == 'Credits') {
        $credits = $credits + $inc['tamount'];
      }
      if ($inc['type'] == 'MoneyBack') {
        if ($inc['status'] == 'Approved') {
          $approved_moneyback = $approved_moneyback + $inc['tamount'];
        }
        if ($inc['status'] == 'Pending') {
          $pending_moneyback = $pending_moneyback + $inc['tamount'];
        }
        if ($inc['status'] == 'Redeem') {
          $redeem_moneyback = $redeem_moneyback + $inc['tamount'];
        }
        $moneyback = $moneyback + $inc['tamount'];
      }
      if ($inc['type'] == 'Cashback') {
        if ($inc['status'] == 'Approved') {
          $approved_cashback = $approved_cashback + $inc['tamount'];
        }
        if ($inc['status'] == 'Pending') {
          $pending_cashback = $pending_cashback + $inc['tamount'];
        }
        if ($inc['status'] == 'Redeem') {
          $redeem_cashback = $redeem_cashback + $inc['tamount'];
        }

        $cashback = $cashback + $inc['tamount'];
      }
    }
  }
  $purchases_count = $purchases_amount = $online_purchase_count = $online_purchase_amount = $utility_purchase_count = $utility_purchase_amount = $service_purchase_count = $service_purchase_amount = $instore_purchase_count = $instore_purchase_amount =  0;
  $micro_purchases_count = $micro_purchases_amount = $micro_online_purchase_count = $micro_online_purchase_amount = $micro_utility_purchase_count = $micro_utility_purchase_amount = $micro_service_purchase_count = $micro_service_purchase_amount = $micro_instore_purchase_count = $micro_instore_purchase_amount =  0;
  $macro_purchases_count = $macro_purchases_amount = $macro_online_purchase_count = $macro_online_purchase_amount = $macro_utility_purchase_count = $macro_utility_purchase_amount = $macro_service_purchase_count = $macro_service_purchase_amount = $macro_instore_purchase_count = $macro_instore_purchase_amount =  0;
  $macro_count = $macro_amount = 0;

  if (!empty($purchases)) {
    foreach ($purchases as $purchase) {
      if ($purchase['type'] == 'Purchase') {
        if ($purchase['order_type'] == 'Online') {
          if ($purchase['role'] == 'Micro') {
            $micro_online_purchase_amount = $micro_online_purchase_amount + $purchase['amount'];
            $micro_online_purchase_count = $micro_online_purchase_count + 1;
          } elseif ($purchase['role'] == 'Macro') {
            $macro_online_purchase_amount = $macro_online_purchase_amount + $purchase['amount'];
            $macro_online_purchase_count = $macro_online_purchase_count + 1;
          }
          $online_purchase_amount = $online_purchase_amount + $purchase['amount'];
          $online_purchase_count = $online_purchase_count + 1;
        }
        if ($purchase['order_type'] == 'Utility') {
          if ($purchase['role'] == 'Micro') {
            $micro_utility_purchase_amount = $micro_utility_purchase_amount + $purchase['amount'];
            $micro_utility_purchase_count = $micro_utility_purchase_count + 1;
          } elseif ($purchase['role'] == 'Macro') {
            $macro_utility_purchase_amount = $macro_utility_purchase_amount + $purchase['amount'];
            $macro_utility_purchase_count = $macro_utility_purchase_count + 1;
          }
          $utility_purchase_amount = $utility_purchase_amount + $purchase['amount'];
          $utility_purchase_count = $utility_purchase_count + 1;
        }
        if ($purchase['order_type'] == 'Instore') {
          if ($purchase['role'] == 'Micro') {
            $micro_service_purchase_amount = $micro_service_purchase_amount + $purchase['amount'];
            $micro_service_purchase_count = $micro_service_purchase_count + 1;
          } elseif ($purchase['role'] == 'Macro') {
            $macro_service_purchase_amount = $macro_service_purchase_amount + $purchase['amount'];
            $macro_service_purchase_count = $macro_service_purchase_count + 1;
          }
          $service_purchase_amount = $service_purchase_amount + $purchase['amount'];
          $instore_purchase_count = $instore_purchase_count + 1;
        }
        if ($purchase['order_type'] == 'Instore') {
          if ($purchase['role'] == 'Micro') {
            $micro_service_purchase_amount = $micro_service_purchase_amount + $purchase['amount'];
            $micro_service_purchase_count = $micro_service_purchase_count + 1;
          } elseif ($purchase['role'] == 'Macro') {
            $macro_service_purchase_amount = $macro_service_purchase_amount + $purchase['amount'];
            $macro_service_purchase_count = $macro_service_purchase_count + 1;
          }
          $service_purchase_amount = $service_purchase_amount + $purchase['amount'];
          $instore_purchase_count = $instore_purchase_count + 1;
        }
        if ($purchase['order_type'] == 'Macro') {
          $macro_purchases_amount = $macro_purchases_amount + $purchase['amount'];
          $macro_purchases_count = $macro_purchases_count + 1;
        }
      }
      if ($purchase['type'] == 'Pack') {
        $macro_amount = $macro_amount + $purchase['amount'];
        $macro_count = $macro_count + 1;
      }
    }
  }
  $purchases_count = $online_purchase_count + $utility_purchase_count + $instore_purchase_count + $macro_purchases_count;
  $purchases_amount = $online_purchase_amount + $utility_purchase_amount + $service_purchase_amount + $macro_purchases_amount;
  $micro_purchases_count = $micro_online_purchase_count + $micro_utility_purchase_count + $micro_instore_purchase_count;
  $micro_purchases_amount = $micro_online_purchase_amount + $micro_utility_purchase_amount + $micro_service_purchase_amount;
  ?>

  <?php
  //flash messages
  if ($this->session->flashdata('flash_message')) {
    if ($this->session->flashdata('flash_message') == 'redeem') {
      echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Account upgrade request sumited successfully. upgrade process will may take 1-2 working days.';
      echo '</div>';
    }
    if ($this->session->flashdata('flash_message') == 'emi_bliss_perks') {
      echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Thank you for shopping with us. We will be shipping your order to you soon.';
      echo '</div>';
    }
    if ($this->session->flashdata('flash_message') == 'emi_payment_error') {
      echo '<div class="alert alert-danger">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Please check your order info or email to admin.';
      echo '</div>';
    }
  }

  //flash messages
  if (!empty($invite_email)) {
    echo '<div class="alert alert-success">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo 'Invitation sent successfully';
    echo '</div>';
  }

  if ($profile[0]['account_name'] == '' || $profile[0]['account_no'] == '' || $profile[0]['aadhar'] == '' || $profile[0]['pancard'] == '') {
    echo '<div class="alert alert-danger">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo 'Please update your profile';
    echo '</div>';
  } elseif ($profile[0]['var_status'] == 'no') {
    echo '<div class="alert alert-danger">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo 'Your profile is under review please wait 2 working days';
    echo '</div>';
  }
  echo validation_errors();
  ?>

  <?php
  //Notification if user hasn't selected or booked any package
  if (!$has_package) {
    echo '<div class="alert alert-danger">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo 'You have not booked any package. Please book a package to activate your account. <a href="/admin/select_package">Click Here</a> to book your package.';
    echo '</div>';
  }
  ?>

</div>
<div class="col-sm-12 right-bar">
  <?php if ($profile[0]['macro'] == 0 && !empty($moneyback) && date('Y-m-d') <= date('Y-m-d', strtotime('+15 days', strtotime($moneyback[0]['rdate'])))) { ?>
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
      var countDownDate = new Date("<?php echo date('Y-m-d', strtotime('+15 days', strtotime($moneyback[0]['rdate']))); ?>").getTime();

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
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
          minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("demo").innerHTML = "EXPIRED";
        }
      }, 1000);
    </script>

  <?php } ?>

  <?php if ($has_package) { ?>
    <section>
      <div class="row">
        <h1 class="tittles">My Package</h1>
      </div>
      <div class="row">
        <div class="gm fst_gm clr1 col-sm-4">
          <div class="pgn">
            <div class="df">
              <p class="card_heading">Name</p>
              <p class="card_data"><?php echo $package_data[0]['name']; ?></p>
            </div>
          </div>
        </div>
        <div class="gm fst_gm clr1 col-sm-4">
          <div class="pgn">
            <div class="df">
              <p class="card_heading">Name</p>
              <p class="card_data"><?php print_r($package_data[0]); ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
  <div class="main-wallet">
    <div class="row">

      <div class="col-md-4 text-center wallet"><a href="<?php echo base_url(); ?>admin/payment">
          <h4>Online Payment</h4>
        </a></div>
      <div class="col-md-4 text-center"><a href="<?php echo base_url(); ?>admin/request-fund">
          <h4>Upload Receipt</h4>
        </a></div>
      <div class="col-md-4 text-center"><a href="<?php echo base_url(); ?>admin/transfer_master">
          <h4>Transfer Moneyback</h4>
      </div>

    </div>
  </div>


  <div class="gm fst_gm clr4 col-sm-4">
    <a href="<?php echo base_url();
              ?>/admin/add_money">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span> Total Amount<big>
              <?php echo $profile[0]['package_amt']; ?></strong></big></span>
        </div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr2 col-sm-4">
    <a href="<?php echo base_url();
              ?>/admin/macro_credits">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span> Booking Amount<big>

              <?php if (!empty($purchases[0]['amount'])) {
                echo $purchases[0]['amount'];
              } else {
                echo 0;
              } ?>
              <?php echo $purchases[0]['amount'] + 0;
              ?></strong></big></span>
        </div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr1 col-sm-4">
    <a href="<?php echo base_url();
              ?>/admin/my_wallet">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span> Wallet Balance <big>
              <?php echo $profile[0]['income_wallet']; ?></strong></big></span>
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
        <div class="df adds_mny"><span> My Cashback <big>
              <?php echo $pending_cashback + $redeem_cashback + $approved_cashback; ?></strong></big> </span></div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr1 col-sm-4">
    <a href="<?php echo base_url(); ?>/admin/my_wallet">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span>My Moneyback<big>
              <?php echo $pending_moneyback + $approved_moneyback; ?></strong></big></span>
        </div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr2 col-sm-4">
    <a href="<?php echo base_url(); ?>/admin/income/show">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span>My Incoming <big> <?php echo $credits; ?></big> </span>
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
        <div class="df adds_mny"><span> My Trav Cash <big>
              <?php echo $profile[0]['income_wallet'];
              ?></strong></big></span></div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr1 col-sm-4">
    <a href="<?php echo base_url(); ?>/admin/my_wallet">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span>My Travoucher<big>
              <?php echo $profile[0]['income_wallet'];
              ?></strong></big></span>
        </div>
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
          <span>My Travmiles <big> <?php echo $credits; ?></big> </span>
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
          <span>My Installments <big> <?php echo $credits;
                                      ?></big> </span>

        </div>
      </div>

    </a>
  </div>


  <h1 class="tittles">My total Earnings</h1>

  <div class="gm fst_gm clr1 col-sm-4">
    <a href="<?php echo base_url(); ?>/admin/my_wallet">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df">
          <span>My Purchases<big>
              0 </big></span>
        </div>
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
          <span> My Partners <big> <?php echo $credits; ?></big> </span>
        </div>
      </div>
    </a>
  </div>







  <div class="gm fst_gm clr3 col-sm-4">
    <a href="javascript:;">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>
        <div class="df"><span>my Total Earnings<big> <i class="fa fa-inr"></i> <?php echo array_sum(array_column($incomes, 'tamount')) - $credits; ?></big> </span></div>
      </div>
    </a>
  </div>


  <div class="gm fst_gm clr4 col-sm-4">
    <a href="<?php echo base_url(); ?>admin/Payment_request/Cashback">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>
        <div class="df"><span>My Cashback<big> <i class="fa fa-inr"></i> <?php echo $user['cash_wallet']; ?></big> </span></div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr5 col-sm-4">
    <a href="<?php echo base_url(); ?>admin/Payment_request/MoneyBack">
      <div class="pgn">

        <div class="imggg">
          <img src="images/img12.jpg">
        </div>

        <div class="df"><span>My Moneyback<big> <i class="fa fa-inr"></i> <?php echo $user['money_wallet']; ?></big> </span></div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm clr6 col-sm-4">
    <a href="javascript:;">
      <div class="pgn">
        <div class="imggg">
          <img src="images/img12.jpg">
        </div>
        <div class="df"><span>My Business Income<big> <i class="fa fa-inr"></i> 0</big> </span></div>
      </div>
    </a>
  </div>



</div>

<div class="col-sm-12">
  <ul class="main-div">
    <li><button class="main-inner-bouuon active" id="my-cashback" class="intro" onclick="openCity(event, 'London')">
        <div class="df"><span>My Cashback <br><big> <i class="fa fa-inr"></i> <?php echo $pending_cashback + $redeem_cashback + $approved_cashback; ?></big> </span></div>
      </button></li>
    <li> <button class="main-inner-bouuon" id="moneyback" onclick="openCity(event, 'Paris')">
        <div class="df"><span>My Moneyback <br><big> <i class="fa fa-inr"></i> <?php echo $pending_moneyback + $approved_moneyback; ?></big> </span></div>
      </button>
    </li>
    <li><button class="main-inner-bouuon" id="my-income" onclick="openCity(event, 'Tokyo')">
        <div class="df"><span>My Business Income <br><big> <i class="fa fa-inr"></i> 0</big> </span></div>
      </button></li>
  </ul>
  <div id="London" class="tabcontent">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="tittles">My Cashback</h1>
      </div>
      <div class="col-sm-4 bottm_bordr">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Amount of Purchases</p>
          <big> <i class="fa fa-inr"></i> <?php echo $purchases_amount; ?></big>
          <p class="mt-5 ammount-txt">This amount is the approved cashback after verification</p>
        </div>
      </div>
      <div class="col-sm-4 bottm_bordr">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Cashback Earned</p>
          <big> <i class="fa fa-inr"></i> <?php echo $approved_cashback; ?></big>
          <p class="mt-5 ammount-txt">This amount is the approved cashback after verification</p>
        </div>
      </div>
      <div class="col-sm-4 bottm_bordr1">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Pending Cashback</p>
          <big> <i class="fa fa-inr"></i> <?php echo $pending_cashback; ?></big>
          <p class="mt-5 ammount-txt">This amount is the pending cashback yet to be verified</p>
        </div>
      </div>
      <div class="col-sm-4 bottm_bordr2">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Approved Cashback</p>
          <big> <i class="fa fa-inr"></i> <?php echo $approved_cashback; ?></big>
          <p class="mt-5 ammount-txt">This amount is the approved cashback after verification</p>
        </div>
      </div>

      <div class="col-sm-4 bottm_bordr2">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Total Redeemed Cashback</p>
          <big> <i class="fa fa-inr"></i> <?php echo $redeem_cashback; ?></big>
          <p class="mt-5 ammount-txt">This is the amount of the cashback transferred to me</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-5 main-inner-ro" id="show-inner">
    <div class="col-sm-12">
      <h1 class="titles2">My Moneyback</h1>
    </div>
    <div class="col-sm-4 bottm_bordr">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Amount of Purchases</p>
        <big> <i class="fa fa-inr"></i> <?php echo $purchases_amount; ?></big>
        <p class="mt-5 ammount-txt">This amount is the total of all my purchases</p>
      </div>
    </div>
    <div class="col-sm-4 bottm_bordr">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Moneyback Eligibility<br>(111%)</p>
        <big> <i class="fa fa-inr"></i> <?php echo $profile[0]['eligibility']; ?></big>
        <p class="mt-5 ammount-txt">This is the total amount of moneyback I can earn</p>
      </div>
    </div>

    <div class="col-sm-4 bottm_bordr1">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Reedem Moneyback from<br> Moneyback Eligibility</p>
        <big> <i class="fa fa-inr"></i> <?php echo $approved_moneyback; ?></big>
        <p class="mt-5 ammount-txt">This is the total amount of moneyback I can earn</p>
      </div>
    </div>

    <div class="col-sm-4 bottm_bordr">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Pending from Moneyback Eligibility</p>
        <big> <i class="fa fa-inr"></i> <?php $pending_money = $profile[0]['eligibility'] - $approved_moneyback;
                                        if ($pending_money >= 0) {
                                          echo $pending_money;
                                        } else {
                                          echo 0;
                                        } ?></big>
        <p class="mt-5 ammount-txt">This amount is the total amount which has been approved. I can take it to bank</p>
      </div>
    </div>
    <div class="col-sm-4 bottm_bordr">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Pending Moneyback</p>
        <big> <i class="fa fa-inr"></i> <?php echo $pending_moneyback; ?></big>
        <p class="mt-5 ammount-txt">This is the amount waiting for appoval</p>
      </div>
    </div>
    <div class="col-sm-4 bottm_bordr1">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Approved Moneyback</p>
        <big> <i class="fa fa-inr"></i> <?php echo $approved_moneyback; ?></big>
        <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p>
      </div>
    </div>
    <div class="col-sm-4 bottm_bordr2">
      <div class="my-cashback-inner-first">
        <p class="p-inner">Total MB (Pending + Approved + Redeemed MB)</p>
        <big> <i class="fa fa-inr"></i> <?php echo $moneyback; ?></big>
        <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p>
      </div>
    </div>
  </div>


  <div id="my-income-inner" class="tabcontent" style="display:none">

    <div class="row">
      <div class="col-sm-12">
        <h1 class="title3">My Business Income</h1>
      </div>
      <div class="col-sm-4 bottm_bordr2">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Approved Income</p>
          <big> <i class="fa fa-inr"></i> 0</big>
          <p class="mt-5 ammount-txt">This amount is the approved cashback after verification</p>
        </div>
      </div>
      <div class="col-sm-4 bottm_bordr2">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Pending Income</p>
          <big> <i class="fa fa-inr"></i> 0</big>
          <p class="mt-5 ammount-txt">This amount is the pending cashback yet to be verified</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="my-cashback-inner-first">
          <p class="p-inner">Total Redeemed Income</p>
          <big> <i class="fa fa-inr"></i> 0</big>
          <p class="mt-5 ammount-txt">This is the amount of the cashback transferred to me</p>
        </div>
      </div>
    </div>
  </div>

  <div class="co">
    <div class="row">
      <div class="col-sm-12">
        <div class="db-nner">
          <h6>Total Redeemed Earnings ( Redeemed Cashback + Redeemed Moneyback + Redeemed Earnings ) : <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $redeem_moneyback + $redeem_cashback; ?></h6>
        </div>
      </div>
    </div>
  </div>
  <div class="co-middel">
    <div class="row">
      <div class="col-sm-12">
        <ul class="inner-content">
          <li>
            <div class="db-">
              <img src="<?php echo base_url(); ?>images/mypurchases.png">
              <h2>My Purchases</h2> <br>
            </div>
            <div> <span>These are all my purchases</span></div>
          </li>
          <li class="flex-end"><a href="#"></a>
            <button class="" id="purchases-view">View <i class="fa fa-angle-right" aria-hidden="true"></i></button>
          </li>
        </ul>
        <div id="purchases-inner">
          <div class="row mt-5 main-inner-ro">
            <div class="col-sm-4 bottm_bordr">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Amount of Purchases</p>
                <big><i class="fa fa-inr"></i> <?php echo $purchases_amount; ?></big>
                <p class="mt-5 ammount-txt">This is the amount of all my purchases</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr">
              <div class="my-cashback-inner-first">
                <p class="p-inner">No. of Purchases</p>
                <big> <?php echo $purchases_count; ?></big>
                <p class="mt-5 ammount-txt">These are total number of my Online purchases</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr1">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Online Purchases</p>
                <big> <i class="fa fa-inr"></i> <?php echo $online_purchase_amount; ?></big>
                <p class="mt-5 ammount-txt">These are total number of my Online purchases</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 bottm_bordr2">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Micro Purchases</p>
                <big> <i class="fa fa-inr"></i> <?php echo $micro_purchases_amount; ?></big>
                <p class="mt-5 ammount-txt">This is the amount waiting for appoval</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr2">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Macro Purchases</p>
                <big> <i class="fa fa-inr"></i> <?php echo $macro_purchases_amount; ?></big>
                <p class="mt-5 ammount-txt">Macro Purchases</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Mega Purchases</p>
                <big> <i class="fa fa-inr"></i> 0.00</big>
                <p class="mt-5 ammount-txt">This amount is the moneyback transferred to me</p>
              </div>
            </div>
            <div class="row btns">
              <div class="col-sm-4">
                <div class="inner-btn"><a href="<?php echo base_url(); ?>admin/uploadreceipts"><img src="<?php echo base_url(); ?>images/instorecancellation.png">Untraced Purchase</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div>
              </div>
              <div class="col-sm-4">
                <div class="inner-btn"><a href="<?php echo base_url(); ?>admin/uploadreceipts/add"><img src="<?php echo base_url(); ?>images/instorecancellation.png">Upload Purchase</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div>
              </div>
              <div class="col-sm-4">
                <div class="inner-btn"><a href="#"><img src="<?php echo base_url(); ?>images/instorecancellation.png">Recent Purchases</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div>
              </div>
              <div class="col-sm-4 mt-5" id="btn-true">
                <div class="inner-btn"><a href="#"><img src="<?php echo base_url(); ?>images/instorecancellation.png">Online Cancellations</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div>
              </div>
              <div class="col-sm-4" id="btn-true">
                <div class="inner-btn"><a href="#"><img src="<?php echo base_url(); ?>images/instorecancellation.png">Instore Cancellations</a><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></div>
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
          <li>
            <div class="db-">
              <img src="<?php echo base_url(); ?>images/mypartners.png">
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
            <div class="col-sm-4 bottm_bordr">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Total Partners</p>
                <big> <?php echo count($total_partner); ?></big>
                <p class="mt-5 ammount-txt">This is the total number of my partners</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Active Partners</p>
                <big> <?php if (array_key_exists(1, $team_consume)) {
                        echo $team_consume[1];
                      } else {
                        echo 0;
                      } ?></big>
                <p class="mt-5 ammount-txt">These are my partners who have made purchases</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr1">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Inactive Partners</p>
                <big></i><?php if (array_key_exists(0, $team_consume)) {
                            echo $team_consume[0];
                          } else {
                            echo 0;
                          } ?></big>
                <p class="mt-5 ammount-txt">These partners are yet to make a purchase</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 bottm_bordr2">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Macro Partners</p>
                <big> <?php if (array_key_exists(33, $macro_partner)) {
                        echo $macro_partner[33];
                      } else {
                        echo 0;
                      } ?></big>
                <p class="mt-5 ammount-txt">These are partners in my circles who have upgraded to Macro Partners</p>
              </div>
            </div>
            <div class="col-sm-4 bottm_bordr2">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Mega Partners</p>
                <big></i> 0</big>
                <p class="mt-5 ammount-txt">These are partners in my circles who have upgraded to Mega Partners</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="my-cashback-inner-first">
                <p class="p-inner">Total Redeemed Moneyback</p>
                <big> <i class="fa fa-inr"></i> <?php echo $moneyback; ?></big>
                <p class="mt-5 ammount-txt">This amount is moneyback transferred to me</p>
              </div>
            </div>
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
  if (!empty($myfriends)) {
    $total_friend = count($myfriends);
    foreach ($myfriends as $friend) {
      if ($friend['level'] == '1') {
        $independent = $independent + 1;
        $referrals .= '<tr><td>' . $friend['name'] . '</td><td>' . $friend['friends'] . '</td></tr>';
      }
      if ($friend['level'] > $stage) {
        $stage = $friend['level'];
      }
    }
  }
  ?>
  <div class="sd sdfg  text-center">
    <h3>Sales Associate</h3>
    <div class="gm fst_gm col-sm-3">
      <div data-toggle="modal" data-target="#referralModal">
        <div class="pgn">
          <img src="images/img20.jpg">
          <div class="df">
            <span>Independent <big>

                <?php echo $independent; ?></big> </span>
          </div>
        </div>
      </div>
    </div>
    <div id="referralModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Independent Sales Associate</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Friends</th>
              </tr>
              <?php if ($referrals == '') {
                echo '<tr><td colspan="2">No friends.</td></tr>';
              } else {
                echo $referrals;
              } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="gm fst_gm col-sm-3">
      <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
        <div class="pgn"><img src="images/img6.jpg">
          <div class="df"><span>Total <big><?php echo $total_friend; ?></strong></big> </span></div>
          <div class="hover_opn"><span>
              This is the total of all
              my purchases </br><button>Enter</button></span>
          </div>
        </div>
      </a>
    </div>
    <div class="gm fst_gm col-sm-3">
      <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
        <div class="pgn"><img src="images/img8.jpg">
          <div class="df"><span>Stage <big><?php echo $stage; ?></strong></big> </span></div>
          <div class="hover_opn"><span>
              This is the total of all
              my purchases </br><button>Enter</button></span>
          </div>
        </div>
      </a>
    </div>
    <div class="gm fst_gm col-sm-3">
      <a data-target="#historyModel" data-toggle="modal" href="javascript:void(0)">
        <div class="pgn"><img src="images/goodness-score.jpg">
          <div class="df"><span>Achievers <big><?php echo $achivers; ?></strong></big> </span></div>
          <div class="hover_opn"><span>
              This is the total of all
              my purchases </br><button>Enter</button></span>
          </div>
        </div>
      </a>
    </div>
  </div>


</div>


<div class="sd sdfg  text-center" id="my-transaction">

  <div class="gm fst_gm col-sm-3">
    <a href="<?php echo base_url(); ?>admin/directs">
      <div class="pgn">
        <img src="images/img22.jpg">
        <div class="df">
          <span>My Referrals <big>
              <?php echo $independent; ?></strong></big> </span>
        </div>
        <div class="hover_opn"><span>
            This is the total of all
            my purchases </br><button>Enter</button></span>
        </div>
      </div>
    </a>
  </div>



  <div class="gm fst_gm col-sm-3">
    <a href="<?php echo base_url(); ?>admin/income/show">
      <div class="pgn"><img src="images/img12.jpg">
        <div class="df"><span>Referral Income <big><i class="fa fa-inr"></i><?php echo $total; ?></big> </span></div>
      </div>
    </a>
  </div>
  <div class="gm fst_gm col-sm-3">
    <a href="<?php echo base_url(); ?>feedback">
      <div class="pgn"><img src="images/img21.jpg">
        <div class="df">
          <span>Feedback</span>
        </div>
      </div>
    </a>
  </div>

  <div class="gm fst_gm col-sm-3">
    <a href="<?php echo base_url(); ?>complaint">
      <div class="pgn"><img src="images/img19.jpg">
        <div class="df">
          <span>Complaint</span>
        </div>
      </div>
    </a>
  </div>


</div>
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

          if (!empty($bliss_perk_history)) {
            $id = 1;
            foreach ($bliss_perk_history as $perk_history) {
              echo "<tr><td>" . $id . "</td><td>" . $perk_history['redeem'] . "</td><td>" . $perk_history['after_tds'] . "</td><td>" . $perk_history['my_bliss_req'] . "</td><td>" . $perk_history['rdate'] . "</td><td>" . $perk_history['redeem_status'] . "</td></tr>";
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

        <?php if ($shopping_voucher_modal == 'show') {
          echo validation_errors();
        } ?>
        <form method="post" action="<?php echo base_url(); ?>admin" class="form row">

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
    (function() {
      'use strict';
      document.body.addEventListener('click', copy, true);

      function copy(e) {
        var
          t = e.target,
          c = t.dataset.copytarget,
          inp = (c ? document.querySelector(c) : null);
        if (inp && inp.select) {
          inp.select();
          try {
            document.execCommand('copy');
            inp.blur();
            t.classList.add('copied');
            setTimeout(function() {
              t.classList.remove('copied');
            }, 1500);
          } catch (err) {
            alert('please press Ctrl/Cmd+C to copy');
          }
        }
      }
    })();



    jQuery('#redeem').keyup(function() {
      var redeem = jQuery("#redeem").val();
      var balance = jQuery("#balance").val();
      var cash = parseFloat(balance - redeem);
      <?php if ($user['pancard'] == '') { ?>
        var bliss = parseFloat(redeem * 0.20);
      <?php } else { ?>
        var bliss = parseFloat(redeem * 0.05);
      <?php } ?>

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
  $(document).ready(function() {
    $("#moneyback").click(function() {
      $("#show-inner").show();
    });
    $("#my-cashback").click(function() {
      $("#show-inner").hide();
    });
    $("#my-income").click(function() {
      $("#my-income-inner").show();
    });
    $("#my-income").click(function() {
      $("#show-inner").hide();
    });
  });
</script>


<script>
  $(document).ready(function() {
    $("#partners-view").click(function() {
      $("#partners-inner").toggle();
    });
    $("#purchases-view").click(function() {
      $("#purchases-inner").toggle();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $("#moneyback").click(function() {
      $("#moneyback").addClass("main-inner-bouuon active");
    });
    $("#moneyback").click(function() {
      $("#my-cashback").removeClass("active");
    });
    $("#my-cashback").click(function() {
      $("#moneyback").removeClass("active");
    });
    $("#my-income").click(function() {
      $("#moneyback").removeClass("active");
    });
    $("#my-income").click(function() {
      $("#my-income").addClass("active");
    });
    $("#moneyback").click(function() {
      $("#my-income").removeClass("active");
    });
    $("#my-cashback").click(function() {
      $("#my-income").removeClass("active");
    });
  });
</script>