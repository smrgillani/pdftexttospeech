@extends('layouts2.app')

@section('content')

			<div class="container  pl-5 pr-5">
             <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Process Audio (Last Step)
                     </h3>
                  </div>
               </div>

              <div class="row mt-3" id="audioPlayerBox">

                  <div class="col-md-12">

                    <div class="downloadIcon">
                      <i class="fa fa-times pull-right" id="closePlayer" aria-hidden="true"></i>
                    </div>
                      
                  

                     <div class="cardBox audioBox">
                       <h5 id="title">
                       
                         
                       </h5>
                       <div class="d-flex justify-content-center  align-items-center">
                           
                              <div class="mr-4">
                               
                                     <img src="{{asset('assets/img/audioListen.png')}}">
                                
                                
                                
                              </div>
                               
                           
                           <div class="ml-2 w-70">
                               <div id="player" class="player"></div>
                              
                           </div>

                          <div class="downloadIcon">
                          <a href="" download="">  <i class="fa fa-download"></i></a>
                           
                           </div>
                        </div>
                     </div>
                    
                  </div>
                </div> 


				     
               <div class="row mt-5">
                 <div class="col-md-12">
                   <div class="convertTextSpeech cardBox">
                    <a class="btn newThemeBtnStyle mr-2 pull-right" href="{{route('book.chapter',$book->id)}}">Previous</a>
                     <h5>
                       Convert Text into Speech
                     </h5>
                   
                       <form>

                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <input type="hidden" name="book_name" value="{{$book->name}}">
                        <input type="hidden" name="no_of_pages" value="{{$book->no_of_pages}}">


                         <div class="row">
                           <div class="col-md-12">
                             <div class="form-group">
                                <label>Demo Text</label>
                                <textarea name="" style="height: 100px !important;" readonly  class="form-control" id="demotext" cols="30" rows="10">Text-to-Speech converts text into human-like speech in more than 180 voices across 30+ languages and variants. It applies groundbreaking research in speech synthesis (WaveNet) and Google's powerful neural networks to deliver high-fidelity audio.</textarea>
                                <!-- <input height="200" class="form-control" id="demotext" value="" readonly /> -->
                              </div>
                           </div>
                          
                           <div class="col-md-6">
                             <div class="form-group">
                                <label>Language</label>
                                <select class="form-control fileprocess" id="language" name="language" required>
                                  <!-- <option selected="" disabled="">Choose Language</option> -->
                                  @forelse ($language as $key=>$lan)
                                 
                                  <option value="{{ $lan->code }}" @if($lan->code == 'en-GB') selected @endif>{{ $lan->name }}</option>

                                  @empty            
                                  @endforelse
                                </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                             <div class="form-group">
                                <label>Voice Name</label>
                                <select class="form-control fileprocess" id="voicename" name="voicename" required>
                                  <!-- <option selected="" disabled="">Choose Voice</option> -->
                                 
                                </select>
                              </div>
                           </div>
                           <div >
                             <div class="form-group">
                                <select class="form-control fileprocess" id="ssmlgender" id="ssmlgender" name="ssml_gender" required>
                                  <option selected="" disabled="">Choose Gender</option>
                                  
                                </select>
                              </div>
                           </div>
                         </div>
                         <div class="row mt-4">
                           <div class="col-md-4">
                            <div class="d-flex">
                              <label class="mr-3 mb-0">Pitch</label>
                              <div class="w-100 p-relative">
                                <input type="range" name="pitch" min="-20.0" max="20.0" class="slider" value="0.00" step="0.4" id="myRange">
                                <label class="rangeValue">50</label>
                              </div>
                              
                            </div>
                            
                           </div>
                           <div class="col-md-4">
                            <div class="d-flex">
                              <label class="mr-3 mb-0">Speed</label>
                              <div class="w-100 p-relative">
                                <input type="range" name="speed" value="1.00" step="0.03"  min="0.25" max="4.00"  class="slider" id="myRange">
                                <label class="rangeValue">50</label>
                              </div>
                            </div>
                            
                           </div>
                          
                         </div>
                         <div class="row mt-3">
                           <div class="col-md-12 text-right">
                            <a class="btn themeBtn pr-5 pl-5" id="ProcessTest">Speak</a>
                            <a class="btn themeBtn pr-5 pl-5" id="ProcessTts">Process & Finish</a>
                           </div>
                         </div>
                       </form>
                   </div>
                 </div>
               </div>

              </div>

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
  <script src="{{asset('assets/js/soundmanager2.js')}}"></script> 
  <script src="{{asset('assets/js/player.js')}}"></script> 
    <script type="text/javascript">

   $(function() {

    $('#ssmlgender').hide();

    $('#audioPlayerBox').hide();

    var $language=$("#language").val();

     $.ajax({

      type : 'get',
      url : '{{ route("userdefaultvoices")}}',
      data:{'language':$language},
      success:function(data){
      $('#voicename').html(data);
      
      
      }
    });

        setTimeout(function() { 

    var voicename=$("#voicename option:first").val();

     if(voicename !== 'undefined'){
        console.log(voicename)
            $.ajax({

      type : 'get',
      url : '{{ route("voicegender")}}',
      data:{'voicename':voicename},
      success:function(data){
        console.log(data)
      $('#ssmlgender').html(data);

        }
      });

     }

        }, 50);
  
    
    

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

     document.querySelectorAll("#myRange").forEach(function(el) {  



            el.oninput =function(){   
            $(this).next(".rangeValue").text($(this).val());
            console.log(  $(this).next(".rangeValue").text($(this).val()));
            var valPercent = (el.valueAsNumber  - parseInt(el.min)) / (parseInt(el.max) - parseInt(el.min));
              var style = 'background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, color-stop('+ valPercent+', #FA6800), color-stop('+ valPercent+', #9298C5));';
              el.style = style;
            };
            el.oninput();
          });

    $('#closePlayer').click(function(){


      $('#audioPlayerBox').hide();

    });

      $('#language').change(function(){
      $value=$(this).val();

      $.ajax({

      type : 'get',
      url : '{{ route("uservoices")}}',
      data:{'language':$value},
      success:function(data){
      $('#voicename').html(data);
      
        }
      });

    });

      $('#language_demo').change(function(){
      $value=$(this).val();

      $.ajax({

      type : 'get',
      url : '{{ route("uservoicesdemo")}}',
      data:{'language':$value},
      success:function(data){
      $('#voicename_demo').html(data);
      
        }
      });

    });

    $('#voicename').change(function(){

      $value=$(this).val();

      $.ajax({

      type : 'get',
      url : '{{ route("voicegender")}}',
      data:{'voicename':$value},
      success:function(data){

      $('#ssmlgender').html(data);

        }
      });
    });

    $('#voicename_demo').change(function(){

      $value=$(this).val();

      $.ajax({

      type : 'get',
      url : '{{ route("voicegenderdemo")}}',
      data:{'voicename':$value},
      success:function(data){

      $('#ssmlgender_demo').html(data);

        }
      });
    });

    $('body').on('click', '#ProcessTest',function(e){
      e.preventDefault();

      var demotext=$("#demotext").val();

    

      var language = $("#language").val();


      var voicename = $("#voicename").val();

      var ssml_gender = $("#ssmlgender").val();

     
      var pitch = $("input[name='pitch']").val();
        
      var speed = $("input[name='speed']").val();

        var checkAll = true;
     

      $.each($("select"),function(element){

        if($(this).val()==null){
          $(this).addClass("is-invalid");
          checkAll=false;
        }
        else{
          $(this).removeClass("is-invalid");
        }
      })  

        if((checkAll == true) && (text = true)){

          window.onbeforeunload = function() {
           return "Do you really want to leave this page?";
          
        };

        $('body').addClass("main-dashboard loader");


          $.ajax({

           type:'post',

           url:'{{ route("testprocess")}}',

           data: { demotext:demotext,language:language,ssml_gender:ssml_gender,voicename:voicename,pitch:pitch,speed:speed },

           success:function(response){
            
            window.onbeforeunload = null;
            $('body').removeClass("loader");
           if(response.error == false){
            $('#message').text(response.message);
               
            $('#alertMessage').modal("show");
                $('#player').html("");
                $('#player').player("{{asset('Demo/demo.mp3')}}");
                $('#audioPlayerBox').show();

                $(".downloadIcon a").attr("href","{{asset('Demo/demo.mp3')}}");
           }else{
            $('#message').text(response.message);
               
            $('#alertMessage').modal("show");
           }

          }

        });

    }
  });

      $('body').on('click', '#ProcessTts',function(e){

      e.preventDefault();

      var language = $("#language").val();


      var voicename = $("#voicename").val();

      var ssml_gender = $("#ssmlgender").val();

    
      var pitch = $("input[name='pitch']").val();
        
      var speed = $("input[name='speed']").val();

      var book_id = $("input[name='book_id']").val();

      var book_name = $("input[name='book_name']").val();
        
      var no_of_pages = $("input[name='no_of_pages']").val();

      var checkAll = true;
    
      $.each($("select"),function(element){

        if($(this).val()==null){
          $(this).addClass("is-invalid");
          checkAll=false;
        }
        else{
          $(this).removeClass("is-invalid");
        }
      })

      if(checkAll == true){

        window.onbeforeunload = function() {
           return "Do you really want to leave this page?";
          
        };

        $('body').addClass("main-dashboard loader");
          

          $.ajax({

           type:'post',

           url:'{{ route("process")}}',

           data: {book_id:book_id, no_of_pages:no_of_pages, language:language,ssml_gender:ssml_gender,voicename:voicename,pitch:pitch,speed:speed , book_name : book_name},

           success:function(response){

            window.onbeforeunload = null;
            
            $('body').removeClass("loader");

            $('#message').text(response.message);
               
            $('#alertMessage').modal("show");

            setTimeout(function() {
                    window.location.replace(window.location.origin+"/bookaudio/"+book_id);
                }, 3000);

           }

        });

      }

    });




  });
</script>
@endpush