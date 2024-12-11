<?php

namespace App\Http\Controllers;

use App\Models\PrivateRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Username;
use Illuminate\Support\Facades\Hash;

class PrivateRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $privateRooms = PrivateRoom::all(); // Fetch all public rooms
        return view('private_rooms.index', compact('privateRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('private_rooms.create');
    }


    public function join(string $id)
    {
        // dd('Join method called for room ID: ' . $id);
         // Pass the room ID to the view
        return view('private_rooms.pass', ['roomId' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $username = $request->session()->get('username');

        // Check if username exists in session
        if (!$username) {
            // Handle the case where username is not found in the session
            return redirect()->route('usernames.create')->with('error', 'No username found in session.');
        }


        $request->validate([
            'nickname' => 'nullable|string|max:255',
        ]);

        $isDuplicate = PrivateRoom::when($request->nickname, function ($query) use ($request) {
            return $query->CheckDuplicate($request->nickname);
        })->exists();


        if ($isDuplicate) {
            // Handle the case where the username already exists
            return redirect()->back()->withErrors(['nickname' => 'Nickname is already taken.']);
        }

       // Create a new public room with the generated name
       PrivateRoom::create([
           'nickname' => $request->nickname, // Save the nickname if provided
            'owner'      => $username, // Use the fetched username as the owner
            'password' =>  Hash::make($request->password)
        ]);

        // Redirect back with a success message
        return redirect()->route('private_rooms.index')->with('success', 'Username Generated: ' . $username);
    }

    /**
     * Display the specified resource.
     */


public function verify(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'password' => 'required|string',
        'room_id' => 'required|integer', // Ensure room_id is included in the request
    ]);

    // Find the room by ID
    $privateRoom = PrivateRoom::find($request->room_id);

    // Check if the room exists
    if (!$privateRoom) {
        return back()->withErrors(['room_id' => 'The specified room does not exist.']);
    }

    // Verify the password matches
    if (!Hash::check($request->password, $privateRoom->password)) {
        return back()->withErrors(['password' => 'Incorrect password for this room.']);
    }

    // Redirect to the room's page on success
    return redirect()->route('private_rooms.show', ['private_room' => $privateRoom->id]);
}
    public function show( $id)
    {
         // Attempt to find the room by ID
        $privateRoom = PrivateRoom::find($id);

        // If the room does not exist
        if (!$privateRoom) {
            echo "<script>
                alert('The room has been deleted.');
                window.location.href='" . route('private_rooms.index') . "';
            </script>";
        exit;
        }
        $messages = $privateRoom->privateMessages()->latest()->get() ?? collect();
        return view('private_rooms.show', compact('privateRoom', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrivateRoom $privateRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrivateRoom $privateRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrivateRoom $privateRoom)
    {
        if ($privateRoom->owner === Session::get('username')) {
            // Delete the public room
            $privateRoom->delete();

            // Delete the username associated with the owner (without relationship)
            //Username::where('username', $privateRoom->owner)->delete();

            return redirect()->route('private_rooms.index')->with('success', 'Private Room deleted successfully.');
        }
    }
}
