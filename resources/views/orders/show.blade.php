@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Subscription
                     </h3>
                  </div>
               </div>
               <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Membership</th>
                            <th>User</th>
                            <th>Price</th>
                            @if(auth()->user()->isAdmin)
                            <th>Operations</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$order->membership->package->title}}</td>

                            <td><a href="{{route('user.index')}}">{{$order->user->name}}</a></td>
                            <td><a href="{{route('user.index')}}">$ {{$order->membership->package->price}}</a></td>
                            
                            <td>
                              <div class="d-flex">

                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMebm">
                                  <img src="{{asset('assets/img/edit.png')}}" width="" data-toggle="tooltip" title="Edit">
                                </a>
                                
                                @if(auth()->user()->isAdmin)
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="{{$order->id}}">
                                  <img src="{{asset('assets/img/deleteicon.png')}}" width="" data-toggle="tooltip" title="Delete">
                                </a>
                                @endif

                              </div>
                            </td>
                            
                          </tr>
                        </tbody>
                      </table>
                      </div>
                  </div>
               </div>
            </div>

<!-- Edit Membership Model -->

      <div class="modal fade" id="editMembership">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Edit Membership</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/Close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <form id="editMembershipForm">
              @csrf
              @method('PUT')
            <input type="hidden" name="receipt" value=" {{$order->receipt_number}}" >
            <input type="hidden" name="oldSku" value="{{$order->membership->package->sku}}">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                                <label>Membership</label>
                                <select class="form-control" id="membership_id" name="membership_id" required>
                                    <option disabled selected>Choose Membership</option>  
                                    @forelse($memberships as $membership)
                                            <option {{$order->membership->id == $membership->id ? "selected" : ' '}} value="{{$membership->package->sku}}">{{$membership->package->title}}</option>
                                            @empty
                                    @endforelse                    
                                </select>
                  </div>

                </div>
              </div>
            </div>
          

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a class="btn greenBtn mr-2" id="updateMembership">Save</a>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- End Edit Membership Model -->




<!-- Alert Message Model -->
      <div class="modal fade" id="alertMessage">
        <div class="modal-dialog modal-md">
          <div class="modal-content">



            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Message</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label id="message"></label>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
<!-- End Alert Message Model -->


@endsection

@push('scripts')



<script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script type="text/javascript">
   $(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $(() => {
          $(".editbtn").click(() => {
            $("#editMembership").modal();
          })

          //On Create Package Button
          $("#updateMembership").click(()=>{

            if($('input[name="oldSku"]').val() != $("#membership_id").val()){

              $.ajax({

               type:'POST',

               url:'{{route("switchPackage")}}',

               data:   $("#editMembershipForm").serialize(),

                success: function(msg){
                      $("tbody").append(msg);
                      $(".nothingFound").addClass('d-none')
                      $("#editMembership").modal("hide");
                      $("#message").text("Membership Updated!");
                      $("#alertModal").modal();
                      //
                      
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                     $('#validation-errors').html('');
                   $.each(XMLHttpRequest.responseJSON.errors, function(key,value) {
                       $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                   }); 

                }

              });

            }

          })
    })

    })
  
    </script>
@endpush
