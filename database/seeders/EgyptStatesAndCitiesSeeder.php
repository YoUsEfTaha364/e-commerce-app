<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\State;
use App\Models\City;

class EgyptStatesAndCitiesSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::post(
            'https://countriesnow.space/api/v0.1/countries/states',
            ['country' => 'Egypt']
        );

        $states = $response->json('data.states');

        foreach ($states as $stateData) {
            $state = State::create([
                'name' => $stateData['name'],
                'country_code' => 'EG',
            ]);

            $citiesResponse = Http::post(
                'https://countriesnow.space/api/v0.1/countries/state/cities',
                [
                    'country' => 'Egypt',
                    'state' => $stateData['name'],
                ]
            );

            foreach ($citiesResponse->json('data') as $city) {
                City::create([
                    'state_id' => $state->id,
                    'name' => $city,
                ]);
            }
        }
    }
}
