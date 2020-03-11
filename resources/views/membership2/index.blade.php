@extends('layouts.app')

@section('content')
@include('layouts.menu')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Membership</div>

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

                    <div class="row">
                    <div class="col-md-12">
                      <div>

                          <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Create Membership
                            </button>

                          <div class="form-group">
                          <input type="text" name="search" id="search" class="form-control" placeholder="Search Packages" />
                         </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Membership</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                   <form method="POST" action="{{ route('membership.store')}}" enctype="multipart/form-data">
                                     @csrf
                                  <div class="modal-body">

                                          <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter membership name" required>
                                            
                                          </div>

                                          <div class="form-group">
                                            <label for="voice_type">Voice Type</label>
                                           <select class="custom-select my-1 mr-sm-2" id="voice_type" name="voice_type" required>
                                              <option disabled selected>Choose Voice Type</option>
                                              <option value="Standard">Standard</option>
                                              <option value="WaveNet">WaveNet</option>
                                              <option value="Both">Both</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="languages">Language</label>
                                            <select multiple class="form-control" id="languages" name="languages[]">
                                              
                                            </select>
                                          </div>

                                           <div class="form-group">
                                            <label for="languages">Voices</label>
                                            <select multiple class="form-control" id="voices" name="voices[]">
                                              
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" placeholder="Price" name="price" min="0" required>
                                          </div>

                                          <div class="form-group">
                                            <label for="characters_length">Length</label>
                                            <input type="text" class="form-control" id="characters_length" placeholder="Characters length" name="characters_length" required>
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
                            <div class="modal fade" id="delMembership" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Membership</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                 
                                   <form method="POST"  enctype="multipart/form-data" id="myform">
                                     @csrf
                                     @method('delete')
                                     <input type="hidden" name="membershipID" value="" id="membershipID">
                                  <div class="modal-body">
                                        
                                      <div class="alert alert-danger">Are you Sure to Delete this Membership? </div>   
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
                              <th scope="col">Price</th>
                              <th scope="col">Voice Type</th>
                              <th scope="col">Status</th>
                              <th scope="col">Character Length</th>
                              <th scope="col">Operations</th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($memberships as $membership)
                            <tr>
                              <td>{{$membership->name}}</td>
                              <td>{{$membership->price}} $</td>
                              <td>{{$membership->voice_type}}</td>
                              <td>{{$membership->status == 1 ? 'Active' : 'Deactive'}}</td>
                              <td>{{$membership->characters_length}}</td>
                              <td>
                              <a href="{{url('membership/'.$membership->id.'/edit')}}"><button type="button" class="btn btn-success">Edit</button></a>
                              <button type="button" class="btn btn-danger deletebtn" data-membershipID="{{$membership->id}}" >Delete</button>
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
   
    let voices=[];
     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
 
    $('body').on('click', '.deletebtn',function(){
      // alert('here')
     var membershipID= $(this).attr("data-membershipID");
     var url="{{route('membership.destroy',':id')}}";
     url=url.replace(":id",membershipID);
     $("#myform").attr('action', url);
     $('#membershipID').val(membershipID);
      $('#delMembership').modal('show');  // show modal
      }); 

     $('#voice_type').change(function(){
      $value=$(this).val();

      $.ajax({
      type : 'get',
      url : '{{ route("languagesearch")}}',
      data:{'search':$value},
      success:function(data){
      $('#languages').html(data);
      }
      });
    });

      $('#languages').change(function(){
      $language=$(this).val();     
      let voicetype=$('#voice_type').val();
      $.ajax({
      type : 'get',
      url : '{{ route("voicesearch")}}',
      data:{'language':$language,'voicetype':voicetype},
      success:function(data){
       $('#voices').html(data);
      }
    });
  });

      $('#search').on('keyup',function(){
      $membership=$(this).val();    
      $.ajax({
      type : 'get',
      url : '{{ route("membershipsearch")}}',
      data:{'membership':$membership},
      success:function(data){
       let output='';
        if(data.total_data>0){
          
          $.each(data.table_data, function() {
          
          output += '<tr>'+
         '<td>'+this.name +'</td>'+
         '<td>'+this.price +'</td>'+
         '<td>'+this.voice_type +'</td>'+
         '<td>'+ (this.status==1 ? "Active":"Deactive") + '</td>'+
         '<td>'+ this.characters_length +'</td>'+
         '<td>'+ '<a href="'+ 'membership/'+ this.id + '/edit'+'"><button type="button" class="btn btn-success">Edit</button></a>'+
         '<button type="button" class="btn btn-danger deletebtn" data-membershipID="'+this.id+'">Delete</button>'+'</td>'+
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
