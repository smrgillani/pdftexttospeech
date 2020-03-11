@extends('layouts.app')

@section('content')
@include('layouts.menu')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User</div>

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

                  <div style="visibility: hidden;" id="message"></div>
                    <div class="row">
                    <div class="col-md-12">
                      <div>

                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Invite User
                            </button>
                          <div class="form-group">
                          <input type="text" name="search" id="search" class="form-control" placeholder="Search User" />
                         </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Invite User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                   <form method="POST" action="{{ route('user.store')}}" enctype="multipart/form-data">
                                     @csrf
                                  <div class="modal-body">
                                    <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">      
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                             <!-- Modal -->
                            <div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="POST"  enctype="multipart/form-data" id="myform">
                                     @csrf
                                     @method('delete')
                                     <input type="hidden" name="userID" value="" id="userID">
                                  <div class="modal-body">
                                        
                                      <div class="alert alert-danger">Are you Sure to Delete this User? </div>   
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                      </div>

                      <table class="table">
                          <thead class="btn-success">
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Status</th>
                              <th scope="col">Operations</th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($users as $user)

                            <tr>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{ $user->status == 1 ? 'Active':'Deactive' }}</td>                             
                              <td>
                              <a href="{{url('user/'.$user->id.'/edit')}}"><button type="button" class="btn btn-success">Edit</button></a>
                              <button type="button" class="btn btn-danger deletebtn" data-userID="{{$user->id}}" >Delete</button>
                             
                              <button type="button" class="btn btn-primary resendbtn" data-userEmail="{{$user->email}}">Resend Link</button>
                              
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
     var userID= $(this).attr("data-userID");
     var url="{{route('user.destroy',':id')}}";
     url=url.replace(":id",userID);
     $("#myform").attr('action', url);
     $('#userID').val(userID);
      $('#delUser').modal('show');  // show modal
      });

    $('body').on('click', '.resendbtn',function(){
      var userEmail =  $(this).attr("data-userEmail");
        
        $.ajax({

           type:'post',

           url:'{{ route("user.store")}}',

           data: {email:userEmail},

           success:function(data){

            $('#message').text(data.message);
              $("#message").addClass("alert alert-success");
              $('#message').css('visibility', 'visible');
              
             

           }
        });
      });

      $('#search').on('keyup',function(){
      $user=$(this).val();    
      $.ajax({
      type : 'get',
      url : '{{ route("usersearch")}}',
      data:{'user':$user},
      success:function(data){
       let output='';
        if(data.total_data>0){
          
          $.each(data.table_data, function() { 
          output += '<tr>'+
         '<td>'+this.name +'</td>'+
         '<td>'+this.email +'</td>'+
         '<td>'+ (this.status==1 ? "Active":"Deactive") + '</td>'+
         '<td>'+ '<a href="'+ 'user/'+ this.id + '/edit'+'"><button type="button" class="btn btn-success">Edit</button></a>'+
         '<button type="button" class="btn btn-danger deletebtn" data-userID="'+this.id+'">Delete</button>'+'</td>'+
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