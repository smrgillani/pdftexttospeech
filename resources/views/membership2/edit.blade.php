@extends('layouts.app')
@section('content')
@include('layouts.menu')
<form method="POST" action="{{ route('membership.update',$membership->id)}}" enctype="multipart/form-data">
                                     	@csrf
                          				@method('PUT')
                           <div class="modal-body">
                                          <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" value="{{$membership->name}}" name="name"  placeholder="Enter membership name" required>
                                            
                                          </div>
                                          <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control" id="price" placeholder="Price" name="price" value="{{$membership->price}}" required>
                                          </div>

                                          <div class="form-group">
                                            <label for="characters_length">Length</label>
                                            <input type="text" class="form-control" id="characters_length" placeholder="Characters length" value="{{$membership->characters_length}}" name="characters_length" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="voice_type">Status</label>
                                           <select class="custom-select my-1 mr-sm-2" id="status" name="status" required>
                                              <option disabled selected>Choose Status</option>
                                              <option value="1"  {{ $membership->status == 1 ? 'selected':'' }}>Active</option>
                                              <option value="0" {{ $membership->status == 0 ? 'selected':'' }}>Deactive</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                            <label for="voice_type">Voice Type</label>
                                           <select class="custom-select my-1 mr-sm-2" id="voice_type" name="voice_type" required>
                                              <option disabled selected>Choose Voice Type</option>
                                              <option value="Standard"  {{ $membership->voice_type == 'Standard' ? 'selected':'' }}>Standard</option>
                                              <option value="WaveNet" {{ $membership->voice_type == 'WaveNet' ? 'selected':'' }}>WaveNet</option>
                                              <option value="Both" {{ $membership->voice_type == 'Both' ? 'selected':'' }}>Both</option>
                                              
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="languages">Language</label>
                                            <select multiple class="form-control" id="languages" name="languages[]" required>


                                           @forelse($languages as $language)

                                             <option  

                                             @if(in_array($language->code,$selectedLanguage))
                                             {{"selected"}}
                                             @endif
                                            >{{$language->language}}</option> 
                                            @empty
                                            @endforelse
                                            
                                            </select>
                                          </div>

                                           <div class="form-group">
                                            <label for="languages">Voices</label>
                                            <select multiple class="form-control" id="voices" name="voices[]" required>
                                           @forelse($voices as $voice)
                                   
                                            @forelse($voice as $detail)
                                            <option
                                            @if(in_array($detail->name,$selectedVoices))
                                             {{"selected"}}
                                             @endif

                                            >{{$detail->name}}</option>
                                            @empty
                                            @endforelse
                                      
                                            
                                           
                                            @empty
                                            @endforelse 
                                            </select>
                                          </div>

                                        
                                         
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                  </form>
@endsection

@push('scripts')
<script type="text/javascript">
  $(function() {

    //   let language=$('#languages').val();
    //   let voicetype=$('#voice_type').val();
    //    console.log(language);
    //    console.log(voicetype);
    //   $.ajax({
    //   type : 'get',
    //   url : '{{ route("voicesearch")}}',
    //   data:{'language':language,'voicetype':voicetype},
    //   success:function(data){
    //    $('#voices').html(data);
    //   }
    // });


     $('#voice_type').change(function(){
      $value=$(this).val();

      $.ajax({
      type : 'get',
      url : '{{ route("languagesearch")}}',
      data:{'search':$value},
      success:function(data){
      $('#languages').html(data);
      }
      });
    });

      $('#languages').change(function(){
      let language=$(this).val();
      let voicetype=$('#voice_type').val();
  
      $.ajax({
      type : 'get',
      url : '{{ route("voicesearch")}}',
      data:{'language':language,'voicetype':voicetype},
      success:function(data){
       $('#voices').html(data);
      }
    });
  });
});

      </script>
@endpush