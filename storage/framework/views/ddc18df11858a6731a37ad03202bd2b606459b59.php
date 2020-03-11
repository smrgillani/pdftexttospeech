<li>
    <div style='margin:10px' class="card">
        <h5 style="color: black" class="card-header"><?php echo e($package->title); ?></h5>
        <div class="card-body">
            <p style="color: black" class="card-text"><?php echo e($package->description); ?></p>
            <p>
                <h5 style="color: black; float: right" class="card-title">$<?php echo e($package->price); ?> /Month</h5></p>
            <!-- <a href='<?php echo e(route("UpdatePackage")); ?>/<?php echo e($package->id); ?>' class="btn themeBtn" id="updatepackage" packageID="<?php echo e($package->id); ?>">Update</a> -->
            <a href='#' class="btn themeBtn" id="deletepackage" packageID="<?php echo e($package->id); ?>">Delete</a>
        </div>
    </div>
</li><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/ajax/package.blade.php ENDPATH**/ ?>