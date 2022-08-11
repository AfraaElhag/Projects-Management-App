@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.New Project')  ])      


        <div class="card card-style">
           
       
            <div class="content mb-0">
                <p>
                </p>
                <form method="POST"  action="{{ route('projects.store') }}">
                    @csrf
                    
                    <input type="hidden" value="{{$client_id}}" name="client_id">
                    <input type="hidden" value="0" name="status">

                <div class="input-style has-borders no-icon validate-field mb-4 @error('title') is-invalid @enderror">
                    <input type="name" value="{{ old('project_name') }}" class="form-control validate-name" id="form1" placeholder="{{ __('text.Project Name') }}" name="project_name">
                    <label for="form1" class="color-highlight">{{ __('text.Project Name') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('project_name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

            
              
                <div class="input-style has-borders  input-style-always-active no-icon mb-4">
                    <label for="form2" class="color-highlight ">{{ __('text.Project Team') }}</label>
                    <select id="form2" name="user_id[]" multiple aria-label="multiple" >
                        <option value="" disabled selected class="mt-2">{{ __('text.Select') }}</option>
                        @foreach($designers as $designer)
                        <option value="{{$designer->id}}" class="mt-1" >{{$designer->name}}</option>
                        @endforeach
                       
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                    
                    <em></em>
                </div>

              

                <div class="input-style has-borders no-icon mb-4 input-style-always-active  @error('start_date') is-invalid @enderror">
                    <input name="start_date" type="date" value="<?php echo date("Y-m-d"); ?>" max="2030-01-01" min="2021-01-01" class="form-control validate-text" id="form3" >
                    <label for="form3" class="color-highlight">{{ __('text.Start Date') }}</label>
                    <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                    <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                </div>
                @error('start_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-style has-borders no-icon mb-4 input-style-always-active @error('end_date') is-invalid @enderror">
                    <input type="date" name="end_date" value="<?php echo date("Y-m-d"); ?>"  max="2030-01-01" min="2021-01-01" class="form-control validate-text" id="form4" >
                    <label for="form4" class="color-highlight">{{ __('text.End Date') }}</label>
                    <i class="fa fa-check disabled valid me-4 pe-3 font-12 color-green-dark"></i>
                    <i class="fa fa-check disabled invalid me-4 pe-3 font-12 color-red-dark"></i>
                </div>
                @error('end_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-style has-borders no-icon mb-4">
                    <textarea id="form5" placeholder="{{ __('text.Details') }}" name="details" value="{{ old('details') }}"></textarea>
                    <label for="form5" class="color-highlight">{{ __('text.Details') }}</label>
                    
                </div>


                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l  border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Save') }}</button>

                </form>
            </div>
        </div>

       

      

        

        



        @endsection




    
   



      
<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>

