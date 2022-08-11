@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Profile')  ]) 

    
        <div class="card card-style">
            <div class="content">
                <div class="d-flex row">
                    
                    <div class="col-6">
                        <h1 class="mb-0 pt-1">{{$user->name}}</h1>
                        <p class="color-highlight font-11 mt-n2 mb-3">
                            @if( $user->role == 'admin')
                            {{ __('text.Admin') }}
                            @elseif($user->role == 'senior designer')
                            {{ __('text.Senior Designer') }}
                            @elseif($user->role == 'junior designer')
                            {{ __('text.Junior Designer') }}
                            @elseif($user->role == 'customer service')
                            {{ __('text.Customer Service') }}
                            @elseif($user->role == 'accountant')
                            {{ __('text.Accountant') }}
                            @elseif($user->role == 'Department manager')
                            {{ __('text.Department Manager') }}
                            @elseif($user->role == 'project manager')
                            {{ __('text.Project Manager') }}

                             @endif
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        @canany(['isAdmin','isCustomerService'])
                    <a href="#" class="btn btn-s mt-1 mb-2 btn-full  border-highlight rounded-s color-black  text-uppercase font-900  "
                    onclick="deletefun({{$user->id}} , '{{ __('text.Continue') }}')" style="padding-left:4px !important; padding-right:4px !important; ">
                    {{ __('text.Delete User') }}
                        <form id="delete-form{{$user->id}}" action="{{route('users.destroy',$user->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form></a>
                    @endcan</div>
                </div>
                <p>
                </p>
           
        <form method="POST"  action="{{ route('users.update',[$user->id]) }}">
            @csrf
            @method('PUT')
        
                <div class="input-style has-borders hnoas-icon input-style-always-active validate-field mb-4 @error('name') is-invalid @enderror">
                    <input autocomplete="off" value= "{{$user->name}}" type="name" class="form-control validate-name" id="form1" placeholder="{{ __('text.User Name') }}" name="name">
                    <label for="form1" class="color-highlight font-400 font-13">{{ __('text.User Name') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @canany(['isAdmin','isCustomerService'])
                <div class="input-style has-borders input-style-always-active validate-field no-icon mb-4 @error('role') is-invalid @enderror">
                    <label for="form2" class="color-highlight font-400 font-13">{{ __('text.Role') }}</label>
                    <select id="form2" name="role">
                        <option value="{{$user->role}}"  selected>
                            @if($user->role == 'admin')
                            {{ __('text.Admin') }}
                            @elseif($user->role == 'senior designer')
                            {{ __('text.Senior Designer') }}
                            @elseif($user->role == 'junior designer')
                            {{ __('text.Junior Designer') }}
                            @elseif($user->role == 'customer service')
                                {{ __('text.Customer Service') }}
                            @elseif($user->role == 'department manager')
                                {{ __('text.Department Manager') }}
                            @elseif($user->role == 'project manager')
                                {{ __('text.Project Manager') }}
                            @elseif($user->role == 'accountant')
                                {{ __('text.Accountant') }}
                            @endif

                           
                        </option>


                        <option value="admin">{{ __('text.Admin') }}</option>
                        <option value="senior designer">{{ __('text.Senior Designer') }}</option>
                        <option value="junior designer">{{ __('text.Junior Designer') }}</option>
                        <option value="customer service">{{ __('text.Customer Service') }}</option>
                        <option value="department manager">{{ __('text.Depatment Manager') }}</option>
                        <option value="project manager">{{ __('text.Project Manager') }}</option>
                        <option value="accountant">{{ __('text.Accountant') }}</option>


                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <i class="fa fa-check disabled invalid color-red-dark"></i>
                    <em></em>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endcan

                @can('isDesigner')
                <div class="input-style has-borders input-style-always-active validate-field no-icon mb-4 @error('role') is-invalid @enderror">
                    <input autocomplete="off" value="{{$user->role}}" type="name" class="form-control validate-email" id="form3" placeholder="{{ __('text.Role') }}" name="role" disabled>
                    <label for="form3" class="color-highlight font-400 font-13">{{ __('text.Role') }}</label>
                </div>
                @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @endcan

                
                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('email') is-invalid @enderror">
                    <input autocomplete="off" value="{{$user->email}}" type="email" class="form-control validate-email" id="form3" placeholder="{{ __('text.Email') }}" name="email">
                    <label for="form3" class="color-highlight font-400 font-13">{{ __('text.Email') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <div class="input-style has-borders no-icon input-style-always-active validate-field mb-4 @error('phone') is-invalid @enderror">
                    <input autocomplete="off" value="{{$user->phone}}" type="tel" class="form-control validate-tel" id="form4" placeholder="{{ __('text.Phone Number') }}" name="phone">
                    <label for="form4" class="color-highlight font-400 font-13">{{ __('text.Phone Number') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('phone')
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

                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Save') }}</button>
            </form>          
            </div>
        </div>
        
          

        
        
         

        

       
    @endsection

    <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>