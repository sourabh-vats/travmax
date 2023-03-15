<div class="row gap-5 mb-5">
    <div class="col-md-5 py-4 px-0">
        <div class="row">
            <div class="col-md-auto border-end" id="hero_total_sales">
                <span class="big_number"><?php echo $total_sales; ?></span>
                <span class="big_number_title">Total Sales</span>
            </div>
            <div class="col" id="hero_total_income">
                <span class="big_number"><?php echo $total_income; ?></span>
                <span class="big_number_title">Total Income</span>
            </div>
        </div>
        <hr>
        <div class="row align-items-center">
            <div class="col">
                <span id="total_partners_number"><i class="bi-people-fill me-2"></i><?php echo $total_partners; ?></span>
            </div>
            <div class="col text-end">
                <a href="/admin/DistributorLevelInformation" class="my_partners_hero_link">MY PARTNERS<i class="bi-arrow-right-circle-fill ms-2"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="row mb-4 gradient_parent">
            <div class="col text-center py-4">
                <h2>MY SALES</h2>
                <span class="box_number_data">50</span>
            </div>
            <div class="col text-center py-4">
                <h2>TEAM SALES</h2>
                <span class="box_number_data">100</span>
            </div>
        </div>
        <div class="row gradient_parent">
            <div class="col text-center py-4">
                <h2>ACTIVE INCOME</h2>
                <span class="box_number_data">50</span>
            </div>
            <div class="col text-center py-4">
                <h2>TEAM INCOME</h2>
                <span class="box_number_data">50</span>
            </div>
        </div>
    </div>
</div>
<div class="row gap-5">
    <div class="col-md-5 grey_bg px-4 py-4">
        <p class="text_1">My Package</p>
        <hr>
        <div class="box_content">
            <p class="text_2">Name: <span class="grey"><?php echo $package_data[0]['name']; ?></p>
            <p class="text_2">Price: <span class="grey">Rs. <?php echo $package_data[0]['mrp']; ?></p>
            <p class="text_2">Offered Price: <span class="grey">Rs. <?php echo $package_data[0]['total']; ?></p>
            <p class="text_2">Payment Plan: <span class="grey"><?php echo $package_information[0]['payment_type']; ?></p>
            <p class="text_2">Amount Paid: <span class="grey">Rs. <?php echo $package_information[0]['amount_paid']; ?></p>
            <p class="text_2">Amount Remaining: <span class="grey">Rs. <?php echo $package_information[0]['amount_remaining']; ?></p>
            <p class="text_2">Installments: <span class="grey">2/11</p>
        </div>
    </div>
    <div class="col-md grey_bg px-4 py-4">
        <p class="text_1">My Income</p>
        <hr>
        <div class="box_content">
            <p class="text_3">Total: <span class="grey"><?php echo $package_data[0]['name']; ?></p>
            <p class="text_3">Pending: <span class="grey">Rs. <?php echo $package_data[0]['mrp']; ?></p>
            <p class="text_3">Approved: <span class="grey">Rs. <?php echo $package_data[0]['total']; ?></p>
            <p class="text_3">Redemmed: <span class="grey"><?php echo $package_information[0]['payment_type']; ?></p>
            <p class="text_3">Amount Paid: <span class="grey">Rs. <?php echo $package_information[0]['amount_paid']; ?></p>
            <p class="text_3">Amount Remaining: <span class="grey">Rs. <?php echo $package_information[0]['amount_remaining']; ?></p>
            <p class="text_3">Installments: <span class="grey">2/11</p>
        </div>
    </div>
</div>