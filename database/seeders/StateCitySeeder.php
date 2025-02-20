<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class StateCitySeeder extends Seeder
{
    public function run()
    {
        $state1 = State::create(['state' => 'Maharashtra']);
        $state2 = State::create(['state' => 'Madhya Pradesh']);

        City::create(['city' => 'Pune', 'state_id' => $state1->id]);
        City::create(['city' => 'Mumbai', 'state_id' => $state1->id]);
        City::create(['city' => 'Nashik', 'state_id' => $state1->id]);
        City::create(['city' => 'Itarasi', 'state_id' => $state2->id]);
		City::create(['city' => 'Indore', 'state_id' => $state2->id]);
    }
}
