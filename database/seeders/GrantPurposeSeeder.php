<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GrantPurpose;

class GrantPurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = ["Organizing Educational Activities",
                "Conducting Research Study/ies", 
                "Conducting a Health Innovation Initiative/s", 
                "Supporting an Outreach Program",
                "Covering ICHS Application Fees",
                "Covering ICHS Publication Fees",
                "Others"];
        for ($i = 0; $i < count($names); $i++) {
            $is_exist = GrantPurpose::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                GrantPurpose::create([
                    'name' => $names[$i]
                ]);
            }
        }
    }
}
