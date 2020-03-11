@extends('packages.PackagesLayout')

@section('content')
<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Signup
                     </h3>
                     
                  </div>
               </div>
<form id='AddPackageForm'>
@csrf
<ul style="list-style-type : none !important;">
<li> First Name          <input class="form-control input-sm" style="color: black;"  name='FirstName' type='text' required/></li>
<li> Last Name          <input class="form-control input-sm" style="color: black;"  name='LastName' type='text' required/></li>
<li> Email   <input  class="form-control input-sm"style="color: black;"  name='PackageDescription' type='email' required/></li>
<li> Password        <input id='password' class="form-control input-sm" style="color: black;"  name='password1' type='password' required/></li>
<li> Confirm Password          <input id='confirm_password' class="form-control input-sm" style="color: black;"  name='password2' type='password' required/></li>
<input id='packageid' type='hidden' value='{{$id}}' name='packageid' />
<li> <input type="button" id="AddPackagebtn" style= "float: left; margin-top: 10px;" class=" btn  themeBtn" type='submit' value='submit' > </li>
</ul>
</form>
@endsection
@push('scripts')
<script type= "text/javascript">
var packageid = $('#packageid').val();
$('body').on('click', '#AddPackagebtn',function(e){

if($('#password').val() == $('#confirm_password').val() )
{
e.preventDefault();

var Formdata = $("#AddPackageForm").serializeArray();


$.ajax({

   type: 'post',

   url:'{{ route("signup")}}',

   data: Formdata,

   success:function(response){

           alert('user created successfully');
           window.location.href = '{{route("paymentForm")}}/'+response+"/"+packageid
   },
   error:function()
   {
       alert('Error in the request');
   }

});
}
else
{
    alert('password do not matches. Please recheck');
}
});

</script>
@endpush