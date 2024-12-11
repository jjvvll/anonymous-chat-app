<?php

namespace App\Http\Controllers;
use App\Models\PublicRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Username;

class PublicRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicRooms = PublicRoom::all(); // Fetch all public rooms
        return view('public_rooms.index', compact('publicRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


       // Call the query scope to generate a unique public room name
       //$roomName = PublicRoom::generateUniquePublicRoom();  // Directly call the scope method


    // Fetch the username from session
        $username = $request->session()->get('username');

        // Check if username exists in session
        if (!$username) {
            // Handle the case where username is not found in the session
            return redirect()->route('usernames.create')->with('error', 'No username found in session.');
        }


        $request->validate([
            'nickname' => 'nullable|string|max:255',
        ]);

        $isDuplicate = PublicRoom::when($request->nickname, function ($query) use ($request) {
            return $query->CheckDuplicate($request->nickname);
        })->exists();


        if ($isDuplicate) {
            // Handle the case where the username already exists
            return redirect()->back()->withErrors(['nickname' => 'Nickname is already taken.']);
        }

       // Create a new public room with the generated name
       PublicRoom::create([
           'nickname' => $request->nickname, // Save the nickname if provided
            'owner'      => $username, // Use the fetched username as the owner
        ]);

        // Redirect back with a success message
        return redirect()->route('public_rooms.index')->with('success', 'Username Generated: ' . $username);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $publicRoom = PublicRoom::find($id);

          // If the room does not exist
          if (!$publicRoom) {
              echo "<script>
                  alert('The room has been deleted.');
                  window.location.href='" . route('public_rooms.index') . "';
              </script>";
          exit;
          }

        $messages = $publicRoom->messages()->latest()->get() ?? collect();

        return view('public_rooms.show', compact('publicRoom', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicRoom $publicRoom)
    {

         // Ensure the user is the owner of the room
    if ($publicRoom->owner === Session::get('username')) {
        // Delete the public room
        $publicRoom->delete();

        // Delete the username associated with the owner (without relationship)
       // Username::where('username', $publicRoom->owner)->delete();

        return redirect()->route('public_rooms.index')->with('success', 'Public Room deleted successfully.');
    }

    return redirect()->route('public-rooms.index')->with('error', 'You are not the owner of this room.');
    }

    public function setJoinSession()
    {
        // Set the session variable 'join' to true
        session(['join' => true]);

        // Check if the user has a 'username', redirect accordingly
        if (Session::has('username')) {
            session(['join' => false]); // set join to false
            return redirect()->route('public_rooms.index');
        }

        return redirect()->route('usernames.create');
    }

}
