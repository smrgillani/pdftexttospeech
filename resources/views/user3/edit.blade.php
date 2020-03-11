@extends('layouts.app')
@section('content')
@include('layouts.menu')

<form method="POST" action="{{ route('user.update',$user->id)}}" enctype="multipart/form-data">
                                  @csrf
                          				@method('PUT')
                                  <div class="modal-body">
                                            <input type="hidden"  name="id" value="{{$user->id}}">
                                          <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" value="{{$user->name}}">
                                            
                                          </div>

                                          <div class="form-group">
                                            <label for="voice_type">Status</label>
                                           <select class="custom-select my-1 mr-sm-2" id="status" name="status" required>
                                              <option disabled selected>Choose Status</option>
                                              <option value="1"  {{ $user->status == 1 ? 'selected':'' }}>Active</option>
                                              <option value="0" {{ $user->status == 0 ? 'selected':'' }}>Deactive</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="voice_type">Membership Plan</label>
                                           <select class="custom-select my-1 mr-sm-2" id="membership_id" name="membership_id">
                                             <option {{$user->membership_id== null ?"disabled selected":""}} >
                                            @forelse($memberships as $membership)
                                           Choose Membership Type</option>
                                            <option {{$user->membership_id==$membership->id?"selected":""}} value="{{$membership->id}}">{{$membership->name}}</option>
                                            @empty
                                            @endforelse
                                             
                                            </select>
                                          </div>

                         
                                         
                                  </div>
                                  <div class="modal-footer">
                                   
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                  </form>
@endsection