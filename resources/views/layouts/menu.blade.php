				
		<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">
                    Home
                </a>
                <a class="navbar-brand" href="{{ route('book.index') }}">
                    Book
                </a>
               
            @if(auth()->user()->isAdmin== 1)
                <a class="navbar-brand" href="{{ route('user.index') }}">
                    User
                </a>
                <a class="navbar-brand" href="{{ route('membership.index') }}">
                    Membership
                </a>
            @endif    
        </div>