<div class="container-fluid pl-5 pr-5 topBar">
               <div class="row">
                  <div class="col-md-12 text-right">
                    <div class="dropdown">
                        
                      <ul class="list-inline mt-5 dropdown-toggle" data-toggle="dropdown">
                        <li class="mr-2">
                           <img src="{{asset('assets/img/useravatar.png')}}" width="50">
                        </li>
                        <li>
                           <p class="m-0">
                           @auth{{ Auth::user()->name }}@endauth
                           </p>
                        </li>
                     </ul>
                     @auth
                      <div class="dropdown-menu  dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('home') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                       
                      </div>
                      @endauth
                    </div>
                     
                  </div>
               </div>
            </div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>