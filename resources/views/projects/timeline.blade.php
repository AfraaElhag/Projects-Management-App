@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Milestones')  ])  
        
</div>
        
<div class=" mt-2 mb-5" style="min-height:60vh!important; ">
    <div class="content mb-2" >
        
        <div class="timeline-body timeline-body-center mt-n4">
            <div class="timeline-deco "></div>

            @foreach($project->projectStatuses as $milestone)
            @if(in_array($milestone->milestone  , [1,2,3]))
            <div class="timeline-item text-center">
                
                <span class="badge bg-highlight shadow-l p-3 font-400 font-14" style="margin-bottom: -80px;
                margin-top: 40;"> 
                    @if($milestone->milestone == '1')
                    {{ __('text.Milestone One') }}
                    @elseif($milestone->milestone== '2')
                    {{ __('text.Milestone Two') }}
                    @elseif($milestone->milestone == '3')
                    {{ __('text.Milestone Three') }}
                    @elseif($milestone->milestone == '4')
                    {{ __('text.Milestone Four') }}
                    @endif
                </span>

                @php $total=0; @endphp
               
                <div class="timeline-item-content rounded-s shadow-l">
                    @foreach ($tasks->where('milestone_number',$milestone->milestone) as $task)
                   
                        @if($task->pivot->status == 'completed')
                        @php $total=$total +1; @endphp
                        
                        @endif

                    <div class="row mb-2 ">
                        <div class="col-8 text-start">
                            <span class="font-14">{{$task->task}}</span>
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
                    @endforeach
                    
                    @php
                        $avg=intval(($total / $tasks->where('milestone_number',$milestone->milestone)->count()) * 100);
                    @endphp
                    <div class="progress rounded-l" style="height:28px">
                        <div class="progress-bar  @if($avg == 100)
                            bg-green-dark
                        @elseif($avg== 0 )
                            bg-fade-night-light
                        @else
                            bg-yellow-dark
                            
                            @endif 
                            text-start ps-3 color-white" 
                             role="progressbar" style="width: {{ $avg}}%" 
                             aria-valuenow="10" aria-valuemin="0" 
                             aria-valuemax="100">
                             
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                         <p class="icon icon-s rounded-circle 
                         @if($avg == 100)
                            bg-green-dark
                        @elseif($avg == 0 )
                            bg-fade-night-light
                        @else
                            bg-yellow-dark
                            
                            @endif
                          p-2 font-16">
                          {{ $avg}} %</p>
                    </div>
                </div>
            </div>
            @endif
            @endforeach



          	
        </div>	
    </div></div>		

       
        @endsection




    
   



      
<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>