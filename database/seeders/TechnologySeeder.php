<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'HTML',
            ],
            [
                'name' => 'CSS',
            ],
            [
                'name' => 'Javascript',
            ],
            [
                'name' => 'Vuejs',
            ],
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'Laravel',
            ],
        ];

        foreach ($technologies as $technology){
            $new_technology = new Technology();
            $new_technology->name = $technology['name'];
            $new_technology->save();
        }
    }
}
