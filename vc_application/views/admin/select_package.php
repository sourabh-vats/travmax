<div class="row d-flex align-items-center justify-content-center flex-wrap" id="select_package_section">
    <h1 class="text-center">Please select a package from the following and continue.</h1>
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
    <h1 class="text-center">You have selected <span id="pick_a_plan_selected_package_name"></span> package. Please select a payment plan.</h1>
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
    <div class="card-group">
        <div class="card plan_box" id="travnow_plan">
            <div class="card-body">
                <h5 class="card-title">Travnow</h5>
                <p>Travel Now</p>
                <p>Pay in Full</p>
                <p>Get Franchise</p>
                <p>Earn Free Holidays</p>
            </div>
            <div class="card-footer">
                <h2 id="travnow_price">Rs.69900</h2>
            </div>
        </div>
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
            </div>
        </div>
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