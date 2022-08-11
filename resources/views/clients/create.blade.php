@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Add New Client')  ])      


   

        <div class="card card-style">
            
        
            <div class="content mb-0">
            
                <p>
                </p>
                <form method="POST"  action="{{ route('clients.store') }}">
                    @csrf
                   
                    <div class="input-style has-borders no-icon validate-field mb-4 @error('name') is-invalid @enderror">
                        <input autocomplete="off" value="{{ old('name') }}" type="name" class="form-control validate-name" id="form1" placeholder="{{ __('text.Client Name') }}" name="name">
                        <label for="form1" class="color-highlight">{{ __('text.Client Name') }}</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>({{ __('text.Required') }})</em>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                <div class="input-style has-borders no-icon validate-field mb-4 @error('company_name') is-invalid @enderror">
                    <input autocomplete="off" value="{{ old('company_name') }}" type="name" class="form-control validate-name" id="form2" placeholder="{{ __('text.Company Name') }}" name="company_name">
                    <label for="form2" class="color-highlight">{{ __('text.Company Name') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('company_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            

                <div class="input-style has-borders no-icon validate-field mb-4 @error('email') is-invalid @enderror">
                    <input  autocomplete="off" value="{{ old('email') }}" type="email" class="form-control validate-text" id="form3" placeholder="{{ __('text.Email') }}" name="email">
                    <label for="form3" class="color-highlight">{{ __('text.Email') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <div class="input-style has-borders no-icon validate-field mb-4 @error('phone') is-invalid @enderror">
                    <input autocomplete="off" value="{{ old('phone') }}" type="tel" class="form-control validate-text" id="form4" placeholder="{{ __('text.Phone Number') }}" name="phone">
                    <label for="form4" class="color-highlight">{{ __('text.Phone Number') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <div class="input-style has-borders no-icon validate-field mb-4 @error('address') is-invalid @enderror">
                    <input autocomplete="off" value="{{ old('address') }}" type="address" class="form-control validate-text" id="form5" placeholder="{{ __('text.Address') }}" name="address">
                    <label for="form5" class="color-highlight">{{ __('text.Address') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <div class="input-style has-borders no-icon validate-field mb-4 @error('password') is-invalid @enderror">
                    <input autocomplete="off" type="password" class="form-control validate-text" id="form3" placeholder="{{ __('text.Password') }}" name="password">
                    <label for="form3" class="color-highlight">{{ __('text.Password') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Save') }}</button>

                </form>
            </div>
        </div>

       

      

        

        



        @endsection




    
   



      
<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>