<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $states = [
            'Cairo' => [
                'Nasr City',
                'Heliopolis',
                'Maadi',
                'Shubra',
                'New Cairo',
                'Helwan',
                'Mokattam',
                'Zamalek',
                'Downtown Cairo',
                'Giza City', // Note: Giza is in Giza Governorate, but often associated; adjust if needed
            ],

            'Giza' => [
                'Giza',
                '6th of October',
                'Sheikh Zayed',
                'Haram',
                'Imbaba',
                'Dokki',
                'Agouza',
                'Mohandessin',
            ],

            'Alexandria' => [
                'Alexandria',
                'Borg El Arab',
                'Miami',
                'Sidi Gaber',
                'Montaza',
                'Smouha',
                'Stanley',
            ],

            'Port Said' => [
                'Port Said',
                'Port Fouad',
            ],

            'Dakahlia' => [
                'Mansoura',
                'Talkha',
                'Mit Ghamr',
                'Belqas',
                'Sherbin',
            ],

            'Sharqia' => [
                'Zagazig',
                '10th of Ramadan',
                'Belbeis',
                'Abu Kabir',
                'Minya Al Qamh',
            ],

            'Gharbia' => [
                'Tanta',
                'Mahalla El Kubra',
                'Kafr El Zayat',
                'Zefta',
            ],

            'Kafr El-Sheikh' => [
                'Kafr El-Sheikh',
                'Desouk',
                'Baltim',
                'Fuwa',
            ],

            'Monufia' => [
                'Shibin El Kom',
                'Menouf',
                'Sadat City',
                'Ashmoun',
            ],

            'Qalyubia' => [
                'Banha',
                'Qalyub',
                'Shubra El Kheima',
                'Khanka',
                'Toukh',
                'Obour',
            ],

            'Beheira' => [
                'Damanhur',
                'Kafr El Dawwar',
                'Rosetta',
                'Edko',
            ],

            'Damietta' => [
                'Damietta',
                'New Damietta',
                'Ras El Bar',
                'Faraskur',
            ],

            'Ismailia' => [
                'Ismailia',
                'Fayed',
                'Qantara East',
                'Qantara West',
            ],

            'Suez' => [
                'Suez',
                'Ain Sokhna',
                'Arbaeen',
            ],

            'Beni Suef' => [
                'Beni Suef',
                'Al Wasta',
                'Nasser',
                'Ehnasia',
            ],

            'Faiyum' => [ // Corrected spelling: Fayoum → Faiyum (standard English transliteration)
                'Faiyum',
                'Sinnuris',
                'Ibshaway',
                'Itsa',
                'Yusuf El Seddik',
            ],

            'Minya' => [
                'Minya',
                'Mallawi',
                'Samalut',
                'Abu Qurqas',
            ],

            'Asyut' => [
                'Asyut',
                'Dayrut',
                'Manfalut',
                'Abnub',
            ],

            'Sohag' => [
                'Sohag',
                'Akhmim',
                'Girga',
                'Tahta',
            ],

            'Qena' => [
                'Qena',
                'Nag Hammadi',
                'Qus',
                'Farshut',
            ],

            'Luxor' => [
                'Luxor',
                'Armant',
                'Esna',
            ],

            'Aswan' => [
                'Aswan',
                'Kom Ombo',
                'Edfu',
                'Abu Simbel',
            ],

            'Red Sea' => [
                'Hurghada',
                'Safaga',
                'El Quseir',
                'Marsa Alam',
            ],

            'New Valley' => [
                'Kharga',
                'Dakhla',
                'Farafra',
            ],

            'Matrouh' => [
                'Marsa Matrouh',
                'El Alamein',
                'Siwa Oasis',
                'Sallum',
            ],

            'North Sinai' => [
                'El Arish',
                'Sheikh Zuweid',
                'Rafah',
            ],

            'South Sinai' => [
                'Sharm El Sheikh',
                'Dahab',
                'Nuweiba',
                'Taba',
                'Saint Catherine',
            ],
        ];

        foreach ($states as $stateName => $cities) {
            $state = State::create([
                'name' => $stateName,
                'country_code' => 'EG',
            ]);

            foreach ($cities as $city) {
                City::create([
                    'name' => $city,
                    'state_id' => $state->id,
                ]);
            }
        }
    }

    }

