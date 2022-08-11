@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Projects List')  ])      
       
@canany(['isAdmin','isCustomerService'])          
        <div class="content position-relative" style="margin-bottom:-50px; z-index:99;">
			<div class="search-box position-relative shadow-xl border-0 bg-white rounded-m">
				
                <form method="POST"  action="">
                   
                    <button disabled><i class="fa fa-search ms-n3"></i></button>
				<input type="text" class="border-0" id="search" autocomplete="off" placeholder="{{ __('text.Search') }} " data-search name="q">
                </form>
			</div>
       

            <div class="search-results disabled-search-list card card-style mx-0 px-3 mt-4" style="margin-bottom:80px;" id="result">
				<div class="list-group list-custom-large">
                    
				
					
				</div>
			</div>
        

            
			
		</div>
		@endcan
        
      
	</div>
        
	<div class="card card-style mt-2 " style="min-height:60vh!important; ">
		<div class="content mb-2" >
			@include('flash::message')
			@if($projects->isEmpty())
			<div class=" mb-5 text-center mt-5 " style="height: 200px;vertical-align :middle ">
				<h3 class="mt-5 mb-5">
					{{ __('text.No Projects') }} </h3>
			</div>
			@endif
            @foreach($projects as $project)
            <a href="{{ route('projects.show', [$project->id]) }}">
                <div class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="{{ asset('images/logo.png') }}" width="50" height="70" class="">
                    </div>
                    <div class="ps-2 ms-1 align-self-center w-100">
                        <h5 class="font-600 mb-0">{{$project->project_name}}</h5>
						@if(Auth::guard('clientweb')->check())
						
						@else
                        <p class="mt-n1 font-11 mb-0">
                            {{$project->client->name}}
                        </p>
						@endif
						<h5 class="font-500 mb-1">{{$project->status}} %
                           

                        
							<p><span class="font-10 color-highlight">
							 @if($project->status == 0)
							 <span class="badge bg-red-dark   mt-0 p-1 font-12 font-400"  >{{ __('text.Not Started') }}</span>
							 @elseif($project->status == 100)
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
           
           
        









@if ($projects  and $projects->hasPages() )
        <nav aria-label="pagination-demo">
            <ul class="pagination justify-content-center"  style="padding-right: 0px !important">
				@if ($projects->onFirstPage())
                <li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@else 
				<li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $projects->previousPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@endif

				@php
					if($projects->lastPage() <5)
					$length=$projects->lastPage();
					else {
						$length=4;
					}
					
				@endphp
				@for ($page = 1; $page <= $length; $page++)
				@if ($page == $projects->currentPage())
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true">{{ $page }}</a>

				@else
				<li class="page-item"><a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $projects->url($page) }}">{{ $page }}</a></li>

	
				@endif
			@endfor

			@if ($projects->hasMorePages())
			<li class="page-item">
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $projects->nextPageUrl() }}" rel="next" ><i class="fa fa-angle-left"></i></a>

			</li>
		@else
			<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="#"><i class="fa fa-angle-left"></i></a>
			</li>
		@endif
			
                
            </ul>
        </nav>
@endif
		</div>
	</div>



    
       
        

        @endsection




		<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>

		
		
		
   
		<script>
			$(document).ready(function(){
				var searchResult = document.getElementById('result');
				$('#search').on('keyup', function(){
						search();
					});
			
			   
				function search(){
					var searchResult = document.getElementById('result');
			
					$(searchResult).html('');
					 var keyword = $('#search').val();
					if(keyword != ''){
						searchResult.classList.remove('disabled-search-list');
			
						$.post('{{ route("projectsearch")  }}',
						{
							_token: $('meta[name="csrf-token"]').attr('content'),
							keyword:keyword
						},
						function(data){
							console.log(data);
							show_result(data);
							
						});
					}    
				}
			
				
				// show result with ajax
				function show_result(data){
					$(searchResult).html('');
					if(data.results.length <= 0)
					{
					   $(searchResult).append(`<p>{{ __('text.No Results') }}</p>`);
					}
			
					else
					{
						for(let i = 0; i < data.results.length; i++){
							$( searchResult ).append( `<a href="projects/` +data.results[i].id+     `/ "  style="line-height: 70px;
							color: #1f1f1f;
							font-weight: 500;
							font-size: 13px;
							border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
												<span>` +data.results[i].project_name + `</span>
																				  
											</a> `);   
						}
					}
				}
			});
			</script>



        