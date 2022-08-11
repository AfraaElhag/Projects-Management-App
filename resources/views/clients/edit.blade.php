@extends('layouts.app')

@section('content')
        
@include('layouts.header', ['title' =>  __('text.Profile')  ])      

        
        <div class="card card-style">
            <div class="content">
                <div class="d-flex">
                   
                    <div>
                        <h1 class="mb-0 pt-1">{{"$client->name"}}</h1>
                        <p class="color-highlight font-11 mt-n2 mb-3">{{"$client->company_name"}}</p>
                    </div>
                </div>
                <p>
                </p>
               
           
        <form method="POST"  action="{{ route('clients.update',[$client->id]) }}">
            @csrf
            @method('PUT')
  
              
                @auth('web')
                <div class="input-style has-borders hnoas-icon input-style-always-active validate-field mb-4 @error('name') is-invalid @enderror">
                    <input autocomplete="off" value= "{{$client->name}}" type="name" class="form-control validate-name" id="form1" placeholder="{{ __('text.Client Name') }}" name="name">
                    <label for="form1" class="color-highlight font-400 font-13">{{ __('text.Client Name') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                <div class="input-style has-borders hnoas-icon input-style-always-active validate-field mb-4 @error('company_name') is-invalid @enderror">
                    <input autocomplete="off" value="{{$client->company_name}}" type="name" class="form-control validate-name" id="form2" placeholder="{{ __('text.Company Name') }}" name="company_name">
                    <label for="form2" class="color-highlight font-400 font-13">{{ __('text.Company Name') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('company_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                
                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('email') is-invalid @enderror">
                    <input autocomplete="off" value="{{$client->email}}" type="email" class="form-control validate-email" id="form3" placeholder="{{ __('text.Email') }}" name="email">
                    <label for="form3" class="color-highlight font-400 font-13">{{ __('text.Email') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                
                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('phone') is-invalid @enderror">
                    <input autocomplete="off" value="{{$client->phone}}" type="tel" class="form-control validate-tel" id="form4" placeholder="{{$client->phone}}" name="phone">
                    <label for="form4" class="color-highlight font-400 font-13">{{ __('text.Phone Number') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                
                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('address') is-invalid @enderror">
                    <input autocomplete="off" value="{{$client->address}}" type="text" class="form-control validate-text" id="form5" placeholder="{{ __('text.Address') }}" name="address">
                    <label for="form5" class="color-highlight font-400 font-13">{{ __('text.Address') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('password') is-invalid @enderror">
                    <input autocomplete="off" value="" type="passord" class="form-control validate-passord" id="form6" placeholder="******" name="password">

                    <label for="form6" class="color-highlight font-400 font-13">{{ __('text.Password') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                @endauth


                @auth('clientweb')
          


                <div class="input-style has-borders has-icon input-style-always-active validate-field mb-4">
                    <i class="fa fa-user"></i>
                    <input value= "{{$client->name}}" type="name" class="form-control validate-name" id="form1" placeholder="{{$client->name}}" name="name" disabled>
                  
                    
                </div>
                

                <div class="input-style has-borders has-icon input-style-always-active validate-field mb-4">
                    <i class="fa fa-suitcase"></i>
                    <input value="{{$client->company_name}}" type="name" class="form-control validate-name" id="form2" placeholder="{{$client->company_name}}" name="company_name" disabled>
                   
 
                </div>
                
                <div class="input-style has-borders has-icon input-style-always-active validate-field mb-4">
                    <i class="fa fa-envelope"></i>
                    <input value="{{$client->email}}" type="email" class="form-control validate-email" id="form3" placeholder="{{$client->email}}" name="email" disabled>
                    
                    
                </div>
                
                <div class="input-style has-borders has-icon input-style-always-active validate-field mb-4">
                    <i class="fa fa-phone"></i>
                    <input value="{{$client->phone}}" type="tel" class="form-control validate-tel" id="form4" placeholder="{{$client->phone}}" name="phone" disabled>
                   
                    
                </div>
                
                <div class="input-style has-borders has-icon input-style-always-active  mb-4">
                    <i class="fa fa-map-marker"></i>
                    <input value="{{$client->address}}" type="text" class="form-control " id="form5" placeholder="{{$client->address}}" name="address" disabled>
                   
                   
                </div>

                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('password') is-invalid @enderror">
                    <i class="fa fa-password"></i>
                    <input value="" type="passord" class="form-control validate-passord" id="form6" placeholder="******" name="password">

                    <label for="form6" class="color-highlight font-400 font-13">{{ __('text.Password') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                @endauth

                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Save') }}</button>
            </form> 
              
            </div>
        </div>
        
          

        
        
       
        

       
    @endsection




    
   



      
    <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>