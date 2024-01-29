<?php

namespace Database\Seeders;

use App\Models\HealthInnovationInitiativeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthInnovationInitiativeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = ["Policies", "Practices", "Systems", "Products", "Technologies", "Services", "Delivery Methods", "Other, Specify"];

        for ($i = 0; $i < count($names); $i++) {
            $is_exist = HealthInnovationInitiativeType::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                HealthInnovationInitiativeType::create([
                    'name' => $names[$i]
                ]);
            }
        }
    }
}
