<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Subscription
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
                            <th>Price</th>
                            <?php if(auth()->user()->isAdmin): ?>
                            <th>Operations</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo e($order->membership->package->title); ?></td>

                            <td><a href="<?php echo e(route('user.index')); ?>"><?php echo e($order->user->name); ?></a></td>
                            <td><a href="<?php echo e(route('user.index')); ?>">$ <?php echo e($order->membership->package->price); ?></a></td>
                            
                            <td>
                              <div class="d-flex">

                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMebm">
                                  <img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit">
                                </a>
                                
                                <?php if(auth()->user()->isAdmin): ?>
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="<?php echo e($order->id); ?>">
                                  <img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete">
                                </a>
                                <?php endif; ?>

                              </div>
                            </td>
                            
                          </tr>
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
                <img src="<?php echo e(asset('assets/img/Close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <form id="editMembershipForm">
              <?php echo csrf_field(); ?>
              <?php echo method_field('PUT'); ?>
            <input type="hidden" name="receipt" value=" <?php echo e($order->receipt_number); ?>" >
            <input type="hidden" name="oldSku" value="<?php echo e($order->membership->package->sku); ?>">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                                <label>Membership</label>
                                <select class="form-control" id="membership_id" name="membership_id" required>
                                    <option disabled selected>Choose Membership</option>  
                                    <?php $__empty_1 = true; $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option <?php echo e($order->membership->id == $membership->id ? "selected" : ' '); ?> value="<?php echo e($membership->package->sku); ?>"><?php echo e($membership->package->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>                    
                                </select>
                  </div>

                </div>
              </div>
            </div>
          

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a class="btn greenBtn mr-2" id="updateMembership">Save</a>
            </div>
            </form>
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

      $(() => {
          $(".editbtn").click(() => {
            $("#editMembership").modal();
          })

          //On Create Package Button
          $("#updateMembership").click(()=>{

            if($('input[name="oldSku"]').val() != $("#membership_id").val()){

              $.ajax({

               type:'POST',

               url:'<?php echo e(route("switchPackage")); ?>',

               data:   $("#editMembershipForm").serialize(),

                success: function(msg){
                      $("tbody").append(msg);
                      $(".nothingFound").addClass('d-none')
                      $("#editMembership").modal("hide");
                      $("#message").text("Membership Updated!");
                      $("#alertModal").modal();
                      //
                      
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                     $('#validation-errors').html('');
                   $.each(XMLHttpRequest.responseJSON.errors, function(key,value) {
                       $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                   }); 

                }

              });

            }

          })
    })

    })
  
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ar\newhtml\html\AudioBotClickBank\audiobot\resources\views/orders/show.blade.php ENDPATH**/ ?>