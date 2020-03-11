@extends('layouts2.app')
@section('content')
<div class="container  pl-5 pr-5">
<div class="row">
   <div class="col-md-12">
      <h3>
         Add Package
      </h3>
   </div>
</div>
<form id='AddPackageForm'>
   @csrf
   <ul style="list-style-type : none !important;">
      <li> Package Name          <input class="form-control input-sm" style="color: black;"  name='title' type='text' required></input></li>
      <li> Package Sku          <input class="form-control input-sm" style="color: black;"  name='sku' type='text' required></input></li>
      <li> Package Description   <input  class="form-control input-sm"style="color: black;"  name='description' type='text' required></input></li>
      <li> Package Price        <input type = "number" class="form-control input-sm" style="color: black;"  name='price' required></input></li>
      <li> Rebill Comission       <input type = "number" class="form-control input-sm" style="color: black;"  name='rebillCommission' required></input></li>
      <li> Rebill Price        <input type = "number" class="form-control input-sm" style="color: black;"  name='rebillPrice' required></input></li>
      <input type="hidden" name="currency" value="USD">
      <input type="hidden" name="language" value="EN">
      <input type="hidden" name="site" value="audiogen">
      <input type="hidden" name="categories" value="EBOOK">
      <input type="hidden" name="duration" value="30">
      <input type="hidden" name="frequency" value="MONTHLY">
      <input type="hidden" name="pitchPage" value="http://www.audiorobot.net">
      <input type="hidden" name="thankYouPage" value="https://www.audiorobot.net">
      <input type="hidden" name="trialPeriod" value="0">
      <input type="hidden" name="digital" value="true">
      <input type="hidden" name="physical" value="false">
      <input type="hidden" name="digitalRecurring" value="true">
      <input type="hidden" name="physicalRecurring" value="false">
      <!-- <li> 
         Membership        <input type = "text" class="form-control input-sm" style="color: black;"  name='PackagePrice' required></input>
         </li> -->
     <!--  <li>
         <div class="form-group">
            <label>Membership</label>
            <select id="voice_type" name="membership_id" class="form-control" required="">
               <option disabled="" selected="">Choose membership</option>
               <option value="Standard">Standard</option>
                  <option value="WaveNet">WaveNet</option>
                  <option value="Both">Both</option>
               @foreach($data as $membership)
               <option value="{{$membership->id}}">{{$membership->name}}</option>
               @endforeach
            </select>
         </div>
      </li> -->
      <li> <input type="button" id="AddPackagebtn" style= "float: left; margin-top: 10px;" class=" btn  themeBtn" type='submit' value='submit' > </li>
   </ul>
</form>
@endsection
@push('scripts')
<script type= "text/javascript">
   $('body').on('click', '#AddPackagebtn',function(e){
   
   e.preventDefault();
   
   var Formdata = $("#AddPackageForm").serializeArray();
   
   
   $.ajax({
   
      type: 'post',
   
      url:'{{ route("AddPackage")}}',
   
      data: Formdata,
   
      success:function(response){
   
          if(response == 1)
          {
              alert('data added in the db');
              // window.location.href = '{{route("Packages")}}'
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
