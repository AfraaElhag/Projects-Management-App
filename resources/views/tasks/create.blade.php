@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.New Task')  ]) 


        <div class="card card-style">
           
            <div class="content mb-0">
                <p>
                </p>
                <form method="POST"  action="{{ route('tasks.store') }}">
                    @csrf
                <div class="input-style has-borders no-icon validate-field mb-4 @error('task') is-invalid @enderror">
                    <input type="name" value="{{ old('task') }}" class="form-control validate-name" id="form1" placeholder="{{ __('text.Task') }}" name="task">
                    <label for="form1" class="color-highlight">{{ __('text.Task') }}</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>({{ __('text.Required') }})</em>
                </div>
                @error('task')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            

                <div class="input-style has-borders no-icon mb-4 @error('responsible') is-invalid @enderror">
                    <label for="form5" class="color-highlight">{{ __('text.Responsible') }}</label>
                    <select id="form5" name="responsible">
                        <option value="default" disabled selected>{{ __('text.Responsible') }}</option>
                   

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
                    <em></em>
                </div>
                @error('responsible')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                <div class="input-style has-borders no-icon mb-4 @error('milestone_number') is-invalid @enderror">
                    <label for="form5" class="color-highlight">{{ __('text.Milestone') }}</label>
                    <select id="form5" name="milestone_number">
                        <option value="default" disabled selected>{{ __('text.Milestone') }}</option>
                        <option value="1">{{ __('text.Milestone One') }}</option>
                        <option value="2">{{ __('text.Milestone Two') }}</option>
                        <option value="3">{{ __('text.Milestone Three') }}</option>
                        <option value="4">{{ __('text.Milestone Four') }}</option>
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <i class="fa fa-check disabled invalid color-red-dark"></i>
                    <em></em>
                </div>
                @error('milestone_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                <div class="form-check icon-check">
                    <input class="form-check-input " type="checkbox" value="1" id="check3" name='client_viewable'>
                    <label class="form-check-label font-14" for="check3">{{ __('text.Client Viewable') }}</label>
                    <i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
                    <i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
                </div>


              

                <button class="btn-center-xl mb-3 btn btn-m btn-full rounded-sm shadow-l border-highlight  color-black text-uppercase font-900 mt-4">{{ __('text.Save') }}</button>

                </form>
            </div>
        </div>

       

      

        

        


  



@endsection

<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>