@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<form method="POST" action="{{ route('usernames.store') }}">
    @csrf

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="mb-4">
        <label for="username" class="block text-sm font-medium text-gray-700">Enter Username</label>
        <input
            type="text"
            name="username"
            id="username"
            class="block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter your desired username"
            required
        />
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate Username
    </button>
</form>

@endsection
