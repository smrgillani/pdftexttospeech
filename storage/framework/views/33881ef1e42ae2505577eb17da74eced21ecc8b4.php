
 <?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
    <div class="row">
        <div class="col-md-12">
            <h3>
                        Admin Panel
                     </h3>
            <div style="float: right">
                <a type="button" id='addpackageform' class="btn  themeBtn">
                              Add Package
                            </a>
                <!-- <button type="button" id='viewsubscribers' class="btn  themeBtn" data-toggle="modal" data-target="#myModal"> -->
                <a href='<?php echo e(route("ViewSubscribers")); ?>' type="button" id='viewsubscribers' class="btn  themeBtn">
                              View Subscribers
                            </a>
            </div>
        </div>
    </div>

    <div style='margin:25px'>
        <ul style="list-style: none;" id="packageList">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div style='margin:10px' class="card">
                    <h5 style="color: black" class="card-header"><?php echo e($packages->name); ?></h5>
                    <div class="card-body">
                        <p style="color: black" class="card-text"><?php echo e($packages->description); ?></p>
                        <p>
                            <h5 style="color: black; float: right" class="card-title">$<?php echo e($packages->price); ?> /Month</h5></p>
                      <!--   <a  class="btn themeBtn editPackage"  packageID="<?php echo e($packages->id); ?>" data-title="<?php echo e($packages->title); ?>" data-description="<?php echo e($packages->description); ?>" data-price="<?php echo e($packages->price); ?>" data-rebill-price="<?php echo e($packages->rebill_price); ?>" data-rebill-commission="<?php echo e($packages->rebill_commission); ?>" data-sku="<?php echo e($packages->sku); ?>">Edit</a> -->
                        <a href='#' class="btn themeBtn" id="deletepackage" packageID="<?php echo e($packages->id); ?>">Delete</a>
                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

    </div>

</div>
<!-- Modal -->


<!-- create Package Model -->

<div class="modal fade" id="createPackage">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Create New Package</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <img src="assets/img/close.png">
                </button>
            </div>

            <!-- Modal body -->
            <form id="addPackageForm">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group" id="validation-errors">

                      
                            </div>
                            <div class="form-group">
                                <label>Package Title</label>
                                <input class="form-control input-sm" style="color: black;" name='title' type='text' required>
                            </div>
                        

                            <div class="form-group">
                                <label>Package Sku</label>
                                <input class="form-control input-sm" style="color: black;" name='sku' type='text' required>
                            </div>

                            <div class="form-group">
                                <label>Package Description</label>
                                <input class="form-control input-sm" style="color: black;" name='description' type='text' required>

                                <!--  <select multiple class="form-control" id="languages" placeholder="Choose Language"  name="languages[]" required>
                                </select> -->
                            </div>

                            <div class="form-group">
                                <label> Package Price</label>
                                <input type="number" class="form-control input-sm" style="color: black;" name='price' required>

                            </div>

                            <div class="form-group">
                                <label>Rebill Comission</label>
                                <input type="number" class="form-control input-sm" style="color: black;" name='rebillCommission' required>
                            </div>

                            <div class="form-group">
                                <label> Rebill Price </label>
                                <input type="number" class="form-control input-sm" style="color: black;" name='rebillPrice' required>
                            </div>


                        </div>
                    </div>
                        <input type="hidden" name="currency" id="currency" value="USD">
                            <input type="hidden" name="language" id="language" value="EN">
                            <input type="hidden" name="site" id="site" value="audiogen">
                            <input type="hidden" name="categories" id="categories" value="EBOOK">
                            <input type="hidden" name="duration" id="duration" value="30">
                            <input type="hidden" name="frequency" id="frequency" value="MONTHLY">
                            <input type="hidden" name="pitchPage" id="pitchPage" value="<?php echo e(config('services.clickBank.pitchPageLink')); ?>">
                            <input type="hidden" name="thankYouPage" id="thankYouPage" value="<?php echo e(config('services.clickBank.pitchPageLink')); ?>">
                            <input type="hidden" name="trialPeriod" id="trialPeriod" value="0">
                            <input type="hidden" name="digital" id="digital" value="true">
                            <input type="hidden" name="physical" id="physical" value="false">
                            <input type="hidden" name="digitalRecurring" id="digitalRecurring" value="true">
                            <input type="hidden" name="physicalRecurring" id="physicalRecurring" value="false">
                          </div>

            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a class="btn greenBtn mr-2" id="createPackageButton">Save</a>
            </div>

            </div>
        </div>
    </div>

    <!-- End Create Pckage Model -->



<!-- create Edit Package Model -->

