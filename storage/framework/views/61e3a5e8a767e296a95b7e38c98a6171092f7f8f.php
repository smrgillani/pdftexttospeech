<?php $__env->startSection('content'); ?>

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Membership
                     </h3>
                  </div>
               </div>
               <div class="row text-right pt-4">
                  <div class="col-lg-6 offset-lg-6">
                    <div class="form-group d-flex">

                               <input type="text" name="search" id="search" placeholder="Search Memberships" class="form-control mr-3">
                                <a class="btn themeBtn pt-12px" id="clearform" data-toggle="modal" data-target="#createMembership">Create Membership</a>
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
                            <th>Price</th>
                            <th>Voice Type</th>
                            <th>Package</th>
                            <th>Status</th>
                            <th>Character Length</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $__empty_1 = true; $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr>
                            <!-- <td><?php echo e($membership->package->title); ?></td> -->

                            <td><?php echo e($membership->package->price); ?></td>

                            <td><?php echo e($membership->voice_type); ?></td>

                            <td><?php echo e($membership->package->title); ?></td>

                            <td><span class="text-<?php echo e($membership->status == 1 ? 'success' : 'warning'); ?>"><?php echo e($membership->status == 1 ? 'Active' : 'Inactive'); ?></span></td>

                            <td><?php echo e($membership->characters_length); ?></td>

                            <td>
                              <div class="d-flex">

                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" data-membershipID="<?php echo e($membership->id); ?>" data-membershipName="<?php echo e($membership->name); ?>" data-membershipPrice="<?php echo e($membership->price); ?>" data-membershipLength="<?php echo e($membership->characters_length); ?>" data-membershipVoiceType="<?php echo e($membership->voice_type); ?>" data-status="<?php echo e($membership->status); ?>" data-package="<?php echo e($membership->package->id); ?>">
                                  <img src="assets/img/edit.png" width="" data-toggle="tooltip" title="Edit">
                                </a>
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="<?php echo e($membership->id); ?>">
                                  <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete">
                                </a>

                              </div>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr class="nothingFound">
                          <td colspan="6" align="center">No Membership Found</td>
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
          <!--         <div class="form-group">
                               <label>Name</label>
                               <input type="text" id="editname" name="name" placeholder="Enter Membership Name" class="form-control" required>
                              </div> -->

                  <div class="form-group">
                                <label>Voice Type</label>
                               <select id="editvoice_type" name="voice_type" placeholder="Choose Voice Type" class="form-control" required>
                <option disabled selected>Choose Voice Type</option>
                                <option value="Standard">Standard</option>
                                <option value="WaveNet">WaveNet</option>
                                <option value="Both">Both</option>
                               </select>
                              </div>

                  <div class="form-group">
                                <label>Language</label>
                              <!--  <select multiple class="form-control" id="languages" placeholder="Choose Language"  name="languages[]" required>
                                </select> -->
                              <select class="form-control js-example-tokenizer" data-placeholder="Select languages" placeholder="Choose Language" id="editlanguages" multiple="multiple" name="languages[]" required>

                                </select>
                              </div>

                  <div class="form-group">
                                <label>Voice</label>
                               <!-- <select multiple class="form-control" id="voices" placeholder="Choose" name="voices[]" required>
                               </select> -->
                                <select class="form-control js-example-tokenizer" data-placeholder="Select Voices"  placeholder="Choose Voice" id="editvoices" multiple="multiple" name="voices[]" required>
                                </select>
                              </div>

                  <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option disabled selected>Choose Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>

                                </select>
                            </div>
