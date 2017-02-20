<header id="header">

	<nav class="navbar navbar-inverse" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse navbar-right">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>

					<li><a href="{{ url('/posts') }}">Posts</a></li> 
					<li><a href="{{ url('/topics') }}">Topic</a></li> 

					@if (!Auth::check())
					
						<li><a href="{{ url('/login') }}">Login</a></li> 
						
						<li><a href="{{ url('/register') }}">Sign Up</a></li> 
					@else
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif							
				</ul>
			</div>
		</div><!--/.container-->
	</nav><!--/nav-->
	
</header><!--/header-->