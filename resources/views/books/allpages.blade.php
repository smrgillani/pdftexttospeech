

<div class="row mt-5 mb-5 bookPages">
                 <div class="col-md-12">
                   <div class="cardBox">
                     <h5>
                       Book Pages
                     </h5>
                    <!-- Nav pills -->
                    <div class="row" id="PageTabs">
                      <div class="col-md-3">
                        <ul class="nav nav-pills">
                          @foreach($data->pages as $key=>$page)

                          <li class="nav-item">
                            <a class="nav-link @if($key==0) active  @endif" data-toggle="pill" href="#page{{$page->page_no}}">Page {{$page->page_no}}</a>
                          </li>
                          @endforeach
                         
                        </ul>
                      </div>
                      <div class="col-md-9">
                          <!-- Tab panes -->
                        <div class="tab-content">
                          @foreach($data->pages as $key=>$page)

                          <div class="tab-pane container @if($key==0) active  @endif" id="page{{$page->page_no}}">
                            <div class="row">
                              <div class="col-md-12 text-right">
                               <a class="btn greenBtn mr-2 pr-5 pl-5 pageEdit" data-pageID="{{$page->page_no}}" data-bookID="{{$page->book_id}}" >Edit</a>
                               <a class="btn themeBtn pr-5 pl-5 pageDel" data-pageID="{{$page->page_no}}" data-bookID="{{$page->book_id}}" data-toggle="modal" data-target="#delPage">Delete</a>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="pageContentBox">
                                  <p>
                                    {{$page->content}}
                                  </p>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                   </div>
                 </div>
               </div>