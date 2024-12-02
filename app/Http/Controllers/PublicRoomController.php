<?php

namespace App\Http\Controllers;
use App\Models\PublicRoom;
use Illuminate\Http\Request;

class PublicRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // return view('public_rooms.index');
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
    public function store()
    {
       // Call the query scope to generate a unique public room name
       $roomName = PublicRoom::generateUniquePublicRoom();  // Directly call the scope method

       // Create a new public room with the generated name
       $publicRoom = PublicRoom::create([
           'publicRoom' => $roomName, // Assuming 'name' is the column where the room name is saved
       ]);

        // Redirect back with a success message
        return redirect()->route('usernames.create')->with('success', 'Public Room Generated: ' . $publicRoom->publicRoom);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
