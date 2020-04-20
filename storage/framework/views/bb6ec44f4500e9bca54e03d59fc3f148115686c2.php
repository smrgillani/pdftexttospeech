<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Packages
                     </h3>
                  </div>
               </div>
               <div class="row text-right pt-4">
                  <div class="col-lg-6 offset-lg-6">
                    <div class="form-group d-flex">

                               <input type="text" name="search" id="search" placeholder="Search Packages" class="form-control mr-3">
                                <a class="btn themeBtn pt-12px" id="clearform" data-toggle="modal" data-target="#createPackage">Create Package</a>
                              </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <!-- <th>Name</th> -->
                            <th>Title</th>
                            <th>Sku</th>
                            <th>Price</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr id="package<?php echo e($package->id); ?>">
                        

                            <td><?php echo e($package->title); ?></td>

                            <td><?php echo e($package->sku); ?></td>

                            <td><?php echo e($package->price); ?></td>

                            <td>
                              <div class="d-flex">

                                    <a   class="mr-4 editbtn editPackage"  packageID="<?php echo e($package->id); ?>" data-package-id="<?php echo e($package->id); ?>" data-title="<?php echo e($package->title); ?>" data-description="<?php echo e($package->description); ?>" data-price="<?php echo e($package->price); ?>" data-rebill-price="<?php echo e($package->rebill_price); ?>" data-rebill-commission="<?php echo e($package->rebill_commission); ?>" data-sku="<?php echo e($package->sku); ?>"><img src="assets/img/edit.png" width="" data-toggle="tooltip" title="Edit"></a>
                              

                              <a href='#' class="mr-4 deletebtn" id="deletepackage" packageID="<?php echo e($package->id); ?>"> 
                                <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete">
                              </a>


                              </div>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr class="nothingFound">
                          <td colspan="6" align="center">No Package Found</td>
                          </tr>
                           <?php endif; ?>

                        </tbody>
                      </table>
                      </div>
                  </div>
               </div>
            </div>
 
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
                                <input type="number" class="form-control input-sm" style="color: black;" name='rebillCommission' required min="1">
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

<!--  Edit Package Model -->

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
<!-- End Edit Package  -->

    <!-- Delete Package Model -->
      <div class="modal fade" id="deletePackage">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form  id="delUserForm">

            <!-- Hidden Attributes -->
            <input type="hidden" name="PackageID" value="" id="PackageID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Package</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Package?</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deletePackageBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Package Model -->

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
                  $("tbody").append(msg);
                  $(".nothingFound").addClass('d-none')
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
                var $this ;
                $(".editPackage").click((event)=> {
                    $this = $(event.currentTarget);
                  $("input[name='editTitle']").val($this .data('title'));
                  $("input[name='editDescription']").val($this .data('description'));
                  $("input[name='editSku']").val($this .data('sku'));
                  $("input[name='editPrice']").val($this .data('price'));
                  $("input[name='editRebillPrice']").val($this .data('rebillPrice'));
                  $("input[name='editRebillCommission']").val($this .data('rebillCommission'));
                    $("#editPackage").modal();
                });


                //On Edit Package Button
                $("#editPackageButton").click(()=>{
                  console.log($this .data('package-id'))
                url='<?php echo e(route("packages.update","package")); ?>'
                url=url.replace('package',$this .data('package-id'))

        $.ajax({

           type:'PUT',


           url:url,
           data:   $("#editPackageForm").serialize(),

            success: function(msg){
                  $("#packageList").append(msg);
                  $("#createPackage").modal("hide");
                  $("#message").text("Package Updated!");

                  $("#package"+$this.data('package-id')).html(msg)
                  $("#editPackage").modal("hide");

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
            $("#PackageID").val($(this).attr('packageid'))
            $("#deletePackage").modal()


        });
         $('body').on('click', '#deletePackageBtn', function(e) {


            e.preventDefault();

            var url = '<?php echo e(route("DeletePackage")); ?>' + "/" + $("#PackageID").val();

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


        /*Search Package*/
            $('#search').on('keyup',function(){

      $packagesearch=$(this).val();

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("packagesearch")); ?>',

      data:{'packagesearch':$packagesearch},

      success:function(response){

       let output='';

        if(response.total_data>0){

          $.each(response.table_data, function() {

        output += '<tr>'+

             '<td>'+this.title +'</td>'+

             '<td>'+this.sku +'</td>'+


             '<td>'+this.price +'</td>'+

            

             '<td>'+
              ' <div class="d-flex">'+
              '<a  class="mr-4 editbtn editPackage" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
              '<a href="" class="mr-4 deletebtn" id="deletepackage" data-target="#deleteMembership" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+


            '</div>'+
            '</td>'+

            '</tr>';

        });


          }else{

            $('#message').text('No Data Found');

            $('#alertMessage').modal("show");

          }
      $('tbody').html(output);
      }
    });
  });
        /*End Search*/
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/packages/index.blade.php ENDPATH**/ ?>