@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Tasks List')  ]) 

          
        
        
               

                
                   
                    @for($i = 1; $i < 5; $i++)
                    <div class="card card-style">
                        <div class="content mt-3 mb-3">

                        @if($i == 1)
                            @include('flash::message')
                            @canany('isAdmin')          
                            <a href="{{ route('tasks.create') }}" class="btn btn-m mt-4 mb-4 btn-full  border-highlight  color-black rounded-s text-uppercase font-900" >{{ __('text.Add New Task') }}</a>
                            @endcan
                        @endif

                           
                        @if($tasks->isEmpty())
                        <div class=" mb-5 text-center mt-5 " style="height: 200px;vertical-align :middle ">
                            <h3 class="mt-5 mb-5">
                                {{ __('text.No Tasks') }} </h3>
                        </div>
                        @else
                    <h1 class="vcard-title text-capitalize font-18  color-highlight">
                        @if($i == 1)
                            {{ __('text.Milestone One') }}
                        @elseif($i== 2)
                            {{ __('text.Milestone Two') }}
                        @elseif($i == 3)
                            {{ __('text.Milestone Three') }} 
                        @elseif($i == 4)
                            {{ __('text.Milestone Four') }}
                        @endif
                    </h1>
                    @foreach($tasks->where('milestone_number',$i)   as $task )
                    @if( ! $task->trashed())
                    <a href="{{ route('tasks.edit', [$task->id]) }}" class="color-highlight">

                        <div class="row mb-2">
                            <div class="col-6 ">
                              
                                    <img src="{{ asset('images/dot.png') }}" width="15"  height="15" class="">
                              
                             
                                <span class="font-14 has-icon">{{$task->task}}</span>
                                

                               
                                
                            </div>
                            <div class="col-6 text-end">
                                
                                @if($task->responsible == 'senior designer')
                                <span class="badge bg-blue-dark text-uppercase   p-2 font-8" style="vertical-align: super;">{{ __('text.Senior Designer') }}</span>
                                @elseif($task->responsible == 'junior designer')
                                <span class="badge bg-green-dark text-uppercase   p-2 font-8" style="vertical-align: super;">{{ __('text.Junior Designer') }}</span>
                                @elseif($task->responsible == 'admin')
                                <span class="badge bg-red-dark text-uppercase   p-2 font-8" style="vertical-align: super;"> {{ __('text.Admin') }}</span> 
                                @elseif($task->responsible == 'customer service')
                                <span class="badge bg-yellow-dark text-uppercase  p-2 font-8" style="vertical-align: super;">{{ __('text.Customer Service') }}</span>
                                @elseif($task->responsible == 'department manager')
                                <span class="badge bg-orange-dark text-uppercase   p-2 font-8" style="vertical-align: super;">{{ __('text.Department Manager') }}</span>
                                @elseif($task->responsible == 'project manager')
                                <span class="badge bg-magenta-dark text-uppercase  p-2 font-8" style="vertical-align: super;">{{ __('text.Project Manager') }}</span>
                                @elseif($task->responsible == 'accountant')
                                <span class="badge bg-yellow-dark text-uppercase   p-2 font-8" style="vertical-align: super;">{{ __('text.Accountant') }}</span>
                                @endif

                            </div>
                        </div>
                        
             
                        <div class="divider"></div>
                    </a>
                    @endif
                    @endforeach	
                    @endif
                </div>
		    </div>
                    @endfor
			   

      
		
		
        
    
      
        @endsection

<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

