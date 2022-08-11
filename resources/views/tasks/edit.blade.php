@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Edit Task')  ]) 


        <div class="card card-style">
           
            <div class="content mb-0">
                <p>
                </p>
                <form method="POST"  action="{{ route('tasks.update',[$task->id]) }}" id="editform{{$task->id}}">
                    @csrf
                    @method('PUT')
                <div class="input-style has-borders no-icon validate-field mb-4 @error('task') is-invalid @enderror">
                    <input type="name" class="form-control validate-name" id="form1" placeholder="{{ __('text.Task') }}" name="task" value="{{$task->task}}">
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
                    <select id="form5" name="responsible" >
                        <option value="{{$task->responsible}}"  selected>
                            @if($task->responsible == 'admin')
                            {{ __('text.Admin') }}                         
                            @elseif($task->responsible == 'senior designer')
                            {{ __('text.Senior Designer') }}
                            @elseif($task->responsible == 'junior designer')
                            {{ __('text.Junior Designer') }}
                            @elseif($task->responsible == 'customer service')
                                {{ __('text.Customer Service') }}
                            @elseif($task->responsible == 'department manager')
                                {{ __('text.Department Manager') }}
                            @elseif($task->responsible == 'project manager')
                                {{ __('text.Project Manager') }}
                            @elseif($task->responsible == 'accountant')
                                {{ __('text.Accountant') }}
                            @endif
                        </option>
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
                    <select id="form5" name="milestone_number" >
                        <option value="{{$task->milestone_number}}"  selected>
                            @if($task->milestone_number == '1')
                            {{ __('text.Milestone One') }}
                            @elseif($task->milestone_number== '2')
                            {{ __('text.Milestone Two') }}
                            @elseif($task->milestone_number == '3')
                            {{ __('text.Milestone Three') }}
                            @elseif($task->milestone_number == '4')
                            {{ __('text.Milestone Four') }}
                            @endif

                        </option>
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
                    @if($task->client_viewable == '1')
                    <input class="form-check-input" type="checkbox" value="1" id="check3" name="client_viewable"  checked>
                    @else
                    <input class="form-check-input" type="checkbox" value="1" id="check3" name="client_viewable" >
                    @endif
                    <label class="form-check-label" for="check3">{{ __('text.Client Viewable') }}</label>
                    <i class="icon-check-1 far fa-square color-gray-dark font-16"></i>
                    <i class="icon-check-2 far fa-check-square font-16 color-highlight"></i>
                </div>

             

                <div class="row mb-2" style="">
                                       
                    <div class="col-6" style="padding-left:4px !important; padding-right:6px !important; ">
                        <a href="#"  onclick="event.preventDefault(); document.getElementById('editform{{$task->id}}').submit();"
                             class="btn btn-s mt-1 mb-2 btn-full  rounded-s border-highlight  color-black  text-uppercase font-900"
                             style=" "  >{{ __('text.Edit') }}</a>
                
                    </div>
                </form>
                    <div class="col-6" style="padding-left:6px !important; padding-right:4px !important; ">
                        <a href="#" class="btn btn-s mt-1 mb-2 btn-full rounded-s  border-highlight  color-black  text-uppercase font-900"
                        onclick="deletefun({{$task->id}} , '{{ __('text.Continue') }}')" style=" ">
                             {{ __('text.Delete Task') }}                            <form id="delete-form{{$task->id}}" action="{{route('tasks.destroy',$task->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form></a>
                
                    </div>
                </div>
              

                

            </div>
        </div>

       

      

        

        



        @endsection

        <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>