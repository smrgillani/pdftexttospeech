@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">

              <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Book Pages (Step 1)
                     </h3>
                     
                  </div>
                   
              </div>
  
               <div class="row mt-3">
                 <div class="col-md-12 text-right">
                  @if(count($book->audioVoices) > 0)
                   <a class="btn themeBtn" href="{{route('bookaudio',$book->id)}}">View Audio</a>
                  @endif
                 </div>
               </div>
    

               <div class="row mt-5 mb-5 bookPages">
                 <div class="col-md-12">
                  <div class="cardBox">


                    <a class="btn newThemeBtnStyle mr-2 pull-right" href="{{route('book.chapter',$book->id)}}">Next</a>
                   
                    <a class="btn btn-danger mr-2 pull-right" href="{{route('book.index')}}">Cancel</a>

                     <h5>
                       Book Pages
                     </h5>

                    <!-- Nav pills -->
                    <div class="row" id="PageTabs">
                      <div class="col-md-3">
                        <ul class="nav nav-pills">
                          @foreach($book->pages as $key=>$page)

                          <li class="nav-item">
                            <a class="nav-link @if($key==0) active  @endif" data-toggle="pill" href="#page{{$page['page_no']}}">Page {{$page['page_no']}}</a>
                          </li>
                          @endforeach
                         
                        </ul>
                      </div>
                      <div class="col-md-9">
                          <!-- Tab panes -->
                        <div class="tab-content">
                          @foreach($book->pages as $key=>$page)

                          <div class="tab-pane container @if($key==0) active  @endif" id="page{{$page['page_no']}}">
                            
                            <div class="row">
                              <div class="col-md-12 text-right">
                              <a class="btn greenBtn mr-2" data-toggle="modal" id="addPage" data-target="#createPage">
                    Add New Page</a>
                               <a class="btn themeBtn mr-2 pr-5 pl-5 editPage"  data-pageID="{{$page['page_no']}}" data-bookID="{{$page['book_id']}}" >Edit</a>



                               <a class="btn themeBtn pr-5 pl-5 pageDel" data-pageID="{{$page['page_no']}}" data-bookID="{{$page['book_id']}}" data-toggle="modal" data-target="#delPage">Delete</a>



                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="pageContentBox">
                                  <p id="ContentpageNo{{$page['page_no']}}">
                                    {{$page['content']}}
                                  </p>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          @endforeach

                          
                        </div>
                      </div>
                    </div>
                   </div>
                 </div>
               </div>

               
            </div>

      <!-- Create Page Model -->
      <div class="modal fade" id="createPage">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form method="POST"  enctype="multipart/form-data">
            @csrf
            <!-- Hidden Attributes -->
            <input type="hidden" id="create_book_id" name="book_id" value="{{\Request::segment(2)}}">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Create New Page</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Content</label>
                      <textarea rows="5" id="pageContent" name="pageContent" placeholder="Enter Page Content" class="form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a type="button" id="pageCreateRequest" class="btn greenBtn mr-2">Save</a>
            </div>
          </form>
          </div>
        </div>
      </div>


