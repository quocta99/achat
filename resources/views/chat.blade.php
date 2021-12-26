@extends('layouts.no-header')

@section('content')
    <chat-component :auth="{{ auth()->user() }}">
        <template #logout>
            <span class="logout">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <i class="fal fa-sign-out-alt text-secondary" id="logout-button"></i>
            </span>
        </template>
    </chat-component>
@endsection

@push('scripts')
    <script>
        $('#logout-button').on('click', function(event) {
            event.preventDefault()
            Swal.fire({
                title: '<strong>Confirm <u>now!</u></strong>',
                icon: 'info',
                html:
                    'You want to <b>logout</b>, ' +
                    '<a href="chat">Achat</a> ' +
                    'system ?',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Great!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    '<i class="fa fa-thumbs-down"></i>',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $("#logout-form").submit()
                } 
            })
        })
    </script>
@endpush