@extends('layouts2.auth')

@section('content')

<section class="login">
   		<div class="container">
   			<div class="row justify-content-center align-content-center">
   				<div class="col-md-12">
   					<div class="loginBox">
   						<div class="text-center mb-4">
   							<img src="{{asset('assets/img/logo.png')}}">
   						</div>
              <div class="text-center">
              <h3 style="color: #fff">Private Acces Only</h3>
				<a style="text-decoration: underline;" href="{{ route('login') }}" class="colorGrey">Member Login</a><br>
				<a style="text-decoration: underline;" href="{{ route('user.register') }}" class="colorGrey">Create Account</a>
              </div>
   					</div>
   				</div>
   			</div>
   		</div>
   	</section>
   	
@endsection
