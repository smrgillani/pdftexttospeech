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

              @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
               @endif

   						<form method="POST" action="{{ route('password.email') }}">
                @csrf
						  <div class="form-group">
						    
                            <span class="@error('email') is-invalid @enderror">
                                <input type="email"  name="email" placeholder="User email"  class="form-control "  value="{{ old('email') }}" required autocomplete="email">
                                   @error('email')
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </span>
						    

						  </div>
						  
						  <button type="submit" class="btn themeBtn w-100 text-white p-2 mt-4"> {{ __('Send Password Reset Link') }}</button>

						</form>



   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
@endsection
