@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Client Info')  ])      
       

              
        <div class="card card-style">
            <div class="content mt-1 mb-2">
                @include('flash::message')
                @canany(['isAdmin','isCustomerService'])
                @if(! $client->trashed())
                        <div class="row mt-3" style="">
                            <div class="col-4 " style="padding-left:4px !important; padding-right:4px !important; ">               
                            <a href="{{ route('createproject' , $client->id) }}" class="button rounded-s btn btn-s mt-1 mb-2 btn-full  border-highlight  color-black  text-uppercase font-900" style="padding-left:4px !important; padding-right:4px !important; ">{{ __('text.Add Project') }}</a>
                            </div>
                            <div class="col-4" style="padding-left:4px !important; padding-right:4px !important; ">
                                <a href="{{ route('clients.edit' , $client->id) }}"
                                     class="btn btn-s mt-1 mb-2 btn-full  border-highlight rounded-s color-black  text-uppercase font-900"
                                     style="padding-left:4px !important; padding-right:4px !important; "  > {{ __('text.Edit') }}</a>
                        
                            </div>
                            <div class="col-4" style="padding-left:4px !important; padding-right:4px !important; ">
                                <a href="#" class="btn btn-s mt-1 mb-2 btn-full  border-highlight rounded-s color-black  text-uppercase font-900  "
                                onclick="deletefun({{$client->id}} , '{{ __('text.Continue') }}')" style="padding-left:4px !important; padding-right:4px !important; ">
                                {{ __('text.Delete Client') }}
                                    <form id="delete-form{{$client->id}}" action="{{route('clients.destroy',$client->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form></a>
                        
                            </div>
                        </div>
                        @endif
                       
                     
                        
                    
                @endcan
        
                
                <div class="vcard-field"><strong>{{ __('text.Client Name') }}</strong> {{$client->name}} <i class="fa fa-user "></i></div>               
                <div class="vcard-field"><strong>{{ __('text.Company Name') }}</strong><a href=""> {{$client->company_name}}</a><i class="fa fa-suitcase "></i></div>               
                <div class="vcard-field line-height-l pb-3"><strong>{{ __('text.Address') }}</strong><a href=""> {{$client->address}}</a><i class="fa fa-map-marker  mt-n2"></i></div>
            </div>
        </div>
        <div class="card card-style">
            <div class="content mt-3 mb-2">
                <h1 class="vcard-title text-capitalize font-18  ">{{ __('text.Contacts') }}</h1>

                <div class="vcard-field"><strong>{{ __('text.Phone Number') }}</strong><a href="">{{$client->phone}}</a><i class="fa fa-phone "></i></div>
                <div class="vcard-field"><strong>{{ __('text.Email') }}</strong><a href="">{{$client->email}}</a><i class="fa fa-home #"></i></div>
          
               </div>
        </div>
       
        <div class="card card-style">
            <div class="content mt-3 mb-2">
                <h1 class="vcard-title text-capitalize font-18   mb-4">{{ __('text.Projects') }}</h1>
                @if($client->projects->isEmpty())
                    <div class=" mb-2 text-center mt-2 " style="vertical-align :middle ">
                        <p class="mt-2 mb-2">
                            {{ __('text.No Projects') }} </p>
                    </div>
                @endif

                  @foreach($client->projects->reverse() as $project)
            <a href="{{ route('projects.show', [$project->id]) }}">
                <div class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="{{ asset('images/logo.png') }}" width="50" height="70" class="">
                    </div>
                    <div class="ps-2 ms-1 align-self-center w-100">
                        <h5 class="font-600 mb-0">{{$project->project_name}}</h5>
                        <h5 class="font-500 mb-1">{{$project->status}} %
                           

                          

                       <p><span class="font-10 color-highlight">
                        @if($project->status == '0')
                        <span class="badge bg-red-dark   mt-0 p-1 font-12 font-400"  >{{ __('text.Not Started') }}</span>
                        @elseif($project->status == '100')
                    <span class="badge bg-red-dark   mt-0 p-1 font-12 font-400"  >{{ __('text.Completed Project') }}</span>

                    @else
                    <span class="badge bg-red-dark   mt-0 p-1 font-12 font-400"  >{{ __('text.Inprogress') }}</span>

                    @endif
                </span></p>
                        </h5>
								
					</div> 
				</div>
			</a>
                            <div >
                                
							@canany(['isAdmin','isCustomerService'])
                          

							
							<a href="{{ route('projects.show',$project->id) }}" class="btn btn-s mt-1 mb-2 btn-full rounded-s  border-highlight  color-black text-uppercase font-900" >{{ __('text.More Info') }}</a>

						


							@endcan
                            </div>
                        
                   
           
            <div class="divider mb-3"></div>
            @endforeach
                      
                    
                   
            </div>
            
        </div>


       
        @endsection




    
   



      
<script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>

