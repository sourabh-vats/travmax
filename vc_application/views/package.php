<style>
    .topsection {
        min-height: 50vh;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="" style="height:400px;background-size: cover; background-image: url('https://images.unsplash.com/photo-1452421822248-d4c2b47f0c81?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80')"></div>
        <p class="display-1 text-center my-3"><?php echo ucfirst($package_name) ?> Package</p>
    </div>
    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
        <p class="display-2">Buy or Book A Package</p>
        <a class="btn btn-lg btn-primary" href="<?php echo base_url();?>pay/<?php echo ucfirst($package_name) ?>">NEXT</a>
        <!-- <form action="/travmaxholidays/admin/order/add" class="form" id="purchase_package_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="form-group col-sm-4 ">
                    <label>User ID</label>
                    <input type="text" class="form-control" required value="" name="userid">
                </div>
            </div>
            <div class="form-group col-sm-4">
                <label>Product Name</label>
                <input type="text" class="form-control" name="iname[]" required>
            </div>
            <div class="form-group col-sm-3">
                <label>Price</label>
                <input type="number" class="form-control" name="price[]" required>
            </div>
            <div class="form-group col-sm-3">
                <label>Quantity</label>
                <input type="number" class="form-control" name="qty[]" required>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button> &nbsp;
                    <a class="btn btn-primary" href="<?php echo base_url() . 'admin/category'; ?>">Cancel </a>
                </div>
            </div>
        </form> -->
    </div>
    <div class="col-md-6">
        <img src="<?php echo base_url();?>images/packages/<?php echo $package_name; ?>.jpeg" alt="">
    </div>
</div>