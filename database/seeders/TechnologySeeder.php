<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'html', 'css', 'javascript', 'java', 'laravel', 'vue', 'react', 'C', 'sass'
        ];

        foreach ($technologies as $key => $technology) {
            
            $newTechnology = new Technology();

            $newTechnology->title = $technology;
            $newTechnology->slug = Str::slug($technology);

            $newTechnology->save();
        }
    }
}