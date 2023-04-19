<div class="row" id="wrapper">
    <div id="content_box">
        <p class="text_1">
            <span class="heading_1">Maldives</span><br>
            <span>Singapore, Malaysia</span>
            <span>7 Nights 3 Days</span>
        </p>
        <br>
        <p>
            Price: Rs. 1,489,324
            <span class="price_below_info">+ GST 5% and TCS 5%</span>
        </p>
        <p>
            Price: Rs. 1,489,324
            <span class="price_below_info">+ GST 5% and TCS 5%</span>
        </p>
        <br>
    </div>
    <p>
    Inclusions: Ex Delhi <br>
    Flight, Hotels, Transfers, Breakfast, Sightseeing
    </p>
    <p >Terms & Conditions</p>
    <?php
    $user = $profile[0];
    $attributes = array('class' => 'form');
    echo form_open_multipart(base_url() . 'admin/select_package', $attributes);
    ?>
    <input type="hidden" name="package_id" value="<?php echo $package_data[0]["id"];?>">
    <input type="hidden" name="payment_type">
    <button class="btn btn-lg btn-primary my-3" id="book_package_btn" type="submit" disabled>Book</button>
    <?php echo form_close(); ?>
</div>