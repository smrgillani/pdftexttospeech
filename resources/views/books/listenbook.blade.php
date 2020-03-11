@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
               <div class="row mt-3">
                  <div class="col-md-12">
                      
                     <div class="cardBox audioBox">
                       <h5>

                         {{$audio ->language }}
                       </h5>
                       <div class="d-flex justify-content-center  align-items-center">
                           
                              <div class="mr-4">
                               
                                     <img src="{{asset('assets/img/audioListen.png')}}">
                                
                                
                                
                              </div>
                               
                           
                           <div class="ml-2 w-70">
                               <div class="player" data-audio="{{asset($audio->audio_path)}}"></div>
                              
                           </div>
                        </div>
                     </div>
                    
                  </div>
                </div> 
               </div> 


@endsection

@push('scripts')
<script src="{{asset('assets/js/soundmanager2.js')}}"></script> 
<script src="{{asset('assets/js/player.js')}}"></script> 
    <script type="text/javascript">
    $(document).ready(function(){

     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $(".player").each(function(){

          $(this).player($(this).attr("data-audio"));

        });

   });
</script>
@endpush