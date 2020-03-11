<?php $__env->startSection('content'); ?>
<div class="container  pl-5 pr-5">
                <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Chapters (Step 2)
                     </h3>
                  </div>
               </div>
               <div class="row mt-3">
                
               </div>
              

              <div class="row mt-5 mb-5 bookPages">
                 <div class="col-md-12">
                  <div class="cardBox">
                   
                    <!-- href="<?php echo e(route('chapter.process',$book->id)); ?>" -->
                    <a class="btn newThemeBtnStyle mr-2 pull-right"  id="nextbtn" data-bookID="<?php echo e($book->id); ?>">Next</a>
                   <a class="btn newThemeBtnStyle mr-2 pull-right" href="<?php echo e(route('chapter.process',$book->id)); ?>">Skip This Step</a>
                   <a class="btn newThemeBtnStyle mr-2 pull-right" href="<?php echo e(route('book.show',$book->id)); ?>">Previous</a>
                      <h5>
                       Chapters
                     </h5>
                    <div class="text-right">
                       <a class="btn greenBtn mr-2 mb-4" data-toggle="modal" data-target="#createChapter">Add Chapter</a>   
                    </div>
                    <!-- Nav pills -->
                  <div class="row" id="PageTabs">
                    
                   
                   <table class="table">
                        <thead>
                          <tr>
                            <th>Chapter Name</th>
                            <th>From page</th>
                            <th>To page</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                           
                        <tbody id="chapterBody">
                           <?php $__empty_1 = true; $__currentLoopData = $book->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr data-bookID=<?php echo e($chapter->book_id); ?>>
                            <td data-chapterName=<?php echo e($chapter->name); ?>><?php echo e($chapter->name); ?></td>
                            <td data-chapterPageFrom=<?php echo e($chapter->pageFrom->page_no); ?>><?php echo e($chapter->pageFrom->page_no); ?></td>
                            <td data-chapterPageFrom=<?php echo e($chapter->pageTo->page_no); ?>><?php echo e($chapter->pageTo->page_no); ?></td>
                            <td>
                              <div class="d-flex">
                                <a href=""  class="mr-4 editbtn" data-toggle="modal" data-target="#editChapter" data-chapterID=<?php echo e($chapter->id); ?> data-chapterName="<?php echo e($chapter->name); ?>" data-chapterPageFrom="<?php echo e($chapter->pageFrom->page_no); ?>" data-chapterPageTo="<?php echo e($chapter->pageTo->page_no); ?>">
                                  <img src="<?php echo e(asset('assets/img/edit.png')); ?>" width="">
                                </a>
                                <a href="" class="deletebtn"  data-toggle="modal" data-target="#deleteChapter" data-chapterID=<?php echo e($chapter->id); ?>>
                                  <img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width="">
                                </a>
                              </div>
                            </td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                          <td colspan="4" align="center">No Chapter Found</td>
                          </tr>
                         <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                 </div>
               </div>
     
           </div>

    <!-- End Create Page Model -->

    <!-- Create Chapter Model -->
      <div class="modal fade" id="createChapter">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form method="POST"  enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- Hidden Attributes -->
            <input type="hidden" id="create_book_id" name="book_id" value="<?php echo e(\Request::segment(2)); ?>">
            <input type="hidden" name="total_pages" value="<?php echo e(count($book->pages)); ?>">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Create New Chapter</h5>
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
                               <input type="text" id="chapterName" name="chapterName" placeholder="Enter Chapter Name" class="form-control">
                              </div>
              
                <div class="form-group">
                  <label>Page From</label>
                <select id="pageFrom" name="pageFrom" placeholder="Choose Page From" class="form-control" min="<?php echo e($book->pages[0]->page_no); ?>" max="<?php echo e(count($book->pages)); ?>" required>
                <option disabled selected id="cfrom">Choose Page From</option>
                              <?php $__currentLoopData = $book->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pageno->page_no); ?>"><?php echo e($pageno->page_no); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Page To</label>
                <select id="pageTo" name="pageTo" placeholder="Choose Page To" class="form-control" min="<?php echo e($book->pages[0]->page_no); ?>" max="<?php echo e(count($book->pages)); ?>" required>
                <option disabled selected id="cto">Choose Page To</option>
                              <?php $__currentLoopData = $book->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pageno->page_no); ?>"><?php echo e($pageno->page_no); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                </div>
           
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a type="button" id="sendCreateRequest" class="btn greenBtn mr-2">Save</a>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Create Chapter Model -->


      <!-- Edit Chapter Model -->
      <div class="modal fade" id="editChapter">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form method="POST"  enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <!-- Hidden Attributes -->
            <input type="hidden" id="edit_book_id" name="book_id" value="<?php echo e(\Request::segment(2)); ?>">
            <input type="hidden" id="edit_chapter_id" name="chapter_id" value="<?php echo e(count($book->pages)); ?>">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Update Chapter</h5>
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
                               <input type="text" id="editChapterName" name="chapterName" placeholder="Enter Chapter Name" class="form-control">
                              </div>

                <div class="form-group">
                <select id="editPageFrom" name="pageFrom" placeholder="Choose Page From" class="form-control" min="<?php echo e($book->pages[0]->page_no); ?>" max="<?php echo e(count($book->pages)); ?>" required>
                <option disabled selected>Choose Page From</option>
                              <?php $__currentLoopData = $book->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pageno->page_no); ?>"><?php echo e($pageno->page_no); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">

                <select id="editPageTo" name="pageTo" placeholder="Choose Page To" class="form-control" min="<?php echo e($book->pages[0]->page_no); ?>" max="<?php echo e(count($book->pages)); ?>" required>
                <option disabled selected>Choose Page To</option>
                              <?php $__currentLoopData = $book->pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($pageno->page_no); ?>"><?php echo e($pageno->page_no); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                </div>
                
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a type="button" id="updateChapter" class="btn greenBtn mr-2">Save</a>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Edit Chapter Model -->




    <!-- Delete Chapter Model -->
      <div class="modal fade" id="deleteChapter">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form>
          
            <!-- Hidden Attributes -->
            <input type="hidden" name="chapterID" value="" id="chapterID">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Chapter</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="<?php echo e(asset('assets/img/close.png')); ?>">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Chapter?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button" id="sendChapDelBtn"  class="btn greenBtn mr-2">Delete</button>
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

   $(function() {

    

    setTimeout(function(){

      $("#PageTabs .nav-link.active").click();
      
    });


  $('#nextbtn').on("click",function(){

    var bookid= $(this).attr("data-bookID");


        $.ajax({

           type:'GET',

           url:'<?php echo e(route("cheptercheck")); ?>',

           data: { bookid:bookid },

             success:function(data){

              if(data.length >0){
                var url="<?php echo e(route('chapter.process',':id')); ?>";

                url=url.replace(":id",data[0].book_id);
                window.location.href=url

               // $('#nextbtn').attr('href', url);
              }else{

              // $('#nextbtn').attr('href', '#');

              $('#message').text("Can't process further, No chapter found");

              $('#alertMessage').modal("show");
              }
             }
        });

      
    }); 

$("#PageTabs .nav-link").on("click",function(){

$("#chapterBody tr").hide();
$("#__"+$(this).attr("id")+"").show();
}); 



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $('body').on('click', '.deletebtn',function(){
      
     var chapterID= $(this).attr("data-chapterID");

     
      $('#chapterID').val(chapterID);
     
      });

    

      $('body').on('click', '#sendChapDelBtn',function(e){

        e.preventDefault();

       

        var chapterID = $("input[name=chapterID]").val();

        

        var url="<?php echo e(route('chapter.destroy',':id')); ?>";



        url=url.replace(":id",chapterID);


        $.ajax({

           type:'DELETE',

           url:url,

           data: { chapterID:chapterID },

             success:function(data){

             

              $('#deleteChapter').modal('hide');
                          
              if(data.error == false){
              let output=''; 
              if(data.data.length > 0){
                $.each(data.data, function() {
                   
              output += '<tr>'+
               '<td data-chapterName='+this.name +'>'+this.name +'</td>'+

               '<td data-chapterPageFrom='+this.page_from.page_no +'>'+this.page_from.page_no +'</td>'+

               '<td data-chapterPageTo='+this.page_to.page_no +'>'+this.page_to.page_no +'</td>'+

               '<td><div class="d-flex">'+ 

               '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editChapter" data-chapterID="'+ this.id +'" data-chapterName="'+ this.name +'" data-chapterPageFrom="'+ this.page_from.page_no+'" data-chapterPageTo="'+ this.page_to.page_no +'" >'+
               '<img src="<?php echo e(asset('assets/img/edit.png')); ?>" width=""></a>'+

               '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width=""></a>'+
               '</div></td>'+

              '</tr>';
                });

              } 
               
              $('#chapterBody').html(output);

              $('#message').text(data.message);

              $('#alertMessage').modal("show");
              
        }else{

              $('#message').text(data.message);

              $('#alertMessage').modal("show");
      }
    }

    });
  });


    $('body').on('click', '.editbtn',function(){

     var chapterName= $(this).attr("data-chapterName");

     var chapterPageFrom= $(this).attr("data-chapterPageFrom");

     var chapterPageTo= $(this).attr("data-chapterPageTo");

     var chapterID= $(this).attr("data-chapterID");

      $('#editChapterName').val(chapterName);

      $('#editPageFrom').val(chapterPageFrom);

      $('#editPageTo').val(chapterPageTo);

      $('#edit_chapter_id').val(chapterID);

      });

        $('#sendCreateRequest').on( 'click', function(e) {
        // e.preventDefault();
       
        var book_id = $("input[name='book_id']").val();

        var total_pages = $("input[name='total_pages']").val();
        
        var chapterName = $("input[name='chapterName']").val();
        
        var pageFrom = $("#pageFrom").val();

        // var voicename = $("#voicename").val();

        var pageTo = $("#pageTo").val();
        

          $.ajax({

             type:'post',

             url:'<?php echo e(route("chapter.store")); ?>',

             data: {book_id:book_id, total_pages:total_pages, chapterName:chapterName,pageFrom:pageFrom,pageTo:pageTo},

             success:function(data){

              $('#createChapter').modal('hide');
              $('#chapterName').val('');
              $('#pageFrom').val($("#cfrom").val());
              $('#pageTo').val($("#cto").val());

            
              if(data.error == false){
              let output=''; 
              if(data.data.length > 0){
                $.each(data.data, function() {
                   
              output += '<tr>'+
               '<td data-chapterName='+this.name +'>'+this.name +'</td>'+

               '<td data-chapterPageFrom='+this.page_from.page_no +'>'+this.page_from.page_no +'</td>'+

               '<td data-chapterPageTo='+this.page_to.page_no +'>'+this.page_to.page_no +'</td>'+

               '<td><div class="d-flex">'+ 

               '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editChapter" data-chapterID="'+ this.id +'" data-chapterName="'+ this.name +'" data-chapterPageFrom="'+ this.page_from.page_no+'" data-chapterPageTo="'+ this.page_to.page_no +'" >'+
               '<img src="<?php echo e(asset('assets/img/edit.png')); ?>" width=""></a>'+

               '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width=""></a>'+
               '</div></td>'+

              '</tr>';
                });

              } else{

              $('#message').text('Chanpter Not Found');

              $('#alertMessage').modal("show");
              
            }
               
              $('#chapterBody').html(output);

              $('#message').text(data.message);

              $('#alertMessage').modal("show");
              
        }else{

              $('#message').text(data.message);

              $('#alertMessage').modal("show");
      }
    }

  });

  });

    $('body').on('click','#updateChapter',function(e){

      e.preventDefault();

      var book_id = $("#edit_book_id").val();

      var chapter_id = $("#edit_chapter_id").val();

      var chapterName = $("#editChapterName").val();

      var pageFrom = $("#editPageFrom").val();

      var pageTo = $("#editPageTo").val();

      var url="<?php echo e(route('chapter.update',':id')); ?>";

      url=url.replace(":id",chapter_id);

      
        $.ajax({

           type:'PUT',

           url: url,

           data: { book_id:book_id, chapterName:chapterName, pageFrom:pageFrom, pageTo:pageTo },

           success:function(response){

            $('#editChapter').modal('hide');
   
            let output=''; 

            if(response.error ==false){
              if(response.data.length > 0){
                $.each(response.data, function() {
                   
              output += '<tr>'+
               '<td data-chapterName='+this.name +'>'+this.name +'</td>'+

               '<td data-chapterPageFrom='+this.page_from.page_no +'>'+this.page_from.page_no +'</td>'+

               '<td data-chapterPageTo='+this.page_to.page_no +'>'+this.page_to.page_no +'</td>'+

               '<td><div class="d-flex">'+ 

               '<a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editChapter" data-chapterID="'+ this.id +'" data-chapterName="'+ this.name +'" data-chapterPageFrom="'+ this.page_from.page_no+'" data-chapterPageTo="'+ this.page_to.page_no +'" >'+
               '<img src="<?php echo e(asset('assets/img/edit.png')); ?>" width=""></a>'+

               '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="<?php echo e(asset('assets/img/deleteicon.png')); ?>" width=""></a>'+
               '</div></td>'+

              '</tr>';
                });

          $('#chapterBody').html(output);
          }

          }
             $('#editChapter').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });


    });

  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sarmad/Work/FreelanceWork/PhpProjects/AudioBot/html/resources/views/chapters/index.blade.php ENDPATH**/ ?>