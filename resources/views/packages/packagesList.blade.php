@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Packages
                     </h3>
                     <div style="float: right">
                   
                            <!-- <button type="button" id='viewsubscribers' class="btn  themeBtn" data-toggle="modal" data-target="#myModal"> -->
                            </div>
                  </div>
               </div>
               
                     <ul style="list-style: none;">
                     @foreach($data as $membership)
                     <li>
                     <div style='margin:10px' class="card">
                        <h5 style="color: black" class="card-header">{{$membership->package->title}}</h5>
                           <div class="card-body">
                              
                              <p style="color: black" class="card-text">{{$membership->package->description}}</p>
                              <h6 style="color: black; float: right" class="card-title">${{$membership->package->price}} /Month</h6>
                              <a href="{{config('services.clickBank.baseLink').$membership->package->sku}}" target="_blank" id='subscribepackages' class="btn themeBtn" packageid='{{$membership->package->Id}}'>Subscribe</a>
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

       if(response == 1)
       {
           alert('package subscribed successfully');
       }
       if(response == 2)
       {
          alert('package is already subscribed');
       }
       else
       {
           alert('There is some issue. Package not subscribed')
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