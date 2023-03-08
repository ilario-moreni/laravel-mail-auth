<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project as Project;
use Faker\Generator as Faker;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<=10; $i++){
            $newProject = new Project();
            $newProject->title = $faker->words(3, true);
            $newProject->description = $faker->text(500);
            $newProject->members_num = $faker->numberBetween(1, 30);
            $newProject->budget = $faker->numberBetween(1000, 1000000);
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->file_img = $faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg');
            $newProject->save();
        }
    }
}