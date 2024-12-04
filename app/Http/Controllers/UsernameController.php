<?php

namespace App\Http\Controllers;

use App\Models\Username;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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

       session(['username' => $username]); // sotre the session here

        // Redirect back with a success message
        if (Session::has('join') && session('join') === true) {
            // Set 'join' to false if it's true
            session(['join' => false]);

            // Redirect to public_rooms.index
            return redirect()->route('public_rooms.index')->with('success', 'Username Generated: ' . $publicUsername->username);
        } else {
            // Redirect to public_rooms.create if 'join' is not true
            return redirect()->route('public_rooms.create')->with('success', 'Username Generated: ' . $publicUsername->username);
        }
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
