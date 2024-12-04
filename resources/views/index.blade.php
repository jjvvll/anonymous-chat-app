@extends('layouts.app')


@section('content')

<h1>Current Username: {{ Session::get('username') }}</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="mb-4">
    @if(Session::has('username'))
        <a href="{{ route('public_rooms.create') }}" class="reset-link">
            Create a public room!
        </a>
    @else
        <a href="{{ route('usernames.create') }}" class="reset-link">
            Create a public room!
        </a>
    @endif
</div>


<div class="mb-4">
    @if(Session::has('username'))
        <!-- Link to set the session 'join' to true and redirect to public rooms index -->
        <a href="{{ route('setJoinSession') }}" class="reset-link">
            Join a public room!
        </a>
    @else
        <!-- Link to set the session 'join' to true and redirect to usernames.create -->
        <a href="{{ route('setJoinSession') }}" class="reset-link">
            Join a public room!
        </a>
    @endif
</div>



@endsection

