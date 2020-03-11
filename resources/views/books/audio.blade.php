@extends('layouts2.app')

@section('content')

<div class="container  pl-5 pr-5">
              <div class="row">
                  <div class="col-md-12">
                     <h3>
                        Audio
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
                           
                        </div>
                        <div class="downloadIcon">
                          <a href="" download="">  <i class="fa fa-download"></i></a>
                           
                           </div>
                     </div>
                    
                  </div>
                </div> 
            
               <div class="row mt-5">
                 <div class="col-md-12">
                  <div class="max-height-270">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Book Name</th>
                            <th>Language</th>
                            <th>Voice</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        
                        <tbody id="bookbody">
                          @forelse($book->audioVoices as $voice)
                          <tr>
                            <td>{{$book->name}}</td>
                            <td>{{$voice->language}}</td>
                            <td>{{$voice->voice}}</td>
                            <td>
                              
                              <div class="d-flex">
                                <!-- {{route('listenbook',[$book->id,$voice->language_code,$voice->voice])}} -->
                                <a class="mr-4 listenAudio pointer" data-audio="{{asset($voice->audio_path)}}" data-language="{{$book->name. ',' .$voice->language.','.explode('-',$voice->voice)[2].'-'.explode('-',$voice->voice)[3]}}">
                                  <img src="{{asset('assets/img/listen.png')}}" data-toggle="tooltip" title="Listen Audio" width="">
                                </a>
                                <a href="" data-toggle="modal" data-target="#deleteBookAudio" data-bookID="{{$book->id}}" data-language="{{$voice->language_code}}" data-voice="{{$voice->voice}}" class="delBook">
                                  <img src="{{asset('assets/img/deleteicon.png')}}" data-toggle="tooltip" title="Delete" width="">
                                </a>
                              </div>
                            </td>
                          </tr>
                          @empty
                        
                          <tr>
                          <td colspan="4" align="center">No Book Audio Found</td>
                          </tr>
                        @endforelse  
                       
                        </tbody>
                      </table>
                  </div>
                     
                 </div>
               </div>

               <div class="row mt-5">
                 <div class="col-md-12">
                  <div class="max-height-270">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Chapter Name</th>
                            <th>Language</th>
                            <th>Voice</th>
                            <th>Operations</th>
                          </tr>
                        </thead>
                        <tbody id="chapterbody">                          
                          @forelse($book->chapters as $chapter)
                          @forelse($chapter->audioVoices as $audio)
                          <tr>
                            <td>{{$audio->chapter_name}}</td>
                            <td>{{$audio->language}}</td>
                            <td>{{$audio->voice}}</td>
                            <td>
                              <div class="d-flex">
                                <!-- {{route('listenchapter',[$audio->chapter_id,$audio->language_code,$audio->voice])}} -->
                                <a class="mr-4 listenAudio pointer" data-audio="{{asset($audio->audio_path)}}" data-language="{{$audio->chapter_name. ',' . $audio->language.','.explode('-',$audio->voice)[2].'-'.explode('-',$audio->voice)[3]}}">
                                  <img src="{{asset('assets/img/listen.png')}}"  data-toggle="tooltip" title="Listen Audio"width="">
                                </a>
                                <a href="" class="delChap" data-toggle="modal" data-target="#deleteChapterAudio" data-chapterID="{{$audio->chapter_id}}" data-language="{{$audio->language_code}}" data-voice="{{$audio->voice}}">
                                  <img src="{{asset('assets/img/deleteicon.png')}}" data-toggle="tooltip" title="Delete" width="">
                                </a>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                          <td colspan="4" align="center">No Chapter Audio Found</td>
                          </tr>
                          @endforelse 
                          @empty
                          @endforelse 

                        </tbody>
                      </table>
                  </div>
                     
                 </div>
               </div>
              
            </div>

  <!-- Delete Chapter Audio Model -->
      <div class="modal fade" id="deleteBookAudio">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form>
            
            <!-- Hidden Attributes -->
            

             <input type="hidden" name="bookID" value="" id="bookAudio">
            <input type="hidden" name="language" value="" id="bookLanguage">
            <input type="hidden" name="voice" value="" id="bookVoice">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Audio</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Audio?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deleteBookBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Chapter Audio Model -->


  <!-- Delete Chapter Audio Model -->
      <div class="modal fade" id="deleteChapterAudio">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

          <form>
            
            <!-- Hidden Attributes -->
            <input type="hidden" name="chapterID" value="" id="chapterAudio">
            <input type="hidden" name="language" value="" id="chapterLanguage">
            <input type="hidden" name="voice" value="" id="chapterVoice">

            <!-- Modal Header -->
            <div class="modal-header">
              <h5 class="modal-title">Delete Audio</h5>
              <button type="button" class="close" data-dismiss="modal">
                <img src="{{asset('assets/img/close.png')}}">
              </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Are you Sure to Delete this Audio?</label>           
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button id="deleteChapterBtn" class="btn greenBtn mr-2">Delete</button>
            </div>
          </form>
          </div>
        </div>
      </div>
