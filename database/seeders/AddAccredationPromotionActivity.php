<?php

namespace Database\Seeders;

use App\Models\AccredationPromotionActivity;
use Illuminate\Database\Seeder;
use App\Models\CMEPromotionActivity;

class AddAccredationPromotionActivity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Digital Promotion", "Brochure/Invitation", "E-Newsletter","Webpage", "Email", "Online Advertisement",
        "Others - Specify", "Print Promotion", "Invitation","Announcement", "Newsletter", "Print Advertisement","Brochure/Flyer/Handout", "Poster or Signs",
    "Bulletin Board/Office Memo"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationPromotionActivity::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationPromotionActivity::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
