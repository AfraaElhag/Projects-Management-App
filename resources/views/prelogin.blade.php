@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Alaa Hariri Office')  ])      



        <div class="card card-style">
            <div class="content mb-0">
                <div class="menu-logo text-center mt-3 mb-3">
                    <a href="#"><img class=" " width="80" src="{{ asset('images/logo.png') }}"></a>
                </div>
              <div class="list-group list-boxes mb-5 mt-5">
                    <a href="{{ route('login') }}" class="border border-highlight rounded-s shadow-xs">
                        <i class="fa fa-user "></i>
                        <span class="mt-0" >{{ __('text.Login As Employee') }}</span>
                       
                        
                        
                    </a>

                    <a href="{{ route('clientlogin') }}" class="border border-highlight rounded-s shadow-xs">
                        
                        
                       
                        
                        <i class="fa fa-user "></i>
                        <span class="mt-0">{{ __('text.Login As Client') }}</span>
                    </a>
                   
                </div>
            

            
               
                <div class="divider mt-4 mb-3"></div>

                
            </div>
            
        </div>

       
        @endsection




    
   



      
        <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>
        
        