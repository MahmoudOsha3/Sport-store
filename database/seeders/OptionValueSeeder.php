<?php

namespace Database\Seeders;

use App\Models\OptionValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $options = [
            [
                'option_id' => 1 ,
                'value' => 'red' ,
            ],
            [
                'option_id' => 1 ,
                'value' => 'white' ,
            ],
            [
                'option_id' => 1 ,
                'value' => 'black' ,
            ],
            [
                'option_id' => 1 ,
                'value' => 'white' ,
            ],

            [
                'option_id' => 1 ,
                'value' => 'blue' ,
            ],

            [
                'option_id' => 1 ,
                'value' => 'yellow' ,
            ],

            [
                'option_id' => 1 ,
                'value' => 'orange' ,
            ],

            [
                'option_id' => 2 ,
                'value' => 'L' ,
            ],
            [
                'option_id' => 2 ,
                'value' => 'M' ,
            ],
            [
                'option_id' => 2 ,
                'value' => 'XL' ,
            ],

            [
                'option_id' => 2 ,
                'value' => 'XXL' ,
            ],
        ];
        foreach ($options as $option) {
            OptionValue::create($option) ;
        }
    }
}
