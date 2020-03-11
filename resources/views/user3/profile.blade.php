@extends('layouts.app')

@section('content')
@include('layouts.menu')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Membership Plans</div>

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
                   

                      <table class="table">
                          <thead class="btn-success">
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Price</th>
                             <!--  <th scope="col">Operations</th> -->
                            </tr>
                          </thead>
                          <tbody>

                        @forelse($memberships as $membership)

                        <tr class="{{$user->membership_id==$membership->id ? 'text-success' :''}}">
                              <td>{{$membership->name}}</td>
                              <td>{{$membership->price}} $</td>
                        </tr> 
                        @empty
                        @endforelse

                          
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