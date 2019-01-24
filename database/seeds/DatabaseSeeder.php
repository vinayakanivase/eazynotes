<?php

use App\User;
use App\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Note::truncate();

        factory(User::class, 20)->create();
        factory(Note::class, 200)->create();

        // Change the first user data
        $user = User::find(1);
        $user->name = 'admin';
        $user->email = 'admin@eazynotes.io';
        $user->save();
    }
}
