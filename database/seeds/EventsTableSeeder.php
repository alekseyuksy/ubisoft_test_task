<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Registration',
                'key' => 'register',
            ],
            [
                'title' => 'Sign In',
                'key' => 'sign_in',
            ],
            [
                'title' => 'Sign Out',
                'key' => 'sign_out',
            ],
            [
                'title' => 'First Payment',
                'key' => 'first_payment',
            ],
            [
                'title' => 'Future payment',
                'key' => 'future_payment',
            ],
            [
                'title' => 'Friend Invite',
                'key' => 'invite',
            ],
            [
                'title' => 'Complete tutorial',
                'key' => 'complete_tutorial',
            ],
            [
                'title' => 'In-game purchase',
                'key' => 'in_game_purchase',
            ],
            [
                'title' => 'Level Up',
                'key' => 'level_up',
            ],
            [
                'title' => 'Add friend',
                'key' => 'add_fiend',
            ],
        ];

        foreach ($events as $event) {
            $event['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

            DB::table('events')->insert(
                $event
            );
        }
    }
}
