@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Private Room: {{ $privateRoom->nickname }}</h1>
        <p><strong>Owner:</strong> {{ $privateRoom->owner ?? 'N/A' }}</p>

        <!-- Add any additional information you'd like to display for the room -->

        @if(Session::get('username') === $privateRoom->owner)
            <!-- Only show the delete button if the user is the owner -->
            <form action="{{ route('private_rooms.destroy', $privateRoom->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room and the associated messages?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete Private Room
                </button>
            </form>
        @endif

        <!-- Message Section -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Messages</h2>

            @php
                $lastSender = null;
            @endphp

            <!-- Display Messages -->
            @if($messages->isEmpty())
                <p class="text-gray-600">No messages yet. Be the first to send one!</p>
            @else
                <!-- Messages Container -->
                <div class="space-y-4 overflow-y-auto max-h-96" id="message-container">
                    @foreach($messages->reverse()  as $message)

                    @php
                        // Check if the sender is different from the previous message
                        $isDifferentSender = $message->sender !== $lastSender;
                        $lastSender = $message->sender; // Update the last sender
                    @endphp

                    <div class="flex justify-{{ $message->sender === session('username') ? 'end' : 'start' }} items-start">
                        <!-- Message Container -->
                        <div class="flex flex-col">
                              <!-- Sender Name (only if it's different from the last sender) -->
                            @if($isDifferentSender)
                                <p class="text-sm text-{{ $message->sender === session('username') ? 'blue' : 'gray' }}-600 mb-1">
                                    {{ $message->sender }}
                                </p>
                            @endif
                            <!-- Message Bubble -->
                            <div class="bg-{{ $message->sender === session('username') ? 'blue' : 'gray' }}-200 p-3 rounded-lg shadow-md max-w-xs break-words">
                                <p class="text-sm text-{{ $message->sender === session('username') ? 'white' : 'gray' }}-900">
                                    @php
                                        try {
                                            echo Crypt::decryptString($message->message);
                                        } catch (\Exception $e) {
                                            echo "Message could not be decrypted.";
                                        }
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            <!-- Message Form -->
            <form method="POST" action="{{ route('private_rooms.privateMessages.store', $privateRoom) }}">
                @csrf

                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea
                        name="message"
                        id="message"
                        rows="3"
                        class="block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your message here..."
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden Sender Field -->
                <input type="hidden" name="sender" value="{{ session('username') }}">

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Scroll to the bottom of the message container when the page loads or new messages are added
        window.onload = function() {
            const messageContainer = document.getElementById('message-container');
            messageContainer.scrollTop = messageContainer.scrollHeight;
        };
    </script>
    @endpush
@endsection
