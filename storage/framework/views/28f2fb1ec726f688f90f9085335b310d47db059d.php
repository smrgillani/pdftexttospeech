<?php $__env->startSection('content'); ?>



<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Audio Books
                     </h3>
                  </div>
               </div>
              <div class="row text-right pt-4">
                  <div class="col-lg-4 offset-lg-8">
                    <div class="form-group">
                                
                               <input type="text" name="search" id="search" placeholder="Search Books" class="form-control">
                              </div>
                  </div>
               </div>

               <div class="row mt-3">
                  <div class="col-md-12">
                  	 <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Book Name</th>
                            <th>No of Pages</th>  
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                          <tr>
                            <td><?php echo e($book['name']); ?></td>
                            
                            
                            <td><?php echo e($book['no_of_pages']); ?></td>
                        
                            <td>
                              <div class="d-flex">
                                
                                <a href="<?php echo e(url('/book/'.$book['id'])); ?>" data-toggle="tooltip" title="Reconvert" class="mr-4" >
                                  <img src="<?php echo e(asset('assets/img/eye.png')); ?>" width="">
                                </a>
                               
                                <a class="mr-4 <?php if(count($book['audio_voices']) == 0): ?> disabled <?php endif; ?>" data-toggle="tooltip" title="Listen Audio"  href="<?php echo e(route('bookaudio',$book['id'])); ?>" >
                                  <img src="<?php echo e(asset('assets/img/listen.png')); ?>" width="">
                                </a>
                                
                                 <a class="mr-4 editbtn pointer" data-toggle="modal" data-target="#editBook" data-toggle="tooltip" title="Edit" data-bookName="<?php echo e($book['name']); ?>" data-bookID="<?php echo e($book['id']); ?>">
                                  <img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" >
                                </a>
                                <a class="deletebtn pointer" data-toggle="modal" data-target="#deleteBook" data-toggle="tooltip" title="Delete" data-bookID="<?php echo e($book['id']); ?>">
                                  <img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="">
                                </a>
                              </div>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                          <td colspan="4" align="center">No Book Found</td>
                          </tr>
                        <?php endif; ?> 
                        </tbody>
                      </table>
                  </div>

                  
                   </div>
               </div>
            </div>
<!-- Edit Book Model -->
      <div class="modal fade" id="editBook">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

    <form>
            <!-- Hidden Attributes -->
            <input type="hidden" name="bookID" value="" id="bookID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Update Book Name</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="assets/img/close.png">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                        <input id="bookName" type="text" name="name" placeholder="Enter book name" class="form-control" required>
                              </div>
                  
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button class="btn greenBtn mr-2" id="updateBook">Save</button> 
            </div>
            </form>
          </div>
        </div>
      </div>
<!-- End Edit Book Model -->

