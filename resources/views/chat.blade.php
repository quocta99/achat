@extends('layouts.no-header')

@section('content')
    <chat-component :auth="{{ auth()->user() }}">
        <template #logout>
            <span class="logout">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <i class="fal fa-sign-out-alt text-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>
            </span>
        </template>
    </chat-component>
@endsection