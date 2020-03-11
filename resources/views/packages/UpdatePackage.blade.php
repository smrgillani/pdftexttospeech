@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Update Package
                     </h3>
                     
                  </div>
               </div>
<ul>
               @foreach($data as $package)
<form id='updatepackageform'>
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Package Name</label>
    <input name='packageName' type="email" value='{{$package->Name}}' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Package Name">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Package Description</label>
    <input name='packageDescription' type="text" value='{{$package->Description}}' class="form-control" id="exampleInputPassword1" placeholder="Package Description">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Package Price</label>
    <input name='packagePrice' type="Number" value='{{$package->Price_month}}' class="form-control" id="exampleInputPassword1" placeholder="Package Price">
    <input type='hidden' name='id' value='{{$package->Id}}'>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  </div>
  <button id='submitForm' type="submit" class="btn themeBtn">Update</button>
</form>

@endforeach

</ul>
</div>
@endsection
@push('scripts')
<script type= "text/javascript">

$('body').on('click', '#submitForm',function(e){

e.preventDefault();

   var url = '{{ route("UpdatePackage")}}';

   var formData = $("#updatepackageform").serializeArray();

$.ajax({

   type: 'post',

   url: url,

   data: formData,

   success:function(response){

       if(response == 1)
       {
           alert('Data updated successfully');
           window.location.href = '{{route("Packages")}}'
       }
       else
       {
           alert('There is some issue. Package not added')
       }
   },
   error:function()
   {
       alert('Error in the request');
   }

});

});

</script>
@endpush