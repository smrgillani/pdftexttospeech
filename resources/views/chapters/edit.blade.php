@extends('layouts.app')
@section('content')
@include('layouts.menu')
<form method="POST" action="{{ route('chapter.update',$chapter->id)}}" enctype="multipart/form-data">
                                  @csrf
                          				@method('PUT')
                                  <div class="modal-body">
                                        <input type="hidden" id="book_id" name="book_id" value="{{$chapter['book_id']}}">
                                          <div class="form-group">
                                            <label for="chapterName">Name</label>
                                            <input type="text" class="form-control" id="chapterName" name="chapterName"  placeholder="Enter chapter name" value="{{$chapter['name']}}">
                                            
                                          </div>
                                          <div class="form-group">
                                            <label for="pageFrom">Page From</label>
                                            <input type="number" class="form-control" min="1" max="{{$chapter['total_pages']}}" id="pageFrom" value="{{$chapter['page_from']}}" placeholder="Page From" name="pageFrom">
                                          </div>

                                          <div class="form-group">
                                            <label for="pageTo">Page To</label>
                                            <input type="number" class="form-control" min="1" max="{{$chapter['total_pages']}}" value="{{$chapter['page_to']}}" id="pageTo" placeholder="Page To" name="pageTo">
                                          </div>
                                         
                                  </div>
                                  <div class="modal-footer">
                                   
                                    <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                  </form>
@endsection