<!-- 
                  <div class="form-group">
                                <label>Price</label>
                               <input type="number" name="price" id="editprice" min="0" placeholder="Price" class="form-control" required>
                              </div> -->

                  <div class="form-group">
                                <label>Length</label>
                               <input type="number" name="characters_length" id="editcharacters_length" placeholder="Character Length " class="form-control" required>
                              </div>
                    <div class="form-group">
                                <label>Package</label>
                                <select class="form-control" data-placeholder="Select Package" placeholder="Choose Package" id="editPackage" name="package" required>
                                  <option disabled selected>Choose Package</option>
                                  <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                  <option value="<?php echo e($package->id); ?>"><?php echo e($package->title); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                  <?php endif; ?>
                                </select>

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
<!-- create Membership Model -->

      <div class="modal fade" id="createMembership">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Create New Membership</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="assets/img/close.png">
              </button>
            </div>

            <!-- Modal body -->
            <form>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">

 <!--                  <div class="form-group d-invisible">
                               <label>Name</label>
                               <input type="text" id="name" name="name" placeholder="Enter Membership Name" class="form-control" required value="xyz">
                              </div> -->

                  <div class="form-group">
                                <label>Voice Type</label>
                               <select id="voice_type" name="voice_type" class="form-control" required>
                <option disabled selected>Choose Voice Type</option>
                                <option value="Standard">Standard</option>
                                <option value="WaveNet">WaveNet</option>
                                <option value="Both">Both</option>
                               </select>
                              </div>

                  <div class="form-group">
                                <label>Language</label>
                                <select class="form-control js-example-tokenizer" data-placeholder="Select languages" placeholder="Choose Language" id="languages" multiple="multiple" name="languages[]" required>
                                 <!--  <option selected="selected">orange</option>
                                  <option>white</option>
                                  <option selected="selected">purple</option> -->
                                </select>

                              <!--  <select multiple class="form-control" id="languages" placeholder="Choose Language"  name="languages[]" required>
                                </select> -->
                              </div>

                  <div class="form-group">
                                <label>Voice</label>
                                <select class="form-control js-example-tokenizer" data-placeholder="Select Voices"  placeholder="Choose Voice" id="voices" multiple="multiple" name="voices[]" required>

                                </select>

                              </div>

                  <!-- <div class="form-group">
                                <label>Price</label>
                               <input type="number" name="price" id="price" min="0" placeholder="Price" class="form-control" required>
                              </div> -->

                  <div class="form-group">
                                <label>Length</label>
                               <input type="number" name="characters_length" id="characters_length" placeholder="Character Length " class="form-control" required>
                              </div>
                     <div class="form-group">
                                <label>Package</label>
                                <select class="form-control" data-placeholder="Select Package" placeholder="Choose Package" id="package" name="package" required>
                                  <option disabled selected>Choose Package</option>
                                  <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                  <option value="<?php echo e($package->id); ?>"><?php echo e($package->title); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                  <?php endif; ?>
                                </select>

                </div>
              </div>
            </div>
          </div>

          </form>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a class="btn greenBtn mr-2" id="membershipCreate">Save</a>
            </div>

          </div>
        </div>
      </div>

      <!-- End Create Membership Model -->



 

    <!-- Delete Membership Model -->
      <div class="modal fade" id="deleteMembership">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form  id="delUserForm">

            <!-- Hidden Attributes -->
            <input type="hidden" name="MembershipID" value="" id="MembershipID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Membership</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Membership?</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deleteMembershipBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Membership Model -->



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

    $('#clearform').on('click',function(){
      $('#name').val("");
      $('#price').val("");
      $('#characters_length').val("");
      $('.select2-selection__rendered').html('');

    });

    $(".js-example-tokenizer").select2({
          allowClear: true,
    });

  $('body').on('click', '.deletebtn',function(){

       var MembershipID= $(this).attr("data-MembershipID");

       $('#MembershipID').val(MembershipID);

       });


  $('body').on('click', '#deleteMembershipBtn',function(e){

      e.preventDefault();

        var MembershipID = $("input[name=MembershipID]").val();

        var url="<?php echo e(route('membership.destroy',':id')); ?>";

      url=url.replace(":id",MembershipID);

        $.ajax({

           type:'DELETE',

           url:url,

           data: { MembershipID:MembershipID },

           success:function(response){

            let output='';

            if(response.error == false){
              if(response.data.length > 0){

              $.each(response.data, function() {

                output += '<tr>'+

             '<td>'+this.name +'</td>'+

             '<td>'+this.price +'</td>'+


             '<td>'+this.voice_type +'</td>'+

             '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

             '<td>'+this.characters_length +'</td>'+





             '<td>'+
              ' <div class="d-flex">'+
              '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" data-membershipID="'+ this.id +'" data-membershipName="'+this.name+'" data-membershipPrice="'+this.price+'" data-membershipLength="'+this.characters_length+'" data-membershipVoiceType="'+ this.voice_type+'" data-status="'+this.status+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
              '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+


            '</div>'+
            '</td>'+

            '</tr>';

               });
              }


              $('tbody').html(output);
            }
             $('#deleteMembership').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

  });

  $('#voice_type').change(function(){

      $value=$(this).val();
      $('.select2-selection__rendered').html('');
      $.ajax({

      type : 'get',

      url : '<?php echo e(route("languagesearch")); ?>',

      data:{'search':$value},

      success:function(data){

      $('#languages').html(data);

      }

      });

    });

    $('#editvoice_type').change(function(){

       $('.select2-selection__rendered').html('');

      $value=$(this).val();

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("languagesearch")); ?>',

      data:{'search':$value},

      success:function(data){

      $('#editMembership #editlanguages').html(data);


      }

      });

    });


    $('#languages').change(function(){

      $language=$(this).val();


      let voicetype=$('#voice_type').val();

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("voicesearch")); ?>',

      data:{'language':$language,'voicetype':voicetype},

      success:function(data){

       $('#voices').html(data);

      }

    });

  });

    $('#editlanguages').change(function(){

      $language=$(this).val();


      let voicetype=$('#editvoice_type').val();

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("voicesearch")); ?>',

      data:{'language':$language,'voicetype':voicetype},

      success:function(data){

       $('#editvoices').html(data);

      }

    });

  });


 $('body').on('click', '#membershipCreate',function(e){

      e.preventDefault();

        var name = "xyz";

        var voice_type  = $("#voice_type").val();

        var languages = $("#languages").val();

        var voices = $("#voices").val();

        var price = "123";
        var package = $("#package").val();


        var characters_length = $("#characters_length").val();


        $.ajax({

           type:'POST',

           url:'<?php echo e(route("membership.store")); ?>',

           data: { name:name ,voice_type : voice_type , languages: languages , voices: voices , price : price , characters_length : characters_length,package:package },

           success:function(response){
                $('form :input').val('');
                $('.select2-selection__rendered').html('');



            let output='';

            if(response.error ==false){

            output += '<tr>'+


             '<td>'+response.data.price +'</td>'+


             '<td>'+response.data.voice_type +'</td>'+

             '<td>'+response.data.voice_type +'</td>'+

              '<td> <span class="'+ 'text-'+(response.data.status==1 ? "success":"warning")+ '">' + (response.data.status==1 ? "Active":"Inactive") + ' </span> </td>'+

             '<td>'+response.data.characters_length +'</td>'+

             '<td>'+
              ' <div class="d-flex">'+
              '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" data-membershipID="'+ response.data.id +'" data-membershipName="'+response.data.name+'" data-membershipPrice="'+response.data.price+'" data-membershipLength="'+response.data.characters_length+'" data-membershipVoiceType="'+ response.data.voice_type+'" data-status="'+response.data.status+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
              '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="'+ response.data.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+


            '</div>'+
            '</td>'+

            '</tr>';


          $('tbody').append(output);
          $(".nothingFound").addClass('d-none')

          }
             $('#createMembership').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

  });


  $('body').on('click', '#membershipUpdate',function(e){

      e.preventDefault();


        var membershipID = $("input[name=MembershipID]").val();


        var name = "xyz";

        var voice_type  = $("#editvoice_type").val();


        var languages = $("#editlanguages").val();

        var voices = $("#editvoices").val();

        var price = "123";

        var status = $("#status").val();

        var characters_length = $("#editcharacters_length").val();

        var url="<?php echo e(route('membership.update',':id')); ?>";

        var package= $("#editPackage").val();

        url=url.replace(":id",membershipID);

        $.ajax({

           type:'PUT',

           url:url,

           data: { name:name ,voice_type : voice_type , languages: languages , voices: voices , price : price , characters_length : characters_length , status : status,package:package },

           success:function(response){

            let output='';

            if(response.error == false){
              if(response.data.length > 0){

              $.each(response.data, function() {

                output += '<tr>'+


             '<td>'+this.price +'</td>'+



             '<td>'+this.voice_type +'</td>'+

             
             '<td>'+this.package.title +'</td>'+

             '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

             '<td>'+this.characters_length +'</td>'+

             '<td>'+
              ' <div class="d-flex">'+
              '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" data-membershipID="'+ this.id +'"  data-membershipName="'+this.name+'" data-membershipPrice="'+this.price+'" data-membershipLength="'+this.characters_length+'" data-membershipVoiceType="'+ this.voice_type+'" data-status="'+this.status+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
              '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+


            '</div>'+
            '</td>'+

            '</tr>';

               });
              }


              $('tbody').html(output);
            }
             $('#editMembership').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

  });


    $('#search').on('keyup',function(){

      $membership=$(this).val();

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("membershipsearch")); ?>',

      data:{'membership':$membership},

      success:function(response){

       let output='';

        if(response.total_data>0){

          $.each(response.table_data, function() {

        output += '<tr>'+

             '<td>'+this.name +'</td>'+

             '<td>'+this.price +'</td>'+


             '<td>'+this.voice_type +'</td>'+

             '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

             '<td>'+this.characters_length +'</td>'+

             '<td>'+
              ' <div class="d-flex">'+
              '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
              '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+


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

$('body').on('click', '.editbtn',function(){

  var membershipID= $(this).attr("data-membershipID");


    $("#editlanguages").val("");
    $("#editvoices").val("");


    $('.select2 select2-container').html('');

  $('#MembershipID').val(membershipID);

  var membershipName= $(this).attr("data-membershipName");

  var membershipVoiceType= $(this).attr("data-membershipVoiceType");

  var package= $(this).attr("data-package");

  var membershipPrice= $(this).attr("data-membershipPrice");

  var membershipLength= $(this).attr("data-membershipLength");

  var status= $(this).attr("data-status");

  $('#editMembership #status option[value='+ status +']').attr('selected','selected');

  $('#editvoice_type option[value='+ membershipVoiceType +']').attr('selected','selected');

  $('#editPackage option[value='+ package +']').attr('selected','selected');



  $('#editname').val(membershipName);

  $('#editprice').val(membershipPrice);

  $('#editcharacters_length').val(membershipLength);

  var url="<?php echo e(route('membership.edit',':id')); ?>";

  url=url.replace(":id",membershipID);



  $.ajax({

      type : 'get',

      url : url,

      success:function(response){


        $.each(response.languages, function() {

      $('#editlanguages').append('<option value="'+this.language+'">'+this.language +
                                  '</option>');

      });

      $.each(response.selectedLanguage, function() {
      $('#editlanguages option[value="'+ this.name +'"]').attr('selected','selected');

      });


      $.each(response.voices, function() {
      $.each(this, function() {

      $('#editvoices').append('<option value="'+this.ssml_gender+' '+this.name+'">'+ this.ssml_gender+' '+this.name  +
                                  '</option>');
        });
      });


      $.each(response.selectedVoices, function() {

         $('#editvoices option[value="'+ this.gender+' '+this.name +'"]').attr('selected','selected');

      });

    }
  });

});


});

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/membership/index.blade.php ENDPATH**/ ?>