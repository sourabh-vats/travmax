<h1 class="text-center">Please select a package from the following and continue.</h1>
<div class="row d-flex align-items-center justify-content-center flex-wrap">
    <?php foreach ($all_packages as $package) { ?>
        <div class="col-md-4 d-flex justify-content-center p-3">
            <img class="img-fluid" src="/assets/images/<?php echo $package['name'] ?>.jpg" alt="">
        </div>
    <?php } ?>
</div>