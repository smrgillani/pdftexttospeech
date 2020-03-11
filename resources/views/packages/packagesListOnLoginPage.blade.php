@extends('packages.PackagesLayout')

@section('content')
<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Packages
                     </h3>
                  </div>
               </div>
               
                     <ul style="list-style: none;">
                     @foreach($data as $package)
                     <li>
                     <div style='margin:10px' class="card">
                        <h5 style="color: black" class="card-header">{{$package->title}}</h5>
                           <div class="card-body">
                              
                              <p style="color: black" class="card-text">{{$package->description}}</p>
                              <h6 style="color: black; float: right" class="card-title">${{$package->price}} /Month</h6>
                              <button  id='subscribepackage' class="btn themeBtn" packageid='{{$package->Id}}'>Subscribe</button>
                           </div>
                     </div>
                     </li>
                     @endforeach
                     </ul>
               
            </div>
@endsection
@push('scripts')
<script type= "text/javascript">

$('body').on('click', '#subscribepackage',function(e){

e.preventDefault();

   var url = '{{ route("SubscribePackage")}}/'+$(this).attr('packageid');


$.ajax({

   type: 'get',

   url: url,

   success:function(response){

        window.location.href = '{{route("signupUser")}}/'+response;
       
   },
   error:function()
   {
       alert('Error in the request');
   }

});

});

</script>
@endpush