@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.New User')  ]) 

  

            <div class="card card-style">
               
            


            <div class="content mb-0">
                <p>
                </p>
                <form method="POST"  action="{{ route('users.store') }}">
                    @csrf
                   
                    <div class="input-style has-borders no-icon validate-field mb-4 @error('name') is-invalid @enderror">
                        <input autocomplete="off" value="{{ old('name') }}" type="name" class="form-control validate-name" id="form1" placeholder="{{ __('text.User Name') }}" name="name">
                        <label for="form1" class="color-highlight">{{ __('text.User Name') }}</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>({{ __('text.Required') }})</em>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                <div class="input-style has-borders no-icon mb-4 @error('role') is-invalid @enderror">
                    <label for="form2" class="color-highlight">{{ __('text.Role') }}</label>
                    <select id="form2" name="role">
                        <option value="default" disabled selected>{{ __('text.Role') }}</option>
                        <option value="admin">{{ __('text.Admin') }}</option>
                        <option value="senior designer">{{ __('text.Senior Designer') }}</option>
                        <option value="junior designer">{{ __('text.Junior Designer') }}</option>
                        <option value="customer service">{{ __('text.Customer Service') }}</option>
                        <option value="department manager">{{ __('text.Department Manager') }}</option>
                        <option value="project manager">{{ __('text.Project Manager') }}</option>
                        <option value="accountant">{{ __('text.Accountant') }}</option>

                      
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <i class="fa fa-check disabled invalid color-red-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            

                <div class="input-style has-borders no-icon validate-field mb-4 @error('email') is-invalid @enderror">
                    <input autocomplete="off" value="{{ old('email') }}" type="email" class="form-control validate-text" id="form3" placeholder="{{ __('text.Email') }}" name="email">
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