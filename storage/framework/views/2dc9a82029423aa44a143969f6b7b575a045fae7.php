<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Orders
                     </h3>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Membership</th>
                            <th>User</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr>
                            <td><?php echo e($order->membership->package->title); ?></td>

                            <td><a href="<?php echo e(route('user.index')); ?>"><?php echo e($order->user->name); ?></a></td>



                            <td>
                              <div class="d-flex">

                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" >
                                  <img src="assets/img/edit.png" width="" data-toggle="tooltip" title="Edit">
                                </a>
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="<?php echo e($order->id); ?>">
                                  <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete">
                                </a>

                              </div>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                          <td colspan="6" align="center">No, Orders Found</td>
                          </tr>
                           <?php endif; ?>

                        </tbody>
                      </table>
                      </div>
                  </div>
               </div>
            </div>
                 <!-- Edit Membership Model -->

      <div class="modal fade" id="editMembership">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Edit Membership</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="assets/img/close.png">
              </button>
            </div>

            <!-- Modal body -->
            <form>
            <input type="hidden" name="MembershipID" value="" id="MembershipID">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                               <label>Name</label>
                               <input type="text" id="editname" name="name" placeholder="Enter Membership Name" class="form-control" required>
                              </div>

               

                </div>
              </div>
            </div>
          </form>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a class="btn greenBtn mr-2" id="membershipUpdate">Save</a>
            </div>

          </div>
        </div>
      </div>

      <!-- End Edit Membership Model -->




<!-- Alert Message Model -->
      <div class="modal fade" id="alertMessage">
        <div class="modal-dialog modal-md">
          <div class="modal-content">



            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Message</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label id="message"></label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
<!-- End Alert Message Model -->


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>



<script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
    <script type="text/javascript">
   $(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

  
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/AudioBotClickBank/audiobot/resources/views/orders/index.blade.php ENDPATH**/ ?>