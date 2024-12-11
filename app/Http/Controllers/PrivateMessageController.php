<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\PrivateRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PrivateRoom $privateRoom)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'sender' => 'required|string',
        ]);

          // Encrypt the message
         $validated['message'] = Crypt::encryptString($validated['message']);

        $privateRoom->privateMessages()->create($validated);

        return redirect()->route('private_rooms.show', $privateRoom)
                         ->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrivateMessage $privateMessage)
    {
        //
    }
}
