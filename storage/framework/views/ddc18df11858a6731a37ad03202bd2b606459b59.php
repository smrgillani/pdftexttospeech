

      <tr>
                        

        <td><?php echo e($package->title); ?></td>

        <td><?php echo e($package->sku); ?></td>

        <td><?php echo e($package->price); ?></td>

        <td>
          <div class="d-flex">

              <!--   <a  class="btn themeBtn editPackage"  packageID="<?php echo e($package->id); ?>" data-title="<?php echo e($package->title); ?>" data-description="<?php echo e($package->description); ?>" data-price="<?php echo e($package->price); ?>" data-rebill-price="<?php echo e($package->rebill_price); ?>" data-rebill-commission="<?php echo e($package->rebill_commission); ?>" data-sku="<?php echo e($package->sku); ?>">Edit</a> -->
            <a href='#' class="mr-4 deletebtn" id="deletepackage" packageID="<?php echo e($package->id); ?>"> <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete"></a>
          </div>
        </td>
      </tr><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/ajax/package.blade.php ENDPATH**/ ?>