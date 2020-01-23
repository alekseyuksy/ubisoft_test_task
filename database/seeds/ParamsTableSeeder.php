<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParamsTableSeeder extends Seeder
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
                'title' => 'Amount',
                'type' => 'float',
                'key' => 'amount',
            ],
            [
                'title' => 'Description',
                'type' => 'string',
                'key' => 'description',
            ]
        ];

        foreach ($events as $event) {
            $event['created_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

            DB::table('params')->insert(
                $event
            );
        }
    }
}
