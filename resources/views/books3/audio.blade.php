@extends('layouts.app')
@section('content')
@include('layouts.menu')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Book</div>

                <div class="card-body">
                  <div class="row">
                  	@forelse($book->audioVoices as $voice)
						  <div class="col-sm-6">
						    <div class="card">
						      <div class="card-body">
						        <h5 class="card-title">{{$voice ->voice}}</h5>
						        <audio controls>
			                      <source src="{{asset($voice->audio_path)}}" type="audio/mpeg">
			                    </audio>
						      </div>
						    </div>
						  </div>
						  @empty
						  <div class="col-sm-12">
						    <div class="card">
						      <div class="card-body">
						        <h6 class="card-title">No Audio Found</h6>
						        
						      </div>
						    </div>
						  </div>
					@endforelse	  
                </div>
            </div>

            <div class="card">
                <div class="card-header">Chapters</div>

                <div class="card-body">
                  <div class="row">
                  	@forelse($book->chapters as $chapter)
					  <div class="col-sm-6">
					    <div class="card">
					      <div class="card-body">
					        <h5 class="card-title">{{$chapter->name}}</h5>
					        <hr>
					        @forelse($chapter->audioVoices as $chaptervoice)
							<h5 class="card-title">{{$chaptervoice ->voice}}</h5>
						        <audio controls>
			                      <source src="{{asset($chaptervoice->audio_path)}}" type="audio/mpeg">
			                    </audio>
					        @empty
					         <div class="col-sm-12">
						    <div class="card">
						      <div class="card-body">
						        <h6 class="card-title">No Audio Found</h6>
						        
						      </div>
						    </div>
						  </div>
					        @endforelse
					      </div>
					    </div>
					  </div>
					@empty
					<div class="col-sm-12">
						    <div class="card">
						      <div class="card-body">
						        <h6 class="card-title">No Chapter Found</h6>
						        
						      </div>
						    </div>
					</div>
					@endforelse 
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection