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
        <a href="{{ route('usernames.create', ['room_type' => 'public', 'action_type' => 'create']) }}" class="reset-link">
            Create a public room!
        </a>
    @endif
</div>

<div class="mb-4">
    @if(Session::has('username'))
    <a href="{{ route('private_rooms.create') }}" class="reset-link">
        Create a private room!
    </a>
@else
    <a href="{{ route('usernames.create', ['room_type' => 'private', 'action_type' => 'create']) }}" class="reset-link">
        Create a private room!
    </a>
@endif
</div>


<div class="mb-4">

    @if(Session::has('username'))
        <a href="{{ route('public_rooms.index') }}" class="reset-link">
            Join a public room!
        </a>
        <a href="{{ route('private_rooms.index') }}" class="reset-link">
            Join a private room!
        </a>
    @else
        <a href="{{ route('usernames.create', ['room_type' => 'private', 'action_type' => 'join']) }}" class="reset-link">
            Join a private room!
        </a>
        <a href="{{ route('usernames.create', ['room_type' => 'public', 'action_type' => 'join']) }}" class="reset-link">
            Join a public room!
        </a>
    @endif



</div>



@endsection

