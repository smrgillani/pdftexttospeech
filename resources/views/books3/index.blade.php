@extends('layouts.app')
@section('content')
@include('layouts.menu')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Books</div>

                <div class="card-body">
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
                        <div class="form-group">
                          <input type="text" name="search" id="search" class="form-control" placeholder="Search Book" />
                         </div>
                      <table class="table">
                          <thead class="btn-success">
                            <tr>
                              <th scope="col">File Name</th>
                              <th scope="col">No of Page</th>
                              <th scope="col">Options</th>
                            </tr>
                          </thead>
                          <tbody>
                       
                          @foreach($books as $book)
                          <tr>
                            <td>{{$book['name']}}</td>
                            <td>{{$book['no_of_pages']}}</td>
                            <td>
                              <a href="{{ url('/book/'.$book['id']) }}"><button type="button" class="btn btn-success">View</button></a>
                              <a href="{{ route('bookaudio',$book['id']) }}"><button type="button" class="btn btn-success">Listen</button></a>
                              <button type="button" class="btn btn-danger deletebtn" data-userID="{{$book['id']}}" >Delete</button>
                            </td>
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

                            <div class="modal fade" id="delBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="POST"  enctype="multipart/form-data" id="myform">
                                     @csrf
                                     @method('delete')
                                     <input type="hidden" name="bookID" value="" id="bookID">
                                  <div class="modal-body">
                                        
                                      <div class="alert alert-danger">Are you Sure to Delete this Book? </div>   
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
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
     var bookID= $(this).attr("data-userID");
     var url="{{route('book.destroy',':id')}}";
     url=url.replace(":id",bookID);
     $("#myform").attr('action', url);
     $('#bookID').val(bookID);
      $('#delBook').modal('show');  // show modal
      });
      
      $('#search').on('keyup',function(){
      $book=$(this).val();    
      $.ajax({
      type : 'get',
      url : '{{ route("booksearch")}}',
      data:{'book':$book},
      success:function(data){
       let output='';
        if(data.total_data>0){
          
          $.each(data.table_data, function() {
          
          output += '<tr>'+
         '<td>'+this.name +'</td>'+
         '<td>'+this.no_of_pages +'</td>'+
         '<td>'+ '<a href="'+ 'book/'+ this.id +'"><button type="button" class="btn btn-success">View</button></a>'+
         '</td>'+
        '</tr>';
        });
    

          }else{
            output += '<tr>'+
            '<td align="center" colspan="6">No Data Found</td>'
            +'</tr>';
            
          }
      $('tbody').html(output);
      }
    });
  });


  });
    </script>
@endpush