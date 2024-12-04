@extends('layouts.app')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@section('content')
    <form method="POST" action="{{ route('public_rooms.store') }}">
        @csrf
        <div class="mb-4">
            <label for="nickname" class="block text-gray-700 font-bold mb-2">Nickname:</label>
            <input type="text" id="nickname" name="nickname"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   placeholder="Enter a nickname">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Generate Public Room
        </button>
    </form>
@endsection
