<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipType;

class AddMembershipTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Individuals", "Organizations", "Fellowship"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = MembershipType::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                MembershipType::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
