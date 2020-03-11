@forelse($voices as $voice)
                                  @if(isset($voice->name))
                                           
                                  @forelse($voice as $detail)
                                            <option
                                            @if(in_array($detail->name,$selectedVoices))
                                             {{"selected"}}
                                             @endif

                                            >{{$detail->name}}</option>
                                          @empty
                                  @endforelse

                                  @else
                                            
                                           <option
                                            @if(in_array($voice->name,$selectedVoices))
                                             {{"selected"}}
                                             @endif

                                            >{{$voice->name}}</option> 
                                           
                                  @endif
@empty
@endforelse