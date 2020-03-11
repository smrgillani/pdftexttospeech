

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

@if($data->count()>0)
@foreach($data as $membership)
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
@else
<tr>
        <td align="center" colspan="6">No Data Found</td>
       </tr>
@endif

 