<?php
if($this->session->userdata('is_customer_logged_in')){
    echo("logged in");
}else{
    echo("logged out");
}
?>
<style>
    .topsection {
        min-height: 50vh;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="" style="height:400px;background-size: cover; background-position: center; background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1335&q=80')"></div>
        <p class="display-1 text-center my-3"><?php echo ucfirst($package_name) ?> Package</p>
    </div>
    <div class="col-12">
        <img src="<?php echo base_url(); ?>images/pick_a_plan.jpeg" alt="">
        <div class="bbbbb">
            <div class="four">
                <h1><b>Pay Now </b> </h1>
            </div>
            <div class="main5">
                <p class="New1" href="">Bank Transfer/Deposits</p>
            </div>
            <div class="f1">
                <h1>Bank Details : ERC Max Ventures Pvt. Ltd. <br>
                    YES Bank - Current Account number 001583800007451 <br>
                    IFSC : YESB000015</h1>
            </div>
            <div class="four">
                <h1><b>Complete the payment and share the proof with us on WhatsApp and we will contact you, </b> </h1>
            </div>
        </div>
    </div>
</div>