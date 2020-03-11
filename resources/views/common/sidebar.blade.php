
<div class="sidebar">
            <div class="collapseIcons">
                 <div class="bar1"></div>
                 <div class="bar2"></div>
                 <div class="bar3"></div>
            </div>
            <div class="logo text-center mt-5">
               <img src="{{asset('assets/img/logo.png')}}" class="logoChangeAble">
            </div>
            <ul class="side-nav">
               @auth
                @if(auth()->user()->isAdmin== 1||auth()->user()->isSubscriber())
               <li>
                  <a href="{{ route('home') }}">
                     <span class="img-background home"></span>
                     <span class="text">
                        HOME
                     </span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('book.index') }}">
                     <span class="img-background book"></span>
                     <span class="text">
                        BOOK
                     </span>
                  </a>
               </li>
             @if(auth()->user()->isAdmin== 1)
               <li>
                  <a href="{{ route('user.index') }}">
                     <span class="img-background user"></span>
                     <span class="text">
                        USER
                     </span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('membership.index') }}">
                     <span class="img-background membership"></span>
                     <span class="text">
                        MEMBERSHIP
                     </span>
                  </a>
               </li>
               @endif
               @endif

               @if(auth()->user()->isAdmin==1)
            <li>
                  <a href="{{ route('Packages') }}">
                     <span class="img-background packages"></span>
                     <span class="text">
                        PACKAGES
                     </span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('orders.index') }}">
                     <span class="img-background packages"></span>
                     <span class="text">
                        ORDERS
                     </span>
                  </a>
               </li>
            </ul>
            @endif

            @if(auth()->user()->isSubscriber()&&auth()->user()->isAdmin!=1)
            <li>
                  <a href="{{ route('orders.show',auth()->user()->order->id) }}">
                     <span class="img-background packages"></span>
                     <span class="text">
                        SUBSCRIPTION
                     </span>
                  </a>
               </li>
            @endif
            @endauth
      </div>
