        <div id="menu-main"
            class="menu menu-box-right menu-box-detached rounded-m"
            data-menu-width="260"
            data-menu-active="nav-welcome"
            data-menu-effect="menu-over"> 
        
        
        <div class="   mt-3  mb-3">
        <div class="row">
            <div >
                <a href="#" class="close-menu mx-4" style="">
                <i style="stroke-width: 5;" data-feather="x" data-feather-line="3" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                
                 </a>
            </div>
            <div class=" menu-logo text-center ">  
                          <a href="#"><img class=" " width="80" src="{{ asset('images/logo.png') }}"></a>
            </div>
        </div>
            
            
        </div>
        
        <div class="menu-items mb-4">
       
            @canany(['isAdmin','isCustomerService'])
            <a id="nav-starters" href="{{ route('users.index') }}">
                
                <i data-feather="users" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Users') }} </span>
            </a>
            <a id="nav-features" href="{{ route('clients.index') }}">
                <i data-feather="users" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark" ></i>
                <span class="font-14">{{ __('text.Clients') }}</span>
            </a>
            @endcan
            @can('isAdmin')
            <a id="nav-pages" href="{{ route('tasks.index') }}">
                <i data-feather="file" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Tasks') }}</span>
            </a>
            @endcan
            

            @auth
            <a id="nav-media" href="{{ route('projects.index') }}">
                <i data-feather="briefcase" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Projects') }}</span>
            </a>
            @if(Auth::guard('clientweb')->check())

            <a id="nav-shapes" href="{{ route('clients.edit', Auth::user() ) }}">
                <i data-feather="user" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Profile') }}</span>
            </a>
            @else

            
            <a id="nav-shapes" href="{{ route('users.edit', Auth::user() ) }}">
                <i data-feather="user" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Profile') }}</span>
            </a>
            @endif
            @endauth


            @if(Auth::guard('clientweb')->check() || Auth::guard('web')->check())
            
            <a id="nav-settings" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="log-out" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Logout') }}</span>
              
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
            </a>
            @else
            <a id="nav-settings" href="{{ route('prelogin') }} " ">
                <i data-feather="log-in" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Login') }}</span>
              
                     
            </a>
            @endif
                
            
            <a id="nav-media" href="https://alaahariri.com/">
                <i data-feather="home" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.About US') }}</span>
            </a>
            
            

            <a href="https://alaahariri.com/contact-us/" data-submenu="sub-contact">
                <i data-feather="mail" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">{{ __('text.Contact Us') }}</span>
            </a>
          

            

            @if( app()->getLocale()== 'en')
            <a id="nav-welcome" href="{{ route('lang','ar') }}">
                <i data-feather="globe" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">AR </span>
                
            </a>
            @else
            <a id="nav-welcome" href="{{ route('lang','en') }}">
                <i data-feather="globe" data-feather-line="1" data-feather-size="20" data-feather-color="black" data-feather-bg="red-fade-dark"></i>
                <span class="font-14">EN </span>
            </a>
            @endif

           
        </div>
        
      
         
    </div>
    
    <!-- Be sure this is on your main visiting page, for example, the index.html page-->
    <!-- Install Prompt for Android -->
    <div id="menu-install-pwa-android" class="menu menu-box-bottom menu-box-detached rounded-l"
         data-menu-height="350" 
        data-menu-effect="menu-parallax">
        <div class="boxed-text-l mt-4">
            <img class=" mb-3" src={{ asset('images/logo.png') }}" alt="img" width="90">
            
            <p>
                {{ __('text.Install App Android') }}            </p>
            <a href="#" class="pwa-install btn btn-s rounded-s shadow-l text-uppercase font-900 bg-highlight mb-2">{{ __('text.Add to Home Screen') }} </a><br>
            <a href="#" class="pwa-dismiss close-menu color-highlight text-uppercase font-900 opacity-60 font-10">{{ __('text.Maybe later') }}</a>
            <div class="clear"></div>
        </div>
    </div>   

    <!-- Install instructions for iOS -->
    <div id="menu-install-pwa-ios" 
        class="menu menu-box-bottom menu-box-detached rounded-l"
         data-menu-height="320" 
        data-menu-effect="menu-parallax">
        <div class="boxed-text-xl mt-4">
            <img class=" mb-3" src="{{ asset('images/logo.png') }}" alt="img" width="90">
            
            <p class="mb-0 pb-3">
                {{ __('text.Install App IOS') }}
                        </p>
            <div class="clear"></div>
            <a href="#" class="pwa-dismiss close-menu color-highlight font-800 opacity-80 text-center text-uppercase">{{ __('text.Maybe later') }}</a><br>
            <i class="fa-ios-arrow fa fa-caret-down font-40"></i>
        </div>
    </div>