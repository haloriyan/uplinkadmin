<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name' => 'categories',
                'value' => "Influencer,Digital Marketer,Entrepreneurs,Corporate,University,Brand,Public Figure,SME,Hotel,Restaurant,Other"
            ],
            [
                'name' => "withdraw_fee",
                'value' => '5'
            ]
        ];

        foreach ($datas as $data) {
            Setting::create($data);
        }
    }
}
