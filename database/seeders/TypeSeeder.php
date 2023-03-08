<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Type as Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Medical',
            'Building',
            'Web development',
            'Scientific research',
            'Entertainment',
            'Agricultural ',
            'Manifacturing'
        ];

        foreach($types as $type){
            $newType = new Type();

            $newType->title = $type;
            $newType->slug = Str::slug($type, '-');

            $newType->save();
        }
    }
}