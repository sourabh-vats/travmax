<h1>This is select package</h1>
<div class="row d-flex align-items-center justify-content-center flex-wrap gap-3">
    <?php foreach ($all_packages as $package) { ?>
        <div class="col-md-4 d-flex justify-content-center">
            <img class="img-fluid" src="/assets/images/<?php echo $package['name'] ?>.jpg" alt="">
        </div>
    <?php } ?>
</div>