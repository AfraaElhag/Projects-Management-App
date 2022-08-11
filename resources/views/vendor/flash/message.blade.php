@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert text-center
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

        @if($message['message'] =='User saved successfully.')
            {{ __('text.User saved successfully') }}
        @elseif($message['message'] =='User updated successfully.')
            {{ __('text.User updated successfully') }}
        @elseif($message['message'] =='User deleted successfully.')
            {{ __('text.User deleted successfully') }}
        @elseif($message['message'] =='User not found')
            {{ __('text.User not found') }}

        @elseif($message['message'] =='Project saved successfully.')
            {{ __('text.Project saved successfully') }}
        @elseif($message['message'] =='Project updated successfully.')
            {{ __('text.Project updated successfully') }}
        @elseif($message['message'] =='Project deleted successfully.')
            {{ __('text.Project deleted successfully') }}
        @elseif($message['message'] =='Project not found')
            {{ __('text.Project not found') }}

        @elseif($message['message'] =='Task saved successfully.')
            {{ __('text.Task saved successfully') }}
        @elseif($message['message'] =='Task updated successfully.')
            {{ __('text.Task updated successfully') }}
        @elseif($message['message'] =='Task deleted successfully.')
            {{ __('text.Task deleted successfully') }}
        @elseif($message['message'] =='Task not found')
            {{ __('text.Task not found') }}

        @elseif($message['message'] =='Client saved successfully.')
            {{ __('text.Client saved successfully') }}
        @elseif($message['message'] =='Client updated successfully.')
            {{ __('text.Client updated successfully') }}
        @elseif($message['message'] =='Client deleted successfully.')
            {{ __('text.Client deleted successfully') }}
        @elseif($message['message'] =='Client not found')
            {{ __('text.Client not found') }}
        @elseif($message['message'] =='not allowed')
            {{ __('text.Not Allowed') }}
        @elseif($message['message'] =='previous not completed')
            {{ __('text.previous not completed') }}    
        
        
        @endif
        
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
