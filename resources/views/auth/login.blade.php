@extends('layouts.app')

@section('content')
        
@include('layouts.header', ['title' => __('text.Alaa Hariri Office')  ]) 
        

     
        <form method="POST" action="{{ route('login')  }}">
            @csrf
       

        <div class="card card-style ">
            <div class="content mt-2 mb-0">
                <div class="menu-logo text-center mt-3 mb-3">
                    <a href="#"><img class=" " width="80" src="{{ asset('images/logo.png') }}"></a>
                </div>
                <div class="input-style no-borders has-icon validate-field mb-4 mt-5">
                    <i class="fa fa-user"></i>
                    <input autocomplete="off" type="email" class="form-control validate-name @error('email') is-invalid @enderror" id="form1a" placeholder="{{ __('text.Email') }}" name="email"
                    value="{{ old('email') }}" >
                    <label for="form1a" class="color-highlight font-10 mt-1">{{ __('text.Email') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>

                   
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            
         

        
                
                <div class="input-style no-borders has-icon validate-field mb-4">
                    <i class="fa fa-lock"></i>
                    <input autocomplete="off" type="password" class="form-control validate-password @error('password') is-invalid @enderror" id="form3a" placeholder="{{ __('text.Password') }}" name="password">
                    <label for="form3a" class="color-highlight font-10 mt-1">{{ __('text.Password') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>

                   
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Login') }}</button>

               
            </form>

            
               
                <div class="divider mt-4 mb-3"></div>
            <!--
                <div class="d-flex mb-5">
                    <div class="w-50 font-11 pb-2 color-theme opacity-60 pb-3 text-end"><a href="{{ route('password.request') }}" class="color-theme">{{ __('text.Forgot Credentials') }}</a></div>
                </div>
                -->
            </div>
            
        </div>

       
        @endsection




    
   



      
<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>

