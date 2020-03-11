@extends('layouts.app')


@section('content')
@include('layouts.menu')

<div class="container">
  
    <div class="row justify-content-center">

        <div class="col-md-12">

          <div style="visibility: hidden;" id="message"></div> 

            <div class="card">

                <div class="card-header">Dashboard</div>

                <div class="card-body">

                   @if ($errors->any())

                      <div class="alert alert-danger"> 

                        {{ implode('', $errors->all(':message')) }}

                      </div>

                    @endif
                    
                    @if(session()->has('message'))

                        <div class="alert alert-success">

                            {{ session()->get('message') }}

                        </div>

                    @endif

                    <form id="pdfBook" method="POST" action="{{ route('book.store')}}" enctype="multipart/form-data">
                        @csrf

                      <div class="form-group">

                        <input type="file" id="mypdf" class="form-control-file" id="exampleFormControlFile1" name="file" accept="application/pdf">

                      </div>

                      <button type="submit" class="btn btn-success">Upload</button>

                    <div id="progress-div"><div id="progress-bar"></div></div>

                      <div id="targetLayer"></div>

                  </form>

                  <div id="loader-icon" style="display:none;"><img src="{{asset('images/preview.gif')}}" /></div>

                </div>

            </div>

        </div>

    </div>

</div>
@push('scripts')
  <script src="{{asset('js/form.js')}}"></script>

    <script type="text/javascript">
   $(function() {

     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

$('#pdfBook').submit(function(e) { 

        if($('#mypdf').val()) {

            e.preventDefault();

            $('#loader-icon').show();

            $(this).ajaxSubmit({ 

                target:   '#targetLayer', 

                dataType: 'json',

                beforeSubmit: function() {

                    $("#progress-bar").width('0%');
                },

                uploadProgress: function (event, position, total, percentComplete){ 

                    $("#progress-bar").width(percentComplete + '%');

                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },

                success:function (response){
                  
                    $('#loader-icon').hide();

                    $('#message').text(response.message);
                    if(response.error == true){
                    $("#message").addClass("alert alert-danger");
                  }else{
                    $("#message").addClass("alert alert-success");
                  }
                    

                    $('#message').css('visibility', 'visible');

                      setTimeout(function() {
                    window.location.href = "book/"+response.data.id;
                }, 3000);
                     

                },

                resetForm: true 
            }); 
            return false; 
        }
    });

});
    </script>
@endpush
@endsection

