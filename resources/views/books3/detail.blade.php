@extends('layouts.app')

@section('content')
@include('layouts.menu')
<img src="{{asset('images/processing.gif')}}" id="gif" style="display: block; margin: 0 auto; width: 100px; visibility: hidden;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                    @if ($errors->any())
                      <div class="alert alert-danger"> 
                        {{ implode('', $errors->all(':message')) }}
                      </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
          <div style="visibility: hidden;" id="message"></div> 
          <div class="card">
            <div class="card-header">Chapters</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div>

                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Create Chapter
                            </button>
                          
                          <a class="btn btn-primary" href="{{route('bookaudio',$book->id)}}">Listen</a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Chapter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                   <form method="POST"  enctype="multipart/form-data" id="chapterform">
                                     @csrf
                                  <div class="modal-body">
                                        <input type="hidden" id="book_id" name="book_id" value="{{\Request::segment(2)}}">
                                        <input type="hidden" name="total_pages" value="{{count($book->pages)}}">
                                          <div class="form-group">
                                            <label for="chapterName">Name</label>
                                            <input type="text" class="form-control" id="chapterName" name="chapterName"  placeholder="Enter chapter name">
                                            
                                          </div>
                                          <div class="form-group">
                                            <label for="pageFrom">Page From</label>
                                            <input type="number" class="form-control" min="1" max="{{count($book->pages)}}"id="pageFrom" placeholder="Page From" name="pageFrom">
                                          </div>

                                          <div class="form-group">
                                            <label for="pageTo">Page To</label>
                                            <input type="number" class="form-control" min="1" max="{{count($book->pages)}}" id="pageTo" placeholder="Page To" name="pageTo">
                                          </div>
                                         
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                             <!-- Modal -->
                            <div class="modal fade" id="delChapter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Chapter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"> &times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="POST"  enctype="multipart/form-data" id="myform">
                                     @csrf
                                     @method('delete')
                                     <input type="hidden" name="chapterID" value="" id="chapterID">
                                  <div class="modal-body">
                                        
                                      <div class="alert alert-danger">Are you Sure to Delete this Chapter? </div>   
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                          <div class="modal fade" id="delPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Page</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"> &times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="post"  enctype="multipart/form-data" id="pageDelForm">
                                    @csrf      
                                  <div class="modal-body">
                                        
                                    <input type="hidden" id="book_page_ID" name="book_page_ID" value="">
                                      <div class="alert alert-danger">Are you Sure to Delete this Page? </div>   
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                        <div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"> &times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="POST"  enctype="multipart/form-data" id="pageEdit">
                                     @csrf
                                    
                                    <textarea class="form-control" id="editPageContent" rows="5"  maxlength="4950"></textarea> 
                                  <div class="modal-body">
                                        
                                        
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                      </div>

                      <table class="table" >
                          <thead class="btn-success">
                            <tr>
                            
                              <th scope="col">Name</th>
                              <th scope="col">Page From</th>
                              <th scope="col">Page To</th>
                              <th scope="col">Operations</th>
                            </tr>
                          </thead>
                          <tbody id="chapterBody">
                            @foreach($book->chapters as $chapter)
                            <tr>
                             
                              <td>{{$chapter->name}}</td>
                              <td>{{$chapter->pageFrom->page_no}}</td>
                              <td>{{$chapter->pageTo->page_no}}</td>

                              <td>
                              <a href="{{ url('chapter/'.$chapter->id.'/edit')}}"><button type="button" class="btn btn-success">Edit</button></a>
                              <button type="button" class="btn btn-danger deletebtn" data-chapterID={{$chapter->id}} >Delete</button>
                               
                              </td>                       
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                         <div class="card">
            <div class="card-header">Conver Text into Speech</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div>

                        <form method="POST" enctype="multipart/form-data" id="processtts">
                           
                          @csrf
                          <!--   <div class="form-group">
                              <label for="exampleFormControlTextarea1">Text</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="text"></textarea>
                            </div> -->
                  
                                <input type="hidden" name="book_id" value="{{$book->id}}">
                                <input type="hidden" name="no_of_pages" value="{{$book->no_of_pages}}">
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                      <label class="mr-sm-2" for="language">Language</label>
                                      <select class="custom-select mr-sm-2" id="language" name="language" required>
                                        <option disabled selected>Choose Language</option>
                                      @forelse ($language as $lan)
                                        
                                                <option value="{{ $lan->code }}">{{ $lan->name }}</option>
                                            @empty
                                               
                                            @endforelse
                                      </select>
                                      <span class="help-block text-danger language-error"></span>
                                    </div>
                                
                                  
                                   <div class="col-md-4 mb-3">
                                        <label class="mr-sm-2" for="voicename">Voice Name</label>

                                        <select class="custom-select mr-sm-2" id="voicename" name="voicename" required>
                                        <option disabled selected>Choose Voice</option>
                                        
                                         
                                        </select>
                                        <span class="help-block text-danger voicename-error"></span>
                                    </div>

                                     <div class="col-md-4 mb-3">
                                        <label class="mr-sm-2" for="ssml_gender">Gender</label>
                                        <select class="custom-select mr-sm-2" id="ssmlgender" id="ssmlgender" name="ssml_gender" required>
                                        <option disabled selected>Choose Gender</option>
                                         
                                        </select>
                                        <span class="help-block text-danger ssml_gender-error"></span>

                                    </div>

                                    
                                    <div class="col-md-4 mb-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Pitch</label>
                                        <input type="range" min="-20.0" max="20.0" class="slider" id="myRange" name="pitch">
                                        <span class="help-block text-danger pitch-error"></span>

                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Speed</label><br>
                                        <input type="range" min="0.25" max="4.0"  class="slider"  name="speed">
                                        <span class="help-block text-danger speed-error"></span>

                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <button type="submit"  class="btn btn-primary">Process</button>
                                  </div> 
                     </form>
                    </div>
                  </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
          </div>
         
            <div class="card">
                <div class="card-header">Pages</div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                        <div id="list-example" class="list-group">
                          @foreach($book->pages as $page)
                          <a class="list-group-item list-group-item-action" href="#list-item-{{$page['page_no']}}">Page {{$page['page_no']}}</a>

                          @endforeach
                        </div>
                    </div>
                    <div class="col-md-10">
                      <div class="tabContent" style="height: 500px;overflow-x: auto;">
                        <div data-spy="scroll" data-target="#list-example" data-offset="0" class="scrollspy-example">
                          @foreach($book->pages as $page)
                        <h4 id="list-item-{{$page['page_no']}}">Page {{$page['page_no']}}</h4>
                        <button type="button" class="btn btn-success page" id="PageID_{{$page['page_no']}}"  >Edit</button>
                        <button type="button" class="btn btn-danger pageDel" id="PageID_{{$page['page_no']}}"  >Delete</button>
                        <p id="ContentPageID_{{$page['page_no']}}">{{$page['content']}}</p>
                         @endforeach
                        
                      </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
            </div>
             
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
   $(function() {
     let voices=[];
     
     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $('body').on('click', '.deletebtn',function(){
     var chapterID= $(this).attr("data-chapterID");
     var url="{{route('chapter.destroy',':id')}}";
     url=url.replace(":id",chapterID);
     $("#myform").attr('action', url);
     $('#chapterID').val(chapterID);
      $('#delChapter').modal('show');  // show modal
      });

    $('.page').click(function(){
      $(this).attr('id');
     let pageID=$(this).attr('id');
     let pageContent=$('#Content'+ pageID) .text();
      $('#editPage').modal('show');  // show modal
     $('#editPageContent').val(pageContent);
     $('#book_page_ID').val(pageID);
    });

      
    $('.pageDel').click(function(){
    $(this).attr('id');
    let pageID=$(this).attr('id');
    $('#delPage').modal('show');
    $('#book_page_ID').val(pageID);
    });

    


     $('#pageDelForm').on( 'submit', function(e) {
        e.preventDefault();
     var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
    var ajaxurl="{{route('page.destroy',':id')}}";
    var pageId=$('#book_page_ID').val().replace("PageID_", "");
  

     ajaxurl=ajaxurl.replace(":id",id);
      $.ajax({
      type: 'delete',
      url : ajaxurl,
      data:{'book_id':id,'page_id':pageId},
      success:function(data){
        $('#delPage').modal('hide');
        $('#message').text(data.message);
        $("#message").addClass("alert alert-success");
            $('#message').css('visibility', 'visible');
        window.location.reload();    
      }
      });
    });


    $('#pageEdit').on( 'submit', function(e) {
        e.preventDefault();

     var url = window.location.pathname;

    var id = url.substring(url.lastIndexOf('/') + 1);

    var ajaxurl="{{route('pageedit',':id')}}";

    var pageId=$('#book_page_ID').val().replace("PageID_", "");

    var content=$('#editPageContent').val();

     ajaxurl=ajaxurl.replace(":id",id);

    var pageId=$('#book_page_ID').val().replace("PageID_", "");


      $.ajax({
      type: 'get',
      url : ajaxurl,
      data:{'book_id':id,'page_id':pageId,'content':content},
      success:function(data){
        $('#editPage').modal('hide');
        $('#message').text(data.message);
        $("#message").addClass("alert alert-success");
          $('#message').css('visibility', 'visible');
         window.location.reload();    
      }
    });
    });



      $('#language').change(function(){
      $value=$(this).val();

      $.ajax({
      type : 'get',
      url : '{{ route("uservoices")}}',
      data:{'language':$value},
      success:function(data){
      $('#voicename').html(data);
      
      }
      });
    });



    $('#voicename').change(function(){
      $value=$(this).val();
      $.ajax({
      type : 'get',
      url : '{{ route("voicegender")}}',
      data:{'voicename':$value},
      success:function(data){
      $('#ssmlgender').html(data);
      }
      });
    });

     $('#processtts').on( 'submit', function(e) {
        e.preventDefault();
  
        $('#gif').css('visibility', 'visible');
        var book_id = $("input[name='book_id']").val();
        
        var no_of_pages = $("input[name='no_of_pages']").val();
        
        var language = $("#language").val(); 
        
        var ssml_gender = $("#ssmlgender").val();

        var voicename = $("#voicename").val();

        var pitch = $("input[name='pitch']").val();
        
        var speed = $("input[name='speed']").val();

        $.ajax({

           type:'post',

           url:'{{ route("process")}}',

           data: {book_id:book_id, no_of_pages:no_of_pages, language:language,ssml_gender:ssml_gender,voicename:voicename,pitch:pitch,speed:speed},

           success:function(data){
            $('#gif').css('visibility', 'hidden');

            $('#message').text(data.message);
             

           },
            error: function( json )
            {
                if(json.status === 422) {
                  $('#gif').css('visibility', 'hidden');

                    var errors = json.responseJSON;

                    $.each(json.responseJSON, function (key, value) {
                  
                      // $('.'+key+'-error').removeClass( "help-block" )
                      // console.log('.'+key+'-error');
                        $('.'+key+'-error').html(value);
                    });
                } else {
                    // Error
                    // Incorrect credentials
                    // alert('Incorrect credentials. Please try again.')
                }
            }

        });


      }); 

   
          $('#chapterform').on( 'submit', function(e) {
        e.preventDefault();

        var book_id = $("input[name='book_id']").val();
        
        var total_pages = $("input[name='total_pages']").val();
        
        var chapterName = $("input[name='chapterName']").val();
        
        var pageFrom = $("input[name='pageFrom']").val();

        // var voicename = $("#voicename").val();

        var pageTo = $("input[name='pageTo']").val();
        

        $.ajax({

           type:'post',

           url:'{{ route("chapter.store")}}',

           data: {book_id:book_id, total_pages:total_pages, chapterName:chapterName,pageFrom:pageFrom,pageTo:pageTo},

           success:function(data){

            $('#exampleModal').modal('toggle');
            if(data.error == false && data.data == null){
              $('#message').text(data.message);
              $("#message").addClass("alert alert-danger");
              $('#message').css('visibility', 'visible');
              setTimeout(function() {
            $("#message").css('visibility', 'hidden')
        }, 5000); 
            }

            if(data.error == false){
            let output=''; 
            if(data.data.length > 0){
              $.each(data.data, function() {
                 var url="{{route('chapter.edit',':id')}}";
              url=url.replace(":id",this.id);
            output += '<tr>'+
             '<td>'+this.name +'</td>'+
             '<td>'+this.page_from +'</td>'+
             '<td>'+this.page_to +'</td>'+
             '<td>'+ '<a href="'+url+'"><button type="button" class="btn btn-success">Edit</button></a>'+
             '<button type="button" class="btn btn-danger deletebtn" data-chapterID="'+this.id+'">Delete</button>'+'</td>'+
            '</tr>';
              });

            } else{
            output += '<tr>'+
            '<td align="center" colspan="4">No Data Found</td>'
            +'</tr>';
            
          }
             

            $('#message').text(data.message);
            $("#message").addClass("alert alert-success");
            $('#message').css('visibility', 'visible');
            $('#chapterBody').html(output);
            setTimeout(function() {
            $("#message").css('visibility', 'hidden')
        }, 5000); 
            
          }
            else{
            $('#message').text(data.message);
              $("#message").addClass("alert alert-danger");
              $('#message').css('visibility', 'visible');
              setTimeout(function() {
            $("#message").css('visibility', 'hidden')
        }, 5000); 
            }
           }

        });


      });


  });
    </script>
@endpush
