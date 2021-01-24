  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto">
      	@if(isset(Session::get('settings')->logo))
      		<a href="/" class="logo mr-auto">
            	<img src="{{Session::get('settings')->logo}}" alt="" class="img-fluid"/>
            </a>
        @else
        	<a href="/">{{Session::get('name')}}</a>
        @endif
      </h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
        @if(isset(Session::get('settings')->topmenu))
  			{!! Session::get('settings')->topmenu !!}
  		  @endif
        </ul>
      </nav><!-- .nav-menu -->

      <a href="#about" class="get-started-btn scrollto">Get Started</a>

    </div>
  </header><!-- End Header -->