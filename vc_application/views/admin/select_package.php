<h1 class="text-center">Please select a package from the following and continue.</h1>
<div class="row d-flex align-items-center justify-content-center flex-wrap">
    <?php foreach ($all_packages as $package) { ?>
        <div class="col-md-4 d-flex justify-content-center p-3">
            <img class="img-fluid select_package_id" src="/assets/images/<?php echo $package['name']; ?>.jpg" alt="" title="<?php echo $package['id']; ?>">
            <input type="hidden" name="package_information" class="package_information" value='<?php echo json_encode($package); ?>'>
        </div>
    <?php } ?>
</div>
<div class="row d-none" id="pick_a_plan_section">
    <h1 class="text-center">Pick A Plan</h1>
    <div class="col-md-4">
        <h2>Travnow</h2>
        <p>Travel Now</p>
        <p>Pay in Full</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <p>Get Marco Partnership</p>
        <h2 id="travnow_price">Rs.69900</h2>
    </div>
    <div class="col-md-4">
        <h2>Travnow</h2>
        <p>Travel Now</p>
        <p>Pay in Full</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <p>Get Marco Partnership</p>
        <h2>Rs.69900</h2>
    </div>
    <div class="col-md-4">
        <h2>Travnow</h2>
        <p>Travel Now</p>
        <p>Pay in Full</p>
        <p>Get Franchise</p>
        <p>Earn Free Holidays</p>
        <p>Get Marco Partnership</p>
        <h2>Rs.69900</h2>
    </div>
    <?php echo form_open_multipart(base_url() . 'admin/profile', $attributes); ?>
    <button class="btn btn-lg btn-primary">Book</button>
</div>