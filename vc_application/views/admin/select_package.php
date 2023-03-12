<h1 class="text-center">Please select a package from the following and continue.</h1>
<div class="row d-flex align-items-center justify-content-center flex-wrap" id="select_package_section">
    <?php foreach ($all_packages as $package) { ?>
        <div class="col-md-4 d-flex justify-content-center p-3">
            <div class="package_card">
                <img class="img-fluid select_package_id" src="/assets/images/<?php echo $package['name']; ?>.jpg" alt="" title="<?php echo $package['id']; ?>">
                <input type="hidden" name="package_information" class="package_information" value='<?php echo json_encode($package); ?>'>
                <p class="package_title"><?php echo $package['name']; ?></p>
                <a href="">Terms And Conditions</a>
            </div>
        </div>
    <?php } ?>
</div>
<div class="row d-none" id="pick_a_plan_section">
    <h1 class="text-center">Pick A Plan</h1>
    <div class="col-md-4 plan_box" id="travnow_plan">
        <h2>Travnow</h2>
        <p>Travel Now</p>
        <p>Pay in Full</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <h2 id="travnow_price">Rs.69900</h2>
    </div>
    <div class="col-md-4 plan_box" id="travlater_plan">
        <h2>Travlater</h2>
        <p>Book Now</p>
        <p>Pay booking amount</p>
        <p>Pay the rest in 90 Days</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <h2 id="travlater_price">Rs.13200</h2>
    </div>
    <div class="col-md-4 plan_box" id="traveasy_plan">
        <h2>Traveasy</h2>
        <p>Book Now</p>
        <p>Pay in Installments</p>
        <p>Pay down payment</p>
        <p>Rest in Installments</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <h2 id="traveasy_price">Rs.9900</h2>
    </div>
    <?php
    $user = $profile[0];
    $attributes = array('class' => 'form');
    echo form_open_multipart(base_url() . 'admin/select_package', $attributes);
    ?>
    <input type="hidden" name="package_id">
    <input type="hidden" name="payment_type">
    <button class="btn btn-lg btn-primary w-100 my-3 d-none" id="book_package_btn" type="submit">Book</button>
    <?php echo form_close(); ?>
</div>