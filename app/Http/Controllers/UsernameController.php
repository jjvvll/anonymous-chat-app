<?php

namespace App\Http\Controllers;

use App\Models\Username;
use Illuminate\Http\Request;

class UsernameController extends Controller
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
        return view('usernames.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {

       $username = Username::GenerateUniqueUsername();  // Directly call the scope method

       $publicUsername = Username::create([
           'username' => $username, // Assuming 'name' is the column where the room name is saved
       ]);

        // Redirect back with a success message
        return redirect()->route('index')->with('success', 'Username  Generated: ' . $publicUsername->username);
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
