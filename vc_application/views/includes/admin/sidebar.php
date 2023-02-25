<?php
$user = $profile[0];
$full_name = $user['f_name'] . " " . $user['l_name'];
echo '<pre>';
print_r($user);
echo '</pre>';
?>

<style>
    .sd h3 {
        font-size: 40px;
        width: 100%;
        text-align: center;
        background: #E0E0E0;

        font-family: 'proxima_novasemibold';
        color: #414042;
        padding: 10px 0;
        clear: both;
        margin-bottom: 15px;
        font-size: 36px;
    }

    .h3,
    h3 {
        font-size: 24px;
    }

    .h1,
    .h2,
    .h3,
    h1,
    h2,
    h3 {
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .prfl {
        background: #e6e6e6;
    }

    * {
        margin: 0;
        padding: 0px;
    }

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .prfl li.atv,
    .prfl li:hover {
        background: #999;
        color: #fff;
        border-left: 4px solid #3baad9;
    }

    .prfl li {
        border-left: 4px solid #ccc;
    }

    .prfl li {
        border-top: 2px solid #fff;
    }

    * {
        margin: 0;
        padding: 0px;
    }

    .prfl li.atv a,
    .prfl li a:hover {
        color: #fff;
    }

    .prfl li.atv a,
    .prfl li a:hover {
        color: #fff;
    }

    #show {
        padding: 0;
    }

    .fileinput .thumbnail {
        overflow: hidden;
        display: inline-block;
        margin-bottom: 5px;
        vertical-align: middle;
        text-align: center;
    }

    .bult {
        position: relative;
    }

    .thumbnail {
        display: block;
        padding: 4px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-transition: border .2s ease-in-out;
        -o-transition: border .2s ease-in-out;
        transition: border .2s ease-in-out;
    }

    #show img {
        width: 100%;
        height: 100%;
    }

    .fileinput .thumbnail>img {
        max-height: 100%;
    }

    img.profileimg {
        width: auto;
        margin-left: 0;
    }

    .thumbnail>img,
    .thumbnail a>img {
        margin-right: auto;
        margin-left: auto;
    }

    .img-responsive,
    .thumbnail>img,
    .thumbnail a>img,
    .carousel-inner>.item>img,
    .carousel-inner>.item>a>img {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .thumbnail>img {
        margin-right: auto;
        margin-left: auto;
    }

    .thumbnail>img {
        display: block;
        height: auto;
        max-width: 100%;
    }

    img.admin-db {
        height: 23px;
    }
</style>

<div class="col-sm-2 left-bar">
    <div class="col-sm-12  col-xs-10 pro-pic smryy">
        <div class="user_name text-center ">
            <div id="show" class="fileinput-preview thumbnail bult" style="">
                <img src="/images/avatar.png">
            </div>
            <div class="col-sm-12  protext text-center">
                <h3><?php echo $full_name; ?></h3>
            </div>
            <div class="col-sm-12 smg text-center">
                <h5>Unique ID: <?php echo $this->session->userdata('bliss_id'); ?></h5>
            </div>
        </div>
    </div>

    <div class="list-right col-xs-2">
        <div class="prfl">
            <nav role="navigation" class="navbar navbar-default">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <?php $store = $this->uri->segment(2); ?>
                        <?php if ($user['franchisee'] > 0 && 1 == 2) { ?>
                            <li class="home atv"> <a href="<?php echo base_url(); ?>admin/franchisee"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/profile"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/password"><i class="fa fa-key"></i> Update Password</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                        <?php } else { ?>


                            <li <?php if ($store == '') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Home </a></li>
                            <li <?php if ($store == 'profile') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/profile"><i class="fa fa-file-o" aria-hidden="true"></i> Personal Details</a></li>
                            <li <?php if ($store == 'kyc') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/kyc"><i class="fa fa-university" aria-hidden="true"></i> Payment Details</a></li>

                            <!-- <li><a href="<?php echo base_url(); ?>admin/add_member"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Add Member's </a></li>
                            <li><a href="<?php echo base_url(); ?>admin/member"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> My Member's </a></li> -->

                            <li <?php if ($store == 'upgrade_account') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/upgrade_user"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Upgrade Account</a></li>
                            <!-- <li><a href="<?php echo base_url(); ?>admin/become_mega"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Become Mega</a></li> -->
                            <li><a href="<?php echo base_url(); ?>invite_friend"><i class="fa fa-share-alt" aria-hidden="true"></i> Invite Friends</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/installments"><i class="fa fa-share-alt" aria-hidden="true"></i> Installments</a></li>
                            <!--<li><a href="<?php echo base_url(); ?>admin/password"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a></li>-->
                            <li><a href="<?php echo base_url(); ?>admin/uploadreceipts"><i class="fa fa-safari" aria-hidden="true"></i> Upload Payment Proof</a></li>
                            <li <?php if ($store == 'DistributorLevelInformation') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/DistributorLevelInformation"><i class="fa fa-safari" aria-hidden="true"></i> My Circle Information</a></li>
                            <li <?php if ($store == 'activity_log') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/activity_log"><i class="fa fa-address-card-o" aria-hidden="true"></i> Activity log</a></li>
                            <li <?php if ($store == 'wallet_history') {
                                    echo 'class="home atv"';
                                } ?>><a href="<?php echo base_url(); ?>admin/wallet_history"><i class="fa fa-file" aria-hidden="true"></i> Wallet History</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/kyc"><i class="fa fa-cog" aria-hidden="true"></i> Settings </a></li>
                            <li><a href="<?php echo base_url(); ?>terms_of_use"><i class="fa fa-file" aria-hidden="true"></i> Terms and Conditions</a></li>
                            <li><a href="<?php echo base_url(); ?>feedback"><i class="fa fa-comment" aria-hidden="true"></i> Give Us Feedback</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                            <!--<li><a href="<?php echo base_url(); ?>admin/kyc"><i class="fa fa-address-card-o" aria-hidden="true"></i> Update Kyc</a></li>-->
                        <?php } ?>

                    </ul>
                </div>
            </nav>
        </div>

    </div>
</div>


<!--side bar close -->