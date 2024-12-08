<!-- resources/views/private_room_form.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-4">Enter Private Room</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('private_rooms.verify') }}" method="POST">
        @csrf

        <input type="hidden" name="room_id" value="{{ $roomId }}">

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full mt-1 p-2 border rounded shadow-sm" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Enter Room
        </button>
    </form>
</div>
@endsection
