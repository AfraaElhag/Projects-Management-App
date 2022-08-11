    
@extends('layouts.app')

@section('content')
@include('layouts.header', ['title' =>  __('text.Users List')  ])      
     

        
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
            <div class="content mb-2 ">
                @include('flash::message')
                
            @canany(['isAdmin','isCustomerService'])
            <a href="{{ route('users.create') }}" class="btn btn-m mt-1 mb-4 btn-full  border-highlight  color-black rounded-s text-uppercase font-900" >{{ __('text.Add New User') }}</a>

            @endcan
            
             @foreach($users as $user)
                @if ( $user->trashed()) 
                
                <div class="d-flex mb-3 bg-fade-night-light" id="user{{$user->id}}">
                @else
                <a href="{{ route('users.edit', [$user->id]) }}">
                
                <div class="d-flex mb-3" id="user{{$user->id}}">
                    @endif
                    <div class="align-self-center">
                        <img src="{{ asset('images/avatars/user.png') }}" class="me-3 rounded-circle shadow-l bg-fade-red-dark" width="50">
                    </div>
                    <div class="ps-2 ms-1 align-self-center w-100">
                        <h5 class="font-500 mb-1">{{$user->name}} 
                            <span class="badge bg-red-dark   mt-0 p-1 font-12 font-400"  >
                                @if( $user->role == 'admin')
                                {{ __('text.Admin') }}
                                @elseif($user->role == 'senior designer')
                                {{ __('text.Senior Designer') }}
                                @elseif($user->role == 'junior designer')
                                {{ __('text.Junior Designer') }}
                                @elseif($user->role == 'customer service')
                                {{ __('text.Customer Service') }}
                                @elseif($user->role == 'accountant')
                                {{ __('text.Accountant') }}
                                @elseif($user->role == 'department manager')
                                {{ __('text.Department Manager') }}
                                @elseif($user->role == 'project manager')
                                {{ __('text.Project Manager') }}

                                 @endif
                            </span>
                        </h5>
                        <p class="mt-n1 font-11 mb-0"> {{$user->email}} </p>
                        <p class="mt-n1 font-11 mb-0"> {{$user->phone}}</p>

                                    
                                        
                                            
                    </div> 
                </div>
                              
               
                        
                <div class="divider mb-3"></div>
             </a>
            @endforeach



                
              
     

                
            


        @if ($users  and $users->hasPages() )
        <nav aria-label="pagination-demo">
            <ul class="pagination justify-content-center"  style="padding-right: 0px !important">
				@if ($users->onFirstPage())
                <li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@else 
				<li class="page-item">
                    <a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $users->previousPageUrl() }}" tabindex="-1" aria-disabled="true"><i class="fa fa-angle-right"></i></a>
                </li>
				@endif

				@php
					if($users->lastPage() <5)
					$length=$users->lastPage();
					else {
						$length=4;
					}
					
				@endphp
				@for ($page = 1; $page <= $length; $page++)
				@if ($page == $users->currentPage())
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="#" tabindex="-1" aria-disabled="true">{{ $page }}</a>

				@else
				<li class="page-item"><a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $users->url($page) }}">{{ $page }}</a></li>

	
				@endif
			@endfor

			@if ($users->hasMorePages())
			<li class="page-item">
				<a class="page-link rounded-xs bg-highlight color-white border-0" href="{{ $users->nextPageUrl() }}" rel="next" ><i class="fa fa-angle-left"></i></a>

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

            $.post('{{ route("usersearch") }}',
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
           $(searchResult).append(`<p> {{ __('text.No Results') }}</p>`);
        }

        else
        {
            for(let i = 0; i < data.results.length; i++){
                $( searchResult ).append( `<a href="users/` +data.results[i].id+     `/edit "  style="line-height: 70px;
                color: #1f1f1f;
                font-weight: 500;
                font-size: 13px;
                border-bottom: solid 1px rgba(0, 0, 0, 0.05);">
                                    <span>` +data.results[i].name + `</span>
                                                                      
                                </a> `);   
            }
        }
    }
});

function deletefun(id){
    event.preventDefault(); 
                                swal({
  title: 'Are you sure?',
  text: 'Once deleted, you will not be able to recover!',
  
  buttons: true,
  dangerMode: true,
}).then((result) => {
                                    if (result) {
                                        document.getElementById('delete-form'+id).submit();
  } else {
    
  }
                                
                                    });
}


</script>


