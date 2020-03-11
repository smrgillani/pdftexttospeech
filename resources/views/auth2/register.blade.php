@extends('layouts2.auth')

@section('content')

<section class="login">
   		<div class="container">
   			<div class="row justify-content-center align-content-center">
   				<div class="col-md-12">
   					<div class="loginBox">
   						<div class="text-center mb-5 pb-3">
   							<img src="{{asset('assets/img/logo.png')}}">
   						</div>
   						<form method="POST" action="{{ route('register') }}">
                            @csrf

                          <div class="form-group">
						    <span class="@error('name') is-invalid @enderror">
						    <input type="text"  name="name" placeholder="User name"  class="form-control"  value="{{ old('name') }}" required autocomplete="name">
							</span>
						  </div>

						  <div class="form-group">
						    <span class="@error('email') is-invalid @enderror">
						    <input type="email"  name="email" placeholder="User email"  class="form-control"  value="{{ old('email') }}" required autocomplete="email">
							</span>
						  </div>

						  <div class="form-group">
						    <span class="@error('password') is-invalid @enderror">
						    <input type="password" name="password" placeholder="User password" autocomplete="false" class="form-control"  required>
                            </span>
						  </div>

						  <div class="form-group">
						  <span class="@error('password_confirmation') is-invalid @enderror">
						    <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="false" class="form-control"  required>
                            </span>
						  </div>

							@if(session()->has('message'))
	                        <span class="alert alert-success">
	                            {{ session()->get('message') }}
	                        </span>
	                    	@endif
						  
						    <button type="submit" class="btn themeBtn w-100 text-white p-2 mt-4">Register</button>

						</form>
   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
@endsection