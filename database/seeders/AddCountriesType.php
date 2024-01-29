<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CountriesType;

class AddCountriesType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Very High Human Development Countries", "High Human Development Countries", "Medium Human Development Countries","Low Human Development Countries"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CountriesType::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CountriesType::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