<!-- Delete Book Model -->
      <div class="modal fade" id="deleteBook">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form>
            
            <!-- Hidden Attributes -->
            <input type="hidden" name="bookID" value="" id="bookID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Book</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Book?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deleteBookBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Chapter Model -->

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

    $('body').on('click', '.deletebtn',function(e){

		var bookID = $(this).attr("data-bookID");

		$("#bookID").val(bookID);

    });	

    $('body').on('click', '.editbtn',function(e){

      var bookID = $(this).attr("data-bookID");

      var bookName = $(this).attr("data-bookName");

    $("#bookName").val(bookName);
    $("#bookID").val(bookID);

    }); 



    $('body').on('click', '#updateBook',function(e){

    e.preventDefault(); 

      var bookName = $("#bookName").val();

      var bookID = $("#bookID").val();

     

          $.ajax({

           type:'GET',

           url:'bookname',

           data: { bookName:bookName, bookID:bookID },

           success:function(response){

            let output=''; 

            if(response.error == false){
              if(response.data.length > 0){

              $.each(response.data, function(key,val) {
              
                output += '<tr>'+

             '<td>'+this.name +'</td>'+

             '<td>'+this.no_of_pages +'</td>'+

             '<td>'+

              ' <div class="d-flex">'+ 

              '<a href="" class="mr-4" data-toggle="tooltip" title="Reconvert" ><img src="<?php echo e(asset('assets/img/eye.png')); ?>" width=""></a>';

              
              output += '<a href="bookaudio/'+ this.id +'" class="mr-4 '+ (val.audio_voices.length == 0 ? 'disabled' : '') +'" data-toggle="tooltip" Listen Audio" ><img src="<?php echo e(asset('assets/img/listen.png')); ?>" width=""></a>';
             
               output += ' <a class="mr-4 editbtn pointer" data-toggle="modal" data-target="#editBook" data-bookName="'+this.name+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit"></a>'+

              '<a  class="deletebtn pointer"  data-toggle="modal" data-target="#deleteBook" data-bookID="'+ this.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
             
            '</div>'+

            '</td>'+

            '</tr>';
  
               });
              }
              

              $('tbody').html(output);
            }
             $('#editBook').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

    });

     $('body').on('click', '#deleteBookBtn',function(e){

	    e.preventDefault();

	     

        var bookID = $("input[name=bookID]").val();

        

        var url="<?php echo e(route('book.destroy',':id')); ?>";

     	url=url.replace(":id",bookID);

        $.ajax({

           type:'DELETE',

           url:url,

           data: { bookID:bookID },

           success:function(response){

           	let output=''; 

           	if(response.error == false){
           		if(response.data.length > 0){

           		$.each(response.data, function(i,val) {

           			output += '<tr>'+

		         '<td>'+val.name +'</td>'+

		         '<td>'+val.no_of_pages +'</td>'+

		         '<td>'+

		          ' <div class="d-flex">'+ 

		          '<a href="" class="mr-4" data-toggle="tooltip" title="Reconvert" ><img src="<?php echo e(asset('assets/img/eye.png')); ?>" width=""></a>'+

		          '<a href="bookaudio/'+ val.id +'" class="mr-4 '+ (val.audio_voices.length == 0 ? 'disabled' : '') +'" data-toggle="tooltip" title="Listen Audio" ><img src="<?php echo e(asset('assets/img/listen.png')); ?>" width=""></a>'+
                ' <a class="mr-4 editbtn pointer" data-toggle="modal" data-target="#editBook" data-bookName="'+val.name+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit" ></a>'+

		          '<a  class="deletebtn pointer"  data-toggle="modal" data-target="#deleteBook" data-bookID="'+ val.id +'"  ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
		         
		        '</div>'+

		        '</td>'+

		        '</tr>';
  
		        	 });
           		}
           		

           		$('tbody').html(output);
           	}
             $('#deleteBook').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

    });


      $('#search').on('keyup',function(){

      $book=$(this).val(); 

      $.ajax({

      type : 'get',

      url : '<?php echo e(route("booksearch")); ?>',

      data:{'book':$book},

      success:function(response){
       let output='';

        if(response.total_data>0){
          
          $.each(response.table_data, function(i,val) { 

          output += '<tr>'+

         '<td>'+val.name +'</td>'+

         '<td>'+val.no_of_pages +'</td>'+

         '<td>'+

              ' <div class="d-flex">'+ 

              '<a href="book/'+ val.id +'" class="mr-4"  data-toggle="tooltip" title="Reconvert" ><img src="<?php echo e(asset('assets/img/eye.png')); ?>" width=""></a>'+

              '<a href="" class="mr-4 '+ (val.audio_voices.length == 0 ? 'disabled' : '') +'"  ><img src="<?php echo e(asset('assets/img/listen.png')); ?>" width="" data-toggle="tooltip" title="Listen Audio"></a>'+

              ' <a class="mr-4 editbtn pointer" data-toggle="modal" data-target="#editBook" data-bookName="'+val.name+'"><img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="" data-toggle="tooltip" title="Edit" ></a>'+

              '<a  class="deletebtn pointer"  data-toggle="modal" data-target="#deleteBook" data-bookID="'+ val.id +'" ><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="" data-toggle="tooltip" title="Delete"></a>'+
             
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
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\ar\newhtml\html\AudioBotClickBank\audiobot\resources\views/books/index.blade.php ENDPATH**/ ?>