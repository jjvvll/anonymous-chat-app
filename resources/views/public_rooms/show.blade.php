<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Public Room: {{ $publicRoom->nickname }}</h1>
        <p><strong>Owner:</strong> {{ $publicRoom->owner ?? 'N/A' }}</p>

        <!-- Add any additional information you'd like to display for the room -->

        @if(Session::get('username') === $publicRoom->owner)
            <!-- Only show the delete button if the user is the owner -->
            <form action="{{ route('public_rooms.destroy', $publicRoom->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room and the associated username?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete Public Room
                </button>
            </form>
        @endif
    </div>
@endsection
