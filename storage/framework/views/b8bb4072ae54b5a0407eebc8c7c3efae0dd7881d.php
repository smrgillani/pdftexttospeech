<?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Users
                     </h3>
                  </div>
               </div>
               <div class="row text-right pt-4">
                  <div class="col-lg-6 offset-lg-6">
                    <div class="form-group d-flex">
                                
                               <input type="text" name="search" id="search" placeholder="Search Books" class="form-control mr-3">
                                <a class="btn themeBtn pt-12px" data-toggle="modal" data-target="#invite">Invite User</a>
                              </div>
                  </div>
                 
               </div>

               <div class="row mt-3">
                  <div class="col-md-12">
                  	 <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                          <tr>
                            <td><?php echo e($user->name); ?></td>
                            
                            
                            <td><?php echo e($user->email); ?></td>
                            <td><span class="text-<?php echo e($user->status == 1 ? 'success':'warning'); ?>"><?php echo e($user->status == 1 ? 'Active':'Inactive'); ?></span></td>
                            <td>
                              <div class="d-flex">
                                
                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editUser" data-userID="<?php echo e($user->id); ?>"  data-membershipID="<?php echo e($user->membership_id); ?>" data-status="<?php echo e($user->status); ?>"  data-name="<?php echo e($user->name); ?>">
                                  <img src="<?php echo e(asset('assets/img/edit.png')); ?>" data-toggle="tooltip" title="Edit" width="">
                                </a>
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteUser" data-userID=<?php echo e($user->id); ?>>
                                  <img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete">
                                </a>
                                <a  class="resendbtn pointer" data-userEmail="<?php echo e($user->email); ?>">
                                  <img src="<?php echo e(asset('assets/img/remailicon.png')); ?>" width="" data-toggle="tooltip" title="Resend">
                                </a>
                              </div>
                            </td>
                          </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                          <td colspan="4" align="center">No User Found</td>
                          </tr>
                        <?php endif; ?> 
                        </tbody>
                      </table>
                  </div>
                   </div>
               </div>
            </div>
<!-- Invite User Model -->

      <div class="modal fade" id="invite">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

		<form>
            <?php echo csrf_field(); ?>
            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Create User</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="assets/img/close.png">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                                <label>Email Address</label>
                               <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                              </div>
                  
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button class="btn greenBtn mr-2" id="inviteUser">Send</button> 
            </div>
			</form>
          </div>
        </div>
      </div>
