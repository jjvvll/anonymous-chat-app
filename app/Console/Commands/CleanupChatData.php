<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Username;
use App\Models\PublicRoom;
use App\Models\PrivateRoom;

class CleanupChatData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:chat-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all chat-related data every 24 hours, including users, rooms, and messages';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        // Username::truncate();
        // PublicRoom::whereHas('messages')->delete();
        // PrivateRoom::whereHas('privateMessages')->delete();

        // $this->info('Chat data cleaned up successfully.');

        // Delete all Usernames
        Username::truncate(); // This will delete all records in the 'usernames' table

        $this->info('All usernames deleted successfully!');

        // Delete all Public Rooms and their related messages
        PublicRoom::with('messages')->each(function ($publicRoom) {
            $publicRoom->messages()->delete(); // Delete related messages
            $publicRoom->delete(); // Delete the public room itself
        });

        $this->info('All public rooms and their messages deleted successfully!');

        // Delete all Private Rooms and their related private messages
        PrivateRoom::with('privateMessages')->each(function ($privateRoom) {
            $privateRoom->privateMessages()->delete(); // Delete related private messages
            $privateRoom->delete(); // Delete the private room itself
        });

        $this->info('All private rooms and their private messages deleted successfully!');
    }
}
