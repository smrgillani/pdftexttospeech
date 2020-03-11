@extends('layouts2.app')

@section('content')
<div class="container  pl-5 pr-5">
                <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Chapters (Step 2)
                     </h3>
                  </div>
               </div>
               <div class="row mt-3">
                 <div class="col-md-12 text-right">
                   <a class="btn greenBtn mr-2" data-toggle="modal" data-target="#createChapter">Create Chapter</a>
                   <a class="btn themeBtn" href="{{route('bookaudio',$book->id)}}">View Audio</a>
                 </div>
               </div>
               <div class="row mt-5">
                 <div class="col-md-12">
                  <div class="max-height-270">
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
                           @forelse($book->chapters as $chapter)
                          <tr data-bookID={{$chapter->book_id}}>
                            <td data-chapterName={{$chapter->name}}>{{$chapter->name}}</td>
                            <td data-chapterPageFrom={{$chapter->pageFrom->page_no}}>{{$chapter->pageFrom->page_no}}</td>
                            <td data-chapterPageFrom={{$chapter->pageTo->page_no}}>{{$chapter->pageTo->page_no}}</td>
                            <td>
                              <div class="d-flex">
                                <a href=""  class="mr-4 editbtn" data-toggle="modal" data-target="#editChapter" data-chapterID={{$chapter->id}} data-chapterName="{{$chapter->name}}" data-chapterPageFrom="{{$chapter->pageFrom->page_no}}" data-chapterPageTo="{{$chapter->pageTo->page_no}}">
                                  <img src="{{asset('assets/img/edit.png')}}" width="">
                                </a>
                                <a href="" class="deletebtn"  data-toggle="modal" data-target="#deleteChapter" data-chapterID={{$chapter->id}}>
                                  <img src="{{asset('assets/img/deleteicon.png')}}" width="">
                                </a>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                          <td colspan="4" align="center">No Chapter Found</td>
                          </tr>
                         @endforelse
                        </tbody>
                      </table>
                  </div>
                     
                 </div>
                 <div class="col-md-12 text-right">
                   <a class="btn themeBtn mr-2" href="{{route('chapter.process',$book->id)}}">Next</a>
                   <a class="btn themeBtn mr-2" href="{{route('chapter.process',$book->id)}}">Skip This Step</a>
                 </div>
               </div>
           </div>

    <!-- End Create Page Model -->

    <!-- Create Chapter Model -->
      <div class="modal fade" id="createChapter">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form method="POST"  enctype="multipart/form-data">
            @csrf
            <!-- Hidden Attributes -->
            <input type="hidden" id="create_book_id" name="book_id" value="{{\Request::segment(2)}}">
            <input type="hidden" name="total_pages" value="{{count($book->pages)}}">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Create New Chapter</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
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
                <select id="pageFrom" name="pageFrom" placeholder="Choose Page From" class="form-control" min="{{$book->pages[0]->page_no}}" max="{{count($book->pages)}}" required>
                <option disabled selected id="cfrom">Choose Page From</option>
                              @foreach($book->pages as $pageno)
                                <option value="{{$pageno->page_no}}">{{$pageno->page_no}}</option>
                              @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Page To</label>
                <select id="pageTo" name="pageTo" placeholder="Choose Page To" class="form-control" min="{{$book->pages[0]->page_no}}" max="{{count($book->pages)}}" required>
                <option disabled selected id="cto">Choose Page To</option>
                              @foreach($book->pages as $pageno)
                                <option value="{{$pageno->page_no}}">{{$pageno->page_no}}</option>
                              @endforeach
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
            @csrf
            @method('PUT')
            <!-- Hidden Attributes -->
            <input type="hidden" id="edit_book_id" name="book_id" value="{{\Request::segment(2)}}">
            <input type="hidden" id="edit_chapter_id" name="chapter_id" value="{{count($book->pages)}}">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Update Chapter</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
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
                <select id="editPageFrom" name="pageFrom" placeholder="Choose Page From" class="form-control" min="{{$book->pages[0]->page_no}}" max="{{count($book->pages)}}" required>
                <option disabled selected>Choose Page From</option>
                              @foreach($book->pages as $pageno)
                                <option value="{{$pageno->page_no}}">{{$pageno->page_no}}</option>
                              @endforeach
                  </select>
                </div>

                <div class="form-group">

                <select id="editPageTo" name="pageTo" placeholder="Choose Page To" class="form-control" min="{{$book->pages[0]->page_no}}" max="{{count($book->pages)}}" required>
                <option disabled selected>Choose Page To</option>
                              @foreach($book->pages as $pageno)
                                <option value="{{$pageno->page_no}}">{{$pageno->page_no}}</option>
                              @endforeach
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
                <img src="{{asset('assets/img/close.png')}}">
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
                <img src="{{asset('assets/img/close.png')}}">
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


@endsection

@push('scripts')
    <script type="text/javascript">

   $(function() {

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

        

        var url="{{route('chapter.destroy',':id')}}";



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
               '<img src="{{asset('assets/img/edit.png')}}" width=""></a>'+

               '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="{{asset('assets/img/deleteicon.png')}}" width=""></a>'+
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

	           url:'{{ route("chapter.store")}}',

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
	             '<img src="{{asset('assets/img/edit.png')}}" width=""></a>'+

	             '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="{{asset('assets/img/deleteicon.png')}}" width=""></a>'+
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

      var url="{{route('chapter.update',':id')}}";

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
               '<img src="{{asset('assets/img/edit.png')}}" width=""></a>'+

               '<a href="" class="deletebtn" data-chapterID="'+this.id+'" data-toggle="modal" data-target="#deleteChapter"><img src="{{asset('assets/img/deleteicon.png')}}" width=""></a>'+
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
@endpush