<!-- End Invite User Model -->

          <!-- Delete Chapter Model -->
      <div class="modal fade" id="deleteUser">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form  id="delUserForm">
            
            <!-- Hidden Attributes -->
            <input type="hidden" name="userID" value="" id="userID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete User</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this User?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deleteUserBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Chapter Model -->


    <!-- Edit User Model -->
      <div class="modal fade" id="editUser">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form method="POST"  enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- Hidden Attributes -->
            <input type="hidden" id="editUserID"  name="id" value="">
			
            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                                <label>Name</label>
                               <input type="text" id="name" name="name"  placeholder="Enter name" value=""  class="form-control">
                            </div> 
                <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option disabled selected>Choose Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                              
                                </select>
                            </div>
                <div class="form-group">
                                <label>Membership</label>
                                <select class="form-control" id="membership_id" name="membership_id" required>
                                    <option disabled selected>Choose Membership</option>  
                                    <?php $__empty_1 = true; $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membership): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($membership->id); ?>"><?php echo e($membership->name); ?></option>
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
              <a type="button" id="updateUser" class="btn greenBtn mr-2">Update</a>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Edit User Model -->



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
    <script type="text/javascript">
    $(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();

     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

$('body').on('click', '#inviteUser',function(e){

	    e.preventDefault();

        var email = $("input[name=email]").val();

        $.ajax({

           type:'POST',

           url:'<?php echo e(route("user.store")); ?>',

           data: { email:email },

           success:function(response){
    

           	let output=''; 

            if(response.error ==false){

            output += '<tr>'+

		         '<td>'+ response.data.name +'</td>'+

		         '<td>'+ response.data.email +'</td>'+

		         '<td> <span class="'+ 'text-'+(response.data.status==1 ? "success":"warning")+ '">' + (response.data.status==1 ? "Active":"Inactive") + ' </span> </td>'+

		         '<td>'+
		          ' <div class="d-flex">'+
		          '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editUser" data-userID="'+ response.data.id +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
		          '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteUser" data-userID="'+ response.data.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
		          '<a  class="resendbtn pointer"  data-userEmail="'+ response.data.email +'" ><img src="<?php echo e(asset('assets/img/remailicon.png')); ?>" width="" data-toggle="tooltip" title="Resend"></a>'+
		         
		        '</div>'+
		        '</td>'+

		        '</tr>';
           

         	$('tbody').append(output);

         	}
             $('#invite').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

});


$('body').on('click', '#updateUser',function(e){

	    e.preventDefault();

        var id = $("input[name=id]").val();

        var name = $("input[name=name]").val();

        var status = $("#status").val();

        var membership_id = $("#membership_id").val();

        var url="<?php echo e(route('user.update',':id')); ?>";

     	url=url.replace(":id",id);

        $.ajax({

           type:'PUT',

           url: url,

           data: { id:id, name:name, status:status, membership_id:membership_id },

           success:function(response){
   
           	let output=''; 

            if(response.error ==false){
            	if(response.data.length > 0){
            		$.each(response.data, function() {

            output += '<tr>'+

		         '<td>'+ this.name +'</td>'+

		         '<td>'+ this.email +'</td>'+

		         '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

		         '<td>'+
		          ' <div class="d-flex">'+
		          '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editUser" data-userID="'+ this.id +'" data-membershipID="'+ this.membership_id +'"  data-status="'+ this.status +'" data-name="'+ this.name +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
		          '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteUser" data-userID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
		          '<a  class="resendbtn"  data-userEmail="'+ this.email +'" ><img src="<?php echo e(asset('assets/img/remailicon.png')); ?>" width="" data-toggle="tooltip" title="Resend"></a>'+
		         
		        '</div>'+
		        '</td>'+

		        '</tr>';
            });

         	$('tbody').html(output);
         	}

         	}
             $('#editUser').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

});


$('body').on('click', '#deleteUserBtn',function(e){

	    e.preventDefault();

        var userID = $("input[name=userID]").val();

        var url="<?php echo e(route('user.destroy',':id')); ?>";

     	url=url.replace(":id",userID);

        $.ajax({

           type:'DELETE',

           url:url,

           data: { userID:userID },

           success:function(response){

           	let output=''; 

           	if(response.error == false){
           		if(response.data.length > 0){

           		$.each(response.data, function() {

           			output += '<tr>'+

		         '<td>'+this.name +'</td>'+

		         '<td>'+this.email +'</td>'+

		         '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

		         '<td>'+
		          ' <div class="d-flex">'+
		          '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editUser" data-userID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
		          '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteUser" data-userID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
		          '<a  class="resendbtn"  data-userEmail="'+ this.email +'" ><img src="<?php echo e(asset('assets/img/remailicon.png')); ?>" width="" data-toggle="tooltip" title="Resend"></a>'+
		         
		        '</div>'+
		        '</td>'+

		        '</tr>';

		        	 });
           		}
           		

           		$('tbody').html(output);
           	}
             $('#deleteUser').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

});

$('body').on('click', '.editbtn',function(){

	var userID= $(this).attr("data-userID");

	var userName= $(this).attr("data-name");

	var userStatus= $(this).attr("data-status");

	userStatus=parseInt(userStatus);

	var membershipID= $(this).attr("data-membershipID");

	membershipID=parseInt(membershipID);


	$('#editUserID').val(userID);

	$('#name').val(userName);

	$('#status option[value='+userStatus+']').attr('selected','selected');
	
	$('#membership_id option[value='+membershipID+']').attr('selected','selected');


	// $('#membership_id').append('<option value="foo" selected="selected">Foo</option>');	
});



$('body').on('click', '.deletebtn',function(){

     var userID= $(this).attr("data-userID");

     $('#userID').val(userID);

     });

    $('body').on('click', '.resendbtn',function(){

      var userEmail =  $(this).attr("data-userEmail");
        
      
        $.ajax({

           type:'POST',

           url:'<?php echo e(route("user.store")); ?>',

           data: { email:userEmail },

           success:function(data){

            $('#message').text(data.message);

            $('#alertMessage').modal("show");
                

           }
        });
      });



     $('#search').on('keyup',function(){

      $user=$(this).val(); 

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("usersearch")); ?>',

      data:{'user':$user},

      success:function(data){
       let output='';

        if(data.total_data>0){
          
          $.each(data.table_data, function() { 

          output += '<tr>'+

         '<td>'+this.name +'</td>'+

         '<td>'+this.email +'</td>'+

         '<td> <span class="'+ 'text-'+(this.status==1 ? "success":"warning")+ '">' + (this.status==1 ? "Active":"Inactive") + ' </span> </td>'+

         '<td>'+
          ' <div class="d-flex">'+
          '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editUser" data-userID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+
          '<a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteUser" data-userID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
          '<a  class="resendbtn"  data-userEmail="'+ this.email +'" ><img src="<?php echo e(asset('assets/img/remailicon.png')); ?>" width="" data-toggle="tooltip" title="Resend"></a>'+
         
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

    });
      </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/user/index.blade.php ENDPATH**/ ?>