<div class="modal fade" id="editPackage">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Create New Package</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <img src="assets/img/close.png">
                </button>
            </div>

            <!-- Modal body -->
            <form id="editPackageForm">
                <div class="modal-body">
                      <div class="row">

                          <div class="col-md-12">
                              <div class="form-group" id="edit-validation-errors">

                        
                              </div>
                              <div class="form-group">
                                  <label>Package Title</label>
                                  <input class="form-control input-sm" style="color: black;" name='editTitle' type='text' required>
                              </div>
                          

                              <div class="form-group">
                                  <label>Package Sku</label>
                                  <input class="form-control input-sm" style="color: black;" name='editSku' type='text' required>
                              </div>

                              <div class="form-group">
                                  <label>Package Description</label>
                                  <input class="form-control input-sm" style="color: black;" name='editDescription' type='text' required>

                                  <!--  <select multiple class="form-control" id="languages" placeholder="Choose Language"  name="languages[]" required>
                                  </select> -->
                              </div>

                              <div class="form-group">
                                  <label> Package Price</label>
                                  <input type="number" class="form-control input-sm" style="color: black;" name='editPrice' required>

                              </div>

                              <div class="form-group">
                                  <label>Rebill Comission</label>
                                  <input type="number" class="form-control input-sm" style="color: black;" name='editRebillCommission' required>
                              </div>

                              <div class="form-group">
                                  <label> Rebill Price </label>
                                  <input type="number" class="form-control input-sm" style="color: black;" name='editRebillPrice' required>
                              </div>


                          </div>
                      </div>
              
                    </div>
                    
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <a class="btn greenBtn mr-2" id="editPackageButton">Save</a>
            </div>

            </div>
        </div>
    </div>

    <!-- End Edit Package Model -->

<!-- Alert Message Model -->
<div id="alertModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
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

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               
            </div>
        </div>

    </div>
</div>
<!-- End Alert Message Model -->
    <?php $__env->stopSection(); ?> 
    <?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
          $.ajaxSetup({

            headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

          });

        $(() => {
                $("#addpackageform").click(() => {
                    $("#createPackage").modal();
                })


                //On Create Package Button
                $("#createPackageButton").click(()=>{

                  var title=$("input[name='title']").val();
                  var description=$("input[name='description']").val();
                  var sku=$("input[name='sku']").val();
                  var price=$("input[name='price']").val();
                  var rebillCommission=$("input[name='rebillCommission']").val();
                  var rebillPrice=$("input[name='rebillPrice']").val();
                  var currency=$("input[name='currency']").val();
                  var site=$("input[name='site']").val();
                  var categories=$("input[name='categories']").val();
                  var duration=$("input[name='duration']").val();
                  var frequency=$("input[name='frequency']").val();
                  var thankYouPage=$("input[name='thankYouPage']").val();
                  var pitchPage=$("input[name='pitchPage']").val();
                  var trialPeriod=$("input[name='trialPeriod']").val();
                  var digital=$("input[name='digital']").val();
                  var physical=$("input[name='physical']").val();
                  var digitalRecurring=$("input[name='digitalRecurring']").val();
                  var physicalRecurring=$("input[name='physicalRecurring']").val();

        $.ajax({

           type:'POST',

           url:'<?php echo e(route("AddPackage")); ?>',

           data:   $("#addPackageForm").serialize(),

            success: function(msg){
                  $("#packageList").append(msg);
                  $("#createPackage").modal("hide");
                  $("#message").text("Package Created!");
                  $("#alertModal").modal();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                 $('#validation-errors').html('');
               $.each(XMLHttpRequest.responseJSON.errors, function(key,value) {
                   $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
               }); 

            }

        });

                })
            })
        //Edit package

        $(() => {
                $(".editPackage").click((event)=> {
                   var $this = $(event.currentTarget);
                  $("input[name='editTitle']").val($this .data('title'));
                  $("input[name='editDescription']").val($this .data('description'));
                  $("input[name='editSku']").val($this .data('sku'));
                  $("input[name='editPrice']").val($this .data('price'));
                  $("input[name='editRebillPrice']").val($this .data('rebillPrice'));
                  $("input[name='editRebillCommission']").val($this .data('rebillCommission'));
                    $("#editPackage").modal();
                });


                //On Create Package Button
                $("#editPackageButton").click(()=>{

             

        $.ajax({

           type:'POST',

           url:'<?php echo e(route("AddPackage")); ?>',

           data:   $("#editPackageForm").serialize(),

            success: function(msg){
                  $("#packageList").append(msg);
                  $("#createPackage").modal("hide");
                  $("#message").text("Package Created!");
                  $("#alertModal").modal();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                 $('#validation-errors').html('');
               $.each(XMLHttpRequest.responseJSON.errors, function(key,value) {
                   $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
               }); 

            }

        });

                })
            })

        $('body').on('click', '#deletepackage', function(e) {

            e.preventDefault();

            console.log($(this).attr('packageid'));
            var url = '<?php echo e(route("DeletePackage")); ?>' + "/" + $(this).attr('packageid');

            $.ajax({

                type: 'get',

                url: url,

                success: function(response) {

                    if (response == 1) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                },
                error: function(response) {
                  $('#message').text(response.responseJSON.message);
                  $("#alertModal").modal();
                }

            });

        });
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/PackagesAdminPage.blade.php ENDPATH**/ ?>