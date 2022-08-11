@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Project Info')  ])      

        
       
         
             
        <div class="card card-style">
            <div class="content mb-0">
                @include('flash::message')
                @canany(['isAdmin','isCustomerService'])
                @if(! $project->trashed())
                <div class="row mb-2" style="">
                    
                    <div class="col-6" style="padding-left:4px !important; padding-right:4px !important; ">
                        <a href="{{ route('projects.edit' , $project->id) }}"
                             class="btn btn-s mt-1 mb-2 btn-full  border-highlight  color-black rounded-s text-uppercase font-900"
                             style="padding-left:4px !important; padding-right:4px !important; "  >{{ __('text.Edit') }}</a>
                
                    </div>
                    <div class="col-6" style="padding-left:4px !important; padding-right:4px !important; ">
                        <a href="#" class="btn btn-s mt-1 mb-2 btn-full  border-highlight  color-black rounded-s text-uppercase font-900"
                        onclick="deletefun({{$project->id}} , '{{ __('text.Continue') }}' )" style="padding-left:4px !important; padding-right:4px !important; ">
                        {{ __('text.Delete Project') }}
                            <form id="delete-form{{$project->id}}" action="{{route('projects.destroy',$project->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form></a>
                
                    </div>
                   
                </div>
                @endif
                @endcan
               
             
              
                        
                    <h2 class="mt-4" >        
                        {{$project->project_name}}
                      <span class="badge bg-red-dark   p-1 font-14 font-400" " style="vertical-align: super;">{{$project->status}} %</span>
                    </h2>
                        
                  


               
               
                <p style="text-align: justify" class="mt-1">
                    {{$project->details}}
                </p>

                <p class="mb-2 mt-2 "><i class="fa fa-clock pe-2"></i>{{ __('text.Start Date') }}&nbsp;&nbsp;
                    <?php echo date('Y-m-d', strtotime($project->start_date))?></p>
                <p class=" mb-2 mt-2"><i class="fa fa-clock pe-2"></i>{{ __('text.End Date') }}  &nbsp;&nbsp; <?php echo date('Y-m-d', strtotime($project->end_date))?></p>
            
                
             

                <div class="divider mt-4"></div>

                <h3 class="font-700">{{ __('text.Client') }}</h3>
                <p class="mb-2 mt-2"> <i class="fa fa-user pe-2"></i>{{$project->client->name}}   </p>
                <p class="mb-2 mt-2"><i class="fa fa-suitcase pe-2"></i> {{$project->client->company_name}}   </p>
                <div class="divider mt-4"></div>

                <h3 class="font-700">{{ __('text.Project Team') }}</h3>
                @if($project->users->isEmpty())
                <p class="font-14 mt-2 ">{{ __('text.No Team Fonud') }} </p>
                        
                @else

                @foreach($project->users as $user )
                <div class="row mb-2">
                    <div class="col-6 " >
                        <p class="font-14 mt-2 ">{{$user->name}}<br>{{$user->role}}</p>
                        
                    </div>


                    <div class="col-6 mt-3">
                        @if (! $user->trashed() and ! $project->trashed()) 
                        @canany(['isAdmin','isCustomerService'])
                        <a href="#"  class="btn btn-xxs mt-1 mb-2 btn-full  border-highlight  color-black rounded-s text-uppercase font-900"
                         href="#" onclick="deletefun({{$user->id}} , '{{ __('text.Continue') }}')">   
                         {{ __('text.Delete') }}
                                    <form id="delete-form{{$user->id}}" action="{{route('deletedesigner',$user->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                    </form>
                        </a>
                        
                        @endcan
                        @endif
                        
                    </div>
                    
                    
                    </div>
               
                    @endforeach	
                    @endif

                <div class="divider mt-4"></div>

               
                 
                       
                   
                  
                 


              
                        @if(Auth::guard('web')->check())
                        <h3 >{{ __('text.Milestones') }}</h3>
                @foreach($project->projectStatuses as $milestone)
                    
                        <a href="{{ route('showprojecttasks', [$project->id,$milestone->milestone]) }}" >

                   
                    
                <div class="card card-style mb-0 mt-4 
                @if($milestone->status == "100")
                bg-green-dark
                @elseif ($milestone->status == "0" )
                 bg-fade-night-light
                @else
                bg-yellow-dark
                
                @endif
                    " 
                style="margin-left: 0px !important; margin-right:0px !important;margin-bottom:-15px !important; border-radius:10px;
                    box-shadow: 1px 1px 1px 1px rgb(0 0 0 / 10%);
                    border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
                    
                        
                      
                            <div class="content row " style="margin-bottom:20px !important;">
                            <div class="col-8 " style="padding-right:0 !important">
                            <p class="font-17 font-700 color-white"> @if($milestone->milestone == '1')
                                {{ __('text.Milestone One') }}<span class="font-22 font-600"> {{$milestone->status}} %</span>
                                @elseif($milestone->milestone== '2')
                                {{ __('text.Milestone Two') }}<span class="font-22 font-600"> {{$milestone->status}} %</span>
                                @elseif($milestone->milestone == '3')
                                {{ __('text.Milestone Three') }} <span class="font-22 font-600">{{$milestone->status}} %</span>
                                @elseif($milestone->milestone == '4')
                                {{ __('text.Milestone Four') }}<span class="font-22 font-600"> {{$milestone->status}} %</span>
                                @endif
                            </p>
                            </div>
                           <div class="col-4 text-end"  style="padding-right:0 !important">
                           <strong class="font-500 font-14">
                            @if($milestone->status == "100")
                            {{ __('text.Completed Project') }}
                            @elseif ($milestone->status == "0" )
                            {{ __('text.Not Started') }}
                            @else 
                            {{ __('text.Inprogress') }}
                            @endif
                           </strong>
                            </div>
                        
                       

                    </div>
                </div>
            </a>
                @endforeach
                @endif
                

                @if(Auth::guard('clientweb')->check())                              
                    <a href="{{ route('taskstimeline', [$project->id]) }}" >   
                        <div class="card card-style mb-0 mt-4" 
                            style="margin-left: 0px !important; margin-right:0px !important;margin-bottom:-15px !important; border-radius:10px;
                            box-shadow: 1px 1px 1px 1px rgb(0 0 0 / 10%);
                            border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
                            
                            <div class="content text-center" style="margin-bottom:20px !important;">
                                <div class=" " style="padding-right:0 !important">
                                <p class="font-17 font-700 "> 
                                    {{ __('text.Milestones') }}
                                
                                </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
                    
            <div class="mb-5"> </div>
            
            </div>
        </div>

       
        @endsection




    
   



      
        <script type="text/javascript" src="{{ asset('ltr/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('ltr/scripts/custom.js') }}"></script>