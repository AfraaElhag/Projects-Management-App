@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Update Project Tasks')  ]) 
        
      
<div class="card card-style">
    <div class="content mb-3">
		

				
                @if($task->pivot->status == 'completed')
                <span class=" badge bg-green-dark     mt-0 px-3 font-12"> 
                  {{ __('text.Completed') }}
                </span>
                   @else
                   <span class=" badge bg-red-dark    mt-0 p-3 font-12"> 
                     {{ __('text.Not Completed') }}
                 </span>
                 @endif

                
                      <p class="mb-5"><h4 class="font-400">{{$task->task}}</h4> 
                                </p>
                                @if($task->pivot->status == 'completed')
                                <p class="mb-2 mt-2 "><i class="fa fa-clock pe-2"></i>{{ __('text.Completed Date') }}&nbsp;&nbsp;
                                    <?php echo date('Y-m-d', strtotime($task->pivot->updated_at))?></p>
                                <p class="mb-4 mt-2 "><i class="fa fa-user pe-2"></i>{{ __('text.Completed BY') }}  &nbsp;&nbsp;
                                        {{$task->pivot->completed_by}}</p>
                                @endif          
                            
                      
                         


               
                
				
                    <form method="POST"  action="{{ route('updateprojecttasks',[$project->id , $task->id]) }}" id="delete-form{{$task->id}}" >
                        @csrf
                       <input type="hidden" name="milestone" value="{{$milestone}}">
                      
                   
                    @if($task->pivot->status == 'completed')
                    <input type="hidden" name="task_status" id="status{{$task->id}}" value="not completed" />
                    @else
                    <input type="hidden" name="task_status" id="status{{$task->id}}" value="completed"/>
                    @endif


                    
                    <a href="#" class="btn btn-s mt-1 mb-2 btn-full  border-highlight  color-black rounded-s text-uppercase font-700 "
                    onclick="deletefun({{$task->id}} , '{{ __('text.Continue') }}')" style="padding-left:4px !important; padding-right:4px !important; ">
                    @if($task->pivot->status == 'completed')
                    {{ __('text.Mark AS Incomplete') }}
                   
                    @else
                    {{ __('text.Mark AS Complete') }}
                    
                    @endif
                       </a>
            
                     
    
                    </form>
             	
              
              
               

                
               
			</div>
		</div>

       
        
		
		
        
    
      
        @endsection




    
   



      
        <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>