<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = ['HTML', 'CSS', 'BOOTSTRAP','SASS', 'JS', 'PHP', 'VUE', 'LARAVEL', 'MySQL'];
        foreach ($labels as $label) {
            $tech = new Technology();
            $tech->label = $label;
            $tech->save();
        }
    }
}
