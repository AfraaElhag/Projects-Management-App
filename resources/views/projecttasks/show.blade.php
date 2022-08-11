@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Tasks List')  ]) 

		<div class="card card-style">
           
            
			<div class="content mb-3" style="min-height:60vh!important; ">			
                    <div class="row mb-2">
                        @include('flash::message')
                        <div class="col-8 mt-1">
                         

                            <h1 class="">
    
                                @if($milestone == '1')
                            {{ __('text.Milestone One') }}
                            @elseif($milestone== '2')
                            {{ __('text.Milestone Two') }}
                            @elseif($milestone == '3')
                            {{ __('text.Milestone Three') }}
                            @elseif($milestone == '4')
                            {{ __('text.Milestone Four') }}
                            @endif
                            <span class="badge bg-red-dark   p-1 font-18 font-600" " style="vertical-align: super;">
                                {{$project->projectStatuses()->where('milestone',$milestone)->first()->status }} %</span>

                             </h1>
                        </div>
                    @canany(['isAdmin','isDesigner'])
                    <div class="col-4 mb-3" style="padding-left:4px !important; padding-right:4px !important; ">
                       
                
                    </div>
                    @endcan
    
                
                    
                @foreach($tasks as $task )
                @canany(['isAdmin','isDesigner','isCustomerService'])
                    @if ( !$project->trashed() and !$task->trashed()) 
                        <a href="{{ route('editprojecttasks', [$project->id ,$task->id]) }}" class="color-red-dark">
                    @elseif( !$project->trashed() and $task->trashed() and $task->pivot->status == 'not completed') 
                      
                            <a href="{{ route('editprojecttasks', [$project->id ,$task->id]) }}" class="color-red-dark">
                    @endif   
                    @endcan
                    <div class="row mb-0 ">
                        <div class="col-8">
                            <span class="font-14">{{$task->task}}</span>
                            @canany(['isAdmin','isDesigner','isCustomerService'])
                            @if($task->pivot->status == 'completed')
                            <p class="mb-2 mt-2 "><i class="fa fa-clock pe-2"></i> {{ __('text.Completed Date') }}&nbsp;&nbsp;
                                <?php echo date('Y-m-d', strtotime($task->pivot->updated_at))?></p>
                            <p class="mb-2 mt-2 "><i class="fa fa-user pe-2"></i>{{ __('text.Completed BY') }} &nbsp;&nbsp;
                                    {{$task->pivot->completed_by}}</p>
                            @endif
                            @endcan
                        </div>
                        <div class="col-4 text-end">
                          
                            @if($task->pivot->status == 'completed')
                            <span class=" badge bg-green-dark     mt-0 p-1 font-12"> 
                                {{ __('text.Completed') }}
                            </span>
                               @else
                               <span class=" badge bg-red-dark    mt-0 p-1 font-12"> 
                                {{ __('text.Not Completed') }}
                             </span>
                                
                            
                            @endif
                            

                        </div>
                    </div>
                    <div class="divider"></div>
                    @if ( !$project->trashed() and !$task->trashed()) 
                        </a>
                    @elseif( !$project->trashed() and $task->trashed() and $task->pivot->status == 'not completed') 
                        </a>        
                    @endif
                
                @endforeach	
			</div>
		</div>

        
		
		
        
    
      
        @endsection




    
   



      
        <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>