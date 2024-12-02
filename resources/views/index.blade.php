@extends('layouts.app')


@section('content')

<h1>this is index</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class ="mb-4">
    <a href="{{route('public_rooms.create')}}" class="reset-link">
       Create a public room!
    </a>
</div>

<div class ="mb-4">
    <a href="#" class="reset-link">
       Join a public room!
    </a>
</div>

@endsection