<!-- Delete Page Model -->
      <div class="modal fade" id="delPage">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form >
            
            <!-- Hidden Attributes -->
            <input type="hidden" id="page_ID" name="page_ID" value="">
            <input type="hidden" id="delete_book_ID" name="book_ID" value="">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Page</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Page?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deletePageBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Page Model -->


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


   
      $("#addPage").on( 'click', function(e) {
          $("#pageContent").val('');
      });

        $('#pageCreateRequest').on( 'click', function(e) {
        // e.preventDefault();
       
        var book_id = $("input[name='book_id']").val();

        var pageContent = $("#pageContent").val();
          
          if(pageContent.length > 4950){

             $('#message').text('Page characters shold less then 5000');

            $('#alertMessage').modal("show");

            return false;
          }else{

                    $.ajax({

                     type:'post',

                     url:'{{ route("page.store")}}',

                     data: { book_id:book_id, pageContent:pageContent },

                     success:function(response){
            
                     
                   let output=''; 

           if(response.error == false){

            if(response.data.pages.length > 0){
              
              output +='<div class="row" id="PageTabs">'+

              '<div class="col-md-3">'+

              '<ul class="nav nav-pills">';

              $.each(response.data.pages, function(i,val) {

          
                output +='<li class="nav-item">'+

                '<a class="nav-link'+(i ==0 ? " active" : "") +'" data-toggle="pill" href="#page'+val.page_no+'">Page '+val.page_no+'</a>'+

                ' </li>';

            });

            output +='</ul>'+

            '</div>'+

            '<div class="col-md-9">'+

            '<div class="tab-content">';

             $.each(response.data.pages, function(i,val) {
                output +='<div class="tab-pane container'+(i==0 ? " active" : "") +'" id="page'+val.page_no+'">'+
                '<div class="row">'+

                '<div class="col-md-12 text-right">'+

                '<a class="btn greenBtn mr-2 pr-5 pl-5 editPage" data-pageID="'+val.page_no+'" data-bookID="'+val.book_id+'" >Edit</a>'+

                '<a class="btn themeBtn pr-5 pl-5 pageDel" data-pageID="'+val.page_no+'" data-bookID="'+val.book_id+'" data-toggle="modal" data-target="#delPage">Delete</a>'+

                '</div>'+

                '</div>'+

                '<div class="row">'+

                '<div class="col-md-12">'+

                '<div class="pageContentBox">'+

                '<p id="ContentpageNo'+val.page_no+'">'+val.content+'</p>'+

                '</div>'+

                '</div>'+

                '</div>'+

                '</div>';

            });
           output +='</div>'+

                '</div>'+

                                
                '</div>';

          }

            $('#PageTabs').replaceWith(output);

            $('#createPage').modal('hide');

             $('#message').text(response.message);

             $('#alertMessage').modal("show");

          }else{

            $('#createPage').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");

          }
        }

      });
    } 
        

});







    $('body').on('click','.editPage',function(){

      var pageNo= $(this).attr("data-pageID");

      var bookID= $(this).attr("data-bookID");

      $(this).siblings().replaceWith('<a id="cancelEdit" class="btn themeBtn pr-5 pl-5" data-pageid="'+pageNo+'" data-bookid="'+bookID+'">Cancel</a>');

      $(this).replaceWith('<a class="btn greenBtn mr-2 pr-5 pl-5" id="pageUpdate" data-pageID="'+pageNo+'" data-bookid="'+bookID+'" >Update</a>');
      

      var content=$('#ContentpageNo'+pageNo).text().trim().replace(/(\r\n|\n|\r)/gm," ");

      $('#ContentpageNo'+pageNo).replaceWith('<textarea maxlength="4950" id="ContentpageNo'+pageNo+'">'+content+'</textarea>');

      $('#ContentpageNo'+pageNo)[0].style.cssText = 'height:' + $('#ContentpageNo'+pageNo)[0].scrollHeight + 'px';
 

    });

    $('body').on('click','#cancelEdit',function(){

      var pageNo= $(this).attr("data-pageID");

      var content=$('#ContentpageNo'+pageNo).text();

      var bookID= $(this).attr("data-bookID");

      $(this).siblings().replaceWith('<a class="btn greenBtn mr-2 pr-5 pl-5 editPage" data-pageid="'+pageNo+'" data-bookid="'+bookID+'" >Edit</a>');

      $('#ContentpageNo'+pageNo).replaceWith('<p id="ContentpageNo'+pageNo+'">'+ content +'</p>');

      $('#cancelEdit').replaceWith('<a class="btn themeBtn pr-5 pl-5 pageDel" data-pageid="'+pageNo+'" data-bookid="'+bookID+'" data-toggle="modal" data-target="#delPage">Delete</a>');


      });

    $('body').on('click','#pageUpdate',function(){

      var pageNo= $(this).attr("data-pageID");

      var content=$('#ContentpageNo'+pageNo).val();

      if(content.length < 4950){

      var bookID= $(this).attr("data-bookID");

      var url="{{route('pageedit',':id')}}";

      url=url.replace(":id",pageNo);

      $.ajax({

           type:'get',

           url:url,

           data: {pageNo:pageNo, content:content, bookID:bookID },

           success:function(response){
            
          if(response.error == false){


            $('#ContentpageNo'+response.data.page_no).replaceWith('<p>'+response.data.content+'</p>');

            $('#pageUpdate').replaceWith('<a class="btn greenBtn mr-2 pr-5 pl-5 editPage" data-pageid="'+response.data.page_no+'" data-bookid="'+response.data.book_id+'" >Edit</a>');

            $('#cancelEdit').replaceWith('<a class="btn themeBtn pr-5 pl-5 pageDel" data-pageid="'+pageNo+'" data-bookid="'+bookID+'" data-toggle="modal" data-target="#delPage">Delete</a>');

            $('#message').text(response.message);
             
            $('#alertMessage').modal("show");
          }

        }

      });

      } else {

        $('#message').text('Page characters shold less then 5000');
             
        $('#alertMessage').modal("show");
    }



  });



    $('body').on('click', '.pageDel',function(){

     var pageID= $(this).attr("data-pageID");
     

     var bookID= $(this).attr("data-bookID");

     $('#page_ID').val(pageID);
     
     $('#delete_book_ID').val(bookID);


     });

     $('body').on('click', '#deletePageBtn',function(e){

      e.preventDefault();

        var book_ID = $("input[name=book_ID]").val();

        var page_ID = $("input[name=page_ID]").val();

        
        var url="{{route('page.destroy',':id')}}";

        url=url.replace(":id",page_ID);

     

        $.ajax({

           type:'DELETE',

           url:url,

           data: { book_ID : book_ID , page_ID : page_ID  },

           success:function(response){
            let output=''; 

           if(response.error == false){

            if(response.data.pages.length > 0){
              
              output +='<div class="row" id="PageTabs">'+

              '<div class="col-md-3">'+

              '<ul class="nav nav-pills">';

              $.each(response.data.pages, function(i,val) {

          
                output +='<li class="nav-item">'+

                '<a class="nav-link'+(i ==0 ? " active" : "") +'" data-toggle="pill" href="#page'+val.page_no+'">Page '+val.page_no+'</a>'+

                ' </li>';

            });

            output +='</ul>'+

            '</div>'+

            '<div class="col-md-9">'+

            '<div class="tab-content">';

             $.each(response.data.pages, function(i,val) {
                output +='<div class="tab-pane container'+(i==0 ? " active" : "") +'" id="page'+val.page_no+'">'+
                '<div class="row">'+

                '<div class="col-md-12 text-right">'+

                '<a class="btn greenBtn mr-2 pr-5 pl-5 editPage" data-pageID="'+val.page_no+'" data-bookID="'+val.book_id+'" >Edit</a>'+

                '<a class="btn themeBtn pr-5 pl-5 pageDel" data-pageID="'+val.page_no+'" data-bookID="'+val.book_id+'" data-toggle="modal" data-target="#delPage">Delete</a>'+

                '</div>'+

                '</div>'+

                '<div class="row">'+

                '<div class="col-md-12">'+

                '<div class="pageContentBox">'+

                '<p id="ContentpageNo'+val.page_no+'">'+val.content+'</p>'+

                '</div>'+

                '</div>'+

                '</div>'+

                '</div>';

            });
           output +='</div>'+

                '</div>'+

                               
                '</div>';

          }

           
            $('#PageTabs').replaceWith(output);

            $('#delPage').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");

          }else{

            $('#delPage').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");

          }

        }

    });

  });

});
    </script>
@endpush