<!-- End Delete Chapter Audio Model -->


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
    $(document).ready(function(){

      $('#audioPlayerBox').hide();
      $('[data-toggle="tooltip"]').tooltip();
      

     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $('#closePlayer').click(function(){

      $('#audioPlayerBox').hide();

    });
      $('body').on('click', '.listenAudio',function(){
        $("#title").html("");
        $("#title").html($(this).attr("data-language"));
        
       
      $('#player').html("");
      $('#player').player($(this).attr("data-audio"));
      $('#audioPlayerBox').show();
      
      $(".downloadIcon a").attr("href",$(this).attr("data-audio"));

      
     });

       // $(".player").each(function(){

       //    $(this).player($(this).attr("data-audio"));

       //  });

    $('body').on('click', '.delBook',function(e){

    var bookID = $(this).attr("data-bookID");

    var language = $(this).attr("data-language");

    var voice = $(this).attr("data-voice");


    $("#bookAudio").val(bookID);

    $("#bookLanguage").val(language);

    $("#bookVoice").val(voice);

    }); 

    $('body').on('click', '.delChap',function(e){

    var chapterID = $(this).attr("data-chapterID");

    var language = $(this).attr("data-language");

    var voice = $(this).attr("data-voice");

    $("#chapterAudio").val(chapterID);

    $("#chapterLanguage").val(language);

    $("#chapterVoice").val(voice);

    });


      $('body').on('click', '#deleteBookBtn',function(e){

      e.preventDefault();

       
        var bookID = $("input[name=bookID]").val();

        var language = $("input[name=language]").val();

        var voice = $("input[name=voice]").val();
     


        $.ajax({

           type:'GET',

           url:"{{route('delbookaudio')}}",

           data: { bookID : bookID , language : language , voice: voice },

           success:function(response){

             let output=''; 

            if(response.error == false){
              if(response.data.length > 0){

              $.each(response.data, function() {

                output += '<tr>'+

              '<td>'+this.book_name +'</td>'+

             '<td>'+this.language +'</td>'+

             '<td>'+this.voice +'</td>'+

             '<td>'+

              ' <div class="d-flex">'+ 

              '<a href="listenbook/'+this.book_id+'/'+this.language_code+'/'+this.voice+'" class="mr-4"  ><img src="{{asset('assets/img/listen.png')}}" width="" data-toggle="tooltip" title="Listen Audio"></a>'+

             
              '<a  href="" class="delBook" data-toggle="modal" data-target="#deleteBookAudio"  data-bookID="'+ this.book_id +'"  data-language="'+ this.language +'" data-voice="'+ this.voice +'"><img src="{{asset('assets/img/deleteicon.png')}}" data-toggle="tooltip" title="Delete"  width=""></a>'+
             
            '</div>'+

            '</td>'+

            '</tr>';
  
               });
              }
              

            $('#bookbody').html(output);
            }
             $('#deleteBookAudio').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

    }); 



      $('body').on('click', '#deleteChapterBtn',function(e){

      e.preventDefault();

       
        var chapterID = $("input[name=chapterID]").val();

        var language = $("#chapterLanguage").val();

        var voice = $("#chapterVoice").val();
     

        $.ajax({

           type:'GET',

           url:"{{route('delchapteraudio')}}",

           data: { chapterID : chapterID , language : language , voice: voice },

           success:function(response){

            let output=''; 

            if(response.error == false){
              if(response.data.length > 0){

              $.each(response.data, function() {

                output += '<tr>'+

             '<td>'+this.chapter_name +'</td>'+

             '<td>'+this.language +'</td>'+

             '<td>'+this.voice +'</td>'+

             '<td>'+

              ' <div class="d-flex">'+ 

              '<a href="listenchapter/'+this.chapter_id+'/'+this.language_code+'/'+this.voice+'" class="mr-4"  ><img src="{{asset('assets/img/listen.png')}}" width="" data-toggle="tooltip" title="Listen Audio"></a>'+

             
              '<a  href="" class="delChap" data-toggle="modal" data-target="#deleteChapterAudio"  data-chapterID="'+ this.chapter_id +'"  data-language="'+ this.language +'" data-voice="'+ this.voice +'"><img src="{{asset('assets/img/deleteicon.png')}}" data-toggle="tooltip" title="Delete" width=""></a>'+
             
            '</div>'+

            '</td>'+

            '</tr>';
  
               });
              }
              

              

              $('#chapterbody').html(output);
            }
             $('#deleteChapterAudio').modal("hide");

             $('#message').text(response.message);

             $('#alertMessage').modal("show");


           }

        });

    }); 


  });
</script>
@endpush

