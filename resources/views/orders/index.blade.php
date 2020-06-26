@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
               <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Orders
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
                            {{-- <th>Operations</th>--}}
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($orders as $order)
                          <tr>
                            <td>{{$order->membership->package->title}}</td>

                            <td><a href="{{route('user.index')}}">{{$order->user->name}}</a></td>



                           {{-- <td>
                              <div class="d-flex">

                                <a href="" class="mr-4 editbtn" data-toggle="modal" data-target="#editMembership" >
                                  <img src="assets/img/edit.png" width="" data-toggle="tooltip" title="Edit">
                                </a>
                                <a href="" class="mr-4 deletebtn" data-toggle="modal" data-target="#deleteMembership" data-membershipID="{{$order->id}}">
                                  <img src="assets/img/deleteicon.png" width="" data-toggle="tooltip" title="Delete">
                                </a>

                              </div>
                            </td> --}}
                          </tr>
                          @empty
                          <tr>
                          <td colspan="6" align="center">No, Orders Found</td>
                          </tr>
                           @endforelse

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
                <img src="assets/img/close.png">
              </button>
            </div>

            <!-- Modal body -->
            <form>
            <input type="hidden" name="MembershipID" value="" id="MembershipID">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                               <label>Name</label>
                               <input type="text" id="editname" name="name" placeholder="Enter Membership Name" class="form-control" required>
                              </div>

               

                </div>
              </div>
            </div>
          </form>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <a class="btn greenBtn mr-2" id="membershipUpdate">Save</a>
            </div>

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

  
    </script>
@endpush
