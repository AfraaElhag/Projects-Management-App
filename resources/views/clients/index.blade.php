@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Clients List')  ])      
     
@canany(['isAdmin','isCustomerService'])      

        <div class="content position-relative" style="margin-bottom:-50px; z-index:99;">
			<div class="search-box position-relative shadow-xl border-0 bg-white rounded-m">
				
                <form method="POST"  action="">
                   
                    <button disabled><i class="fa fa-search ms-n3"></i></button>
				<input type="text" class="border-0" id="search" autocomplete="off" placeholder="{{ __('text.Search') }}" data-search name="q">
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
				<div class="content mb-2 ">
              
					@include('flash::message')

					@if($clients->isEmpty())
			<div class=" mb-5 text-center mt-5 " style="height: 200px;vertical-align :middle ">
				<h3 class="mt-5 mb-5">
					{{ __('text.No Clients') }} </h3>
			</div>
			@endif

			
                @canany(['isAdmin','isCustomerService'])
				
				<a href="{{ route('clients.create') }}" class="btn btn-m mt-1 mb-5 btn-full  border-highlight  color-black rounded-s text-uppercase font-900">{{ __('text.Add New Story') }}</a>

                @endcan
                
                
				@foreach($clients as $client)
                <a href="{{ route('clients.show', [$client->id]) }}">
					<div class="d-flex mb-3">
						<div class="align-self-center">
							<img src="{{ asset('images/avatars/user.png') }}" class="rounded-circle shadow-l bg-fade-red-dark" width="50">
						</div>
						
						<div class="ps-2 ms-1 align-self-center w-100">
							<h5 class="font-600 mb-0">{{$client->name}}</h5>
							<p class="mt-n1 font-11 mb-0">
								{{$client->company_name}}
							</p>
							
								
									
						</div> 
					</div>
				</a>
								<div >
									
								@canany(['isAdmin','isCustomerService'])
									@if(! $client->trashed())

								
								<a href="{{ route('createproject' , $client->id) }}" class="btn btn-s mt-1 mb-2 btn-full  border-highlight  color-black text-uppercase font-900" >  {{ __('text.Add Project') }} </a>
									@endif
								@endcan
								</div>
							
					   
			   
				<div class="divider mb-4" style="background-color: #b6afaf"></div>
				@endforeach
                
                
               
     

                
           


		@if ($clients  and $clients->hasPages() )
        <nav aria-label="pagination-demo">
            <ul class="pagination justify-content-center"  style="padding-right: 0px !important">
				@if ($clients->onFirstPage())
                <li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@else 
				<li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $clients->previousPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@endif

				@php
					if($clients->lastPage() <5)
					$length=$clients->lastPage();
					else {
						$length=4;
					}
					
				@endphp
				@for ($page = 1; $page <= $length; $page++)
				@if ($page == $clients->currentPage())
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true">{{ $page }}</a>

				@else
				<li class="page-item"><a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $clients->url($page) }}">{{ $page }}</a></li>

	
				@endif
			@endfor

			@if ($clients->hasMorePages())
			<li class="page-item">
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $clients->nextPageUrl() }}" rel="next" ><i class="fa fa-angle-left"></i></a>

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




    
   



      
        <script type="text/javascript" src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/scripts/custom.js') }}"></script>

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
	
				$.post('{{ route("clientsearch") }}',
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
					$( searchResult ).append( `<a href="https://localhost/haririapp/public/clients/` +data.results[i].id+     `/ " 
													   
					style="line-height: 70px;
					color: #1f1f1f;
					font-weight: 500;
					font-size: 13px;
					border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
										<p><h5 class="font-500"> ` +data.results[i].name + `</h5>
										<h5 class="font-400">` +data.results[i].company_name +` </h5>    </p>                              
									</a> `);   
				}
			}
		}
	});
	</script>
	
	
	
		
		
		
   



        