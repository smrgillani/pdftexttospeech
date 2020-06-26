<?php $__env->startSection('content'); ?>

        
            <div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Dashboard
                     </h3>
                  </div>
               </div>
               <div class="row text-center">
                  <div class="col-md-12">
                     <h4 class="pt-4">
                        Welcome to the Dashboard
                     </h4>
                     <p class="colorGreyDark">
                        Glad to see you again , Enjoy this software and make your life easy
                     </p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <div class="d-flex pdfBoxMain justify-content-between align-items-center mt-5 text-center">
                        <div>
                           <div class="pdfBox">
                              <img src="<?php echo e(asset('assets/img/uploadicon.png')); ?>">
                           </div>
                           <p class="mt-3">
                              Upload PDF File
                           </p>
                        </div>
                        <div>
                           <div class="pdfBox">
                              <img src="<?php echo e(asset('assets/img/setchaptericon.png')); ?>">
                           </div>
                           <p class="mt-3">
                              Set Chapters & Language
                           </p>
                        </div>
                        <div>
                           <div class="pdfBox noneAfter">
                              <img src="<?php echo e(asset('assets/img/listenicon.png')); ?>">
                           </div>
                           <p class="mt-3">
                              Listen Audio
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="uploadBox">
                        <div class="d-flex align-items-center">
                           
                              <div class="choosePDF mr-4">
                                 <input type="file" name="" id="chooseFile"  name="uploadFile">
                                 <label for="chooseFile">
                                     <img src="<?php echo e(asset('assets/img/choosefileicon.png')); ?>">
                                 <p>
                                    Choose PDF File
                                 </p>
                                 </label>
                                
                              </div>
                               
                           
                           <div class="ml-2 w-70">
                              <button class="btn themeBtn pr-5 pl-5" id="uploadFile" accept=".pdf">UPLOAD</button>
                              <div class="progress mt-3 ">
                                <div class="progress-bar  progress-bar-striped progress-bar-animated" style="width:0%"></div>
                              </div>
                              <p id="fileSize" class="mt-4 mb-0"></p>
                              <p id="fileName" class="mt-4 mb-0"></p>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>



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
              <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
<!-- End Alert Message Model -->
   
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
         <script type="text/javascript">
         $(document).ready(function(){

             $.ajaxSetup({

                  headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }

              });

             


             var fd = "";
             $('#chooseFile').change(function(e){
              var  totalBytes=e.target.files[0].size
              var fileName = e.target.files[0].name;
                  
                  $("#fileSize").html("File Size : " + Math.floor(totalBytes/1000000) + ' MB');
                  $("#fileName").html("File Name : " + fileName );

                  var fileType = e.target.files[0].type;
                  
                  if (fileType != "application/pdf")
                  {
                      
                         $('#message').text('Kindly Upload PDF File');

                        $('#alertMessage').modal("show");
                        $('#chooseFile').val("");
                  }

                  fd = new FormData();    
                  fd.append('file',e.target.files[0]);
                  
              });


             $('#uploadFile').click(function(event){
              if($('#chooseFile').val())
              {
                window.onbeforeunload = function() {
                   return "Do you really want to leave this page?";
                   };

              $.ajax({
               url:"<?php echo e(route('book.store')); ?>",
               type: "POST",
               processData: false,
               contentType: false,
               data: fd,
                 xhr: function() {
                       var xhr = new window.XMLHttpRequest();
                       xhr.upload.addEventListener("progress", function(evt) {
                           if (evt.lengthComputable) {
                               var percentComplete = (evt.loaded / evt.total) * 100;
                              $('.progress-bar').css({
                                 width: percentComplete + '%'
                                }, {
                                 duration: 1000
                                });
                              $('.progress-bar').text(parseInt(percentComplete) + '%');
                           }
                      }, false);
                      return xhr;
                   },
                
                success:function(response){

                window.onbeforeunload = null
                  if(response.file){
                  $('#message').text(response.file[0]);
                    $('.progress-bar').css({
                                 width: 0 + '%'
                                }, {
                                 duration: 1000
                                });
                              $('.progress-bar').text(parseInt(0) + '%');
                  }else{
                    $('#message').text(response.message);
                  }
                

                $('#alertMessage').modal("show");
               
                     setTimeout(function() {
                    window.location.href = "book/"+response.data.id;
                }, 3000);
               
             

                },

              }); 

              }
              else
              {
               
                $('#message').text('Choose File to upload');

                $('#alertMessage').modal("show");
              }
              
             });
            });
      </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts2.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/AudioBotClickBank/audiobot/resources/views/home.blade.php ENDPATH**/ ?>