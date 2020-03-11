@extends('layouts2.app')

@section('content')
<div class="container  pl-5 pr-5">
<div class="row mt-3">
                  <div class="col-md-12">
                  	 <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Package Name</th>
                            <th>Package Status</th>
                            <th>Change Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $user)

                          <tr>
                            <td>{{$user->name}}</td>
                            
                            
                            <td>{{$user->email}}</td>
                            <td>{{$user->Name}}</td>
                            <td><?php if($user->package_status){echo 'Active';}else{echo 'Paused';} ?></td>
                            <td><button id='changeuserstatus' type='button' class="btn  themeBtn" subscription_id='{{$user->subscribe_package_id}}' subscription_status = '{{$user->package_status}}'>Change Status</button></td>
                          </tr>
                            @empty
                          <tr>
                          <td colspan="4" align="center">No User Found</td>
                          </tr>
                        @endforelse 
                        </tbody>
                      </table>
                  </div>
                   </div>
               </div>
               </div>
@endsection
@push('scripts')
<script type= "text/javascript">
$('body').on('click', '#changeuserstatus',function(e){
   e.preventDefault();
   var url = '{{ route("ChangeSubscriptionStatus")}}/'+$(this).attr('subscription_id')+'/'+$(this).attr('subscription_status');
   $.ajax({


type: 'get',

url: url,


success:function(response){

   if(response == 1)
   {
       alert('User Status Changed');
       location.reload();
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