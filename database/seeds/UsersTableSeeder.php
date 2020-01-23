<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Action;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        $device = [
            'PC',
            'iOs',
            'Android',
        ];

        $acquisition = [
            'advertisement',
            'invitation',
            'self',
        ];

        while ($i <= 70):
            $key = array_rand($device);
            $keyAcq = array_rand($acquisition);
            $days = rand(0, 40) - 15;

            $user = new \App\User();

            $attributes = [
                'name' => 'Test_' . $i,
                'email' => 'test_' . $i . '@material.com',
                'email_verified_at' => now(),
                'device' => $device[$key],
                'acquisition' => $acquisition[$keyAcq],
                'password' => Hash::make('secret'),
                'created_at' => \Carbon\Carbon::now()->addDays($days)->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->addDays($days)->format('Y-m-d H:i:s'),
            ];

            foreach ($attributes as $key => $value) {
                $user->{$key} = $value;
            }

            $user->save();
            $i++;

            $action = new \App\Action();
            $action->user = $user->id;
            $action->event = 'register';
            $action->created_at = \Carbon\Carbon::now()->addDays($days)->format('Y-m-d H:i:s');
            $action->save();

            $action = new \App\Action();
            $action->user = $user->id;
            $action->event = 'sign_in';
            $action->created_at = \Carbon\Carbon::now()->addDays($days)->format('Y-m-d H:i:s');
            $action->save();

            $events = \App\Event::all();

            foreach ($events as $event) {
                if ($event->key != 'register' && $event->key != 'sign_in') {
                    $action = new Action();

                    if ($event->key != 'first_payment' && $event->key != 'future_payment') {
                        $action->user = $user->id;
                        $action->event = $event->key;
                        $action->created_at = \Carbon\Carbon::now()->addDays($days + rand(1,
                                7))->format('Y-m-d H:i:s');
                        $action->save();
                    } else {

                        $payOrNot = rand(0, 1);

                        if ($payOrNot > 0) {
                            if ($event->key == 'first_payment') {
                                $action->user = $user->id;
                                $action->event = $event->key;
                                $action->amount = (rand(10, 200) / 10);
                                $action->created_at = \Carbon\Carbon::now()->addDays($days + rand(1,
                                        7))->format('Y-m-d H:i:s');
                                $action->save();
                            } else {
                                for ($counter = 1; $counter <= 5; $counter++) {
                                    $payOrNot = rand(0, 1);
                                    if ($payOrNot > 0) {
                                        $action = new Action();
                                        $action->user = $user->id;
                                        $action->event = $event->key;
                                        $action->amount = rand(10, 200) / 10;
                                        $action->created_at = \Carbon\Carbon::now()->addDays($days + rand(1,
                                                7))->format('Y-m-d H:i:s');
                                        $action->save();
                                    }
                                }
                            }
                        }
                    }
                }

            }

        endwhile;
    }
}
