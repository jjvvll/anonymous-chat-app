@extends('layouts.app')



@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Public Rooms</h1>

        @if($publicRooms->isEmpty())
            <p class="text-gray-600">No public rooms available.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Public Room</th>
                        {{-- <th class="border border-gray-300 px-4 py-2">Nickname</th> --}}
                        <th class="border border-gray-300 px-4 py-2">Owner</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicRooms as $room)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('public_rooms.show', $room->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $room->nickname }}
                                </a>
                            </td>
                            {{-- <td class="border border-gray-300 px-4 py-2">{{ $room->nickname ?? 'N/A' }}</td> --}}
                            <td class="border border-gray-300 px-4 py-2">{{ $room->owner ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
