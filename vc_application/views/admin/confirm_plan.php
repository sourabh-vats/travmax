<?php
$package = $package_data[0];
?>
<div class="row" id="wrapper">
    <div id="content_box">
        <p class="text_1">
            <span>Youh've selected</span>
            <span class="heading_1"><?php echo $package["name"]; ?></span><br>
            <span>7 Nights 3 Days</span>
            <br>
            <span>The Plan you have selected is <span class="heading_1"><?php echo $_GET["plan"]; ?></span></span>
            <br>
            <span>You need to make a payment of Rs <span class="heading_1"><?php echo $payment_amount; ?></span></span>
        </p>
        <br>
    </div>
    <p>
        Inclusions: Ex Delhi <br>
        Flight, Hotels, Transfers, Breakfast, Sightseeing
    </p>
    <p>Terms & Conditions</p>
    <?php
    $user = $profile[0];
    $attributes = array('class' => 'form');
    echo form_open_multipart(base_url() . 'admin/select_package', $attributes);
    ?>
    <input type="hidden" name="package_id" value="<?php echo $package["id"]; ?>">
    <input type="hidden" name="payment_type" value="<?php echo $_GET["plan"]; ?>">
    <button class="btn btn-lg btn-primary my-3" id="book_package_btn" type="submit" disabled>Book</button>
    <?php echo form_close(); ?>
</div>