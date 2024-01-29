<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_zones')->insert([
            ['utc_offset'=>'UTC +14','locations'=>'Christmas Island/Kiribati','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +13:45','locations'=>'Chatham Islands/New Zealand','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +13','locations'=>'New Zealand with exceptions and 5 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +12','locations'=>'Fiji, small region of Russia and 7 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +11','locations'=>'much of Australia and 7 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +10:30','locations'=>'small region of Australia	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +10','locations'=>'Queensland/Australia and 6 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +9:30','locations'=>'Northern Territory/Australia','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +9','locations'=>'Japan, South Korea and 5 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +8:45','locations'=>'Western Australia/Australia	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +8','locations'=>'China, Philippines and 10 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +7','locations'=>'much of Indonesia, Thailand and 7 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +6:30','locations'=>'Myanmar and Cocos Islands','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +6','locations'=>'Bangladesh and 6 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +5:45','locations'=>'Nepal','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +5:30','locations'=>'India and Sri Lanka','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +5','locations'=>'Pakistan and 9 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +4:30','locations'=>'Afghanistan','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +4','locations'=>'Azerbaijan and 8 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +3:30','locations'=>'Iran','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +3','locations'=>'Moscow/Russia and 23 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +2','locations'=>'Greece and 30 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +1','locations'=>'Germany and 45 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC +0','locations'=>'United Kingdom and 24 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -1','locations'=>'Cabo Verde and 2 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -2','locations'=>'Pernambuco/Brazil and South Georgia/Sandwich Is.','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -3','locations'=>'most of Brazil, Argentina and 9 more	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -3:30','locations'=>'Newfoundland and Labrador/Canada	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -4','locations'=>'some regions of Canada and 29 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -5','locations'=>'regions of USA and 14 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -6','locations'=>'regions of USA and 9 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -7','locations'=>'some regions of USA and 2 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -8','locations'=>'regions of USA and 4 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -9','locations'=>'Alaska/USA and regions of French Polynesia','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -9:30','locations'=>'Marquesas Islands/French Polynesia	','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -10','locations'=>'small region of USA and 2 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -11','locations'=>'American Samoa and 2 more','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['utc_offset'=>'UTC -12','locations'=>'much of US Minor Outlying Islands','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ]);
    }
}
