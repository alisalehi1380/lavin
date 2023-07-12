<?php

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProvinceCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createProvincesAndCities();
    }
    public function createProvincesAndCities(): void
    {
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        foreach ($data['states'] as $d) {
            $province = new Province();
            $province->name = $d['name'];
            $province->slug = SlugService::createSlug(Province::class, 'slug',$d['name']);
            $province->status = 1;
            $province->save();

            $province->province_meta()->create([
                'offset-x' => $d['offset-x'],
                'offset-y' => $d['offset-y'],
                'd' => $d['d']
            ]);

            if ($d['cities'] > 0) {
                foreach ($d['cities'] as $c) {
                    $city = new City();
                    $city->province_id = $province->id;
                    $city->name = $c['name'];
                    $city->slug = SlugService::createSlug(City::class, 'slug',$c['name']);
                    $city->status = 1;
                    $city->save();
                }
            }

        }
    }
}
