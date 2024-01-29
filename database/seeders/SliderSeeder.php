<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title'=>"International Congress for Health Specialties (ICHS)",
                'description' => "established in London, UK is dedicated to advancing continuing medical education, continuing professional development, research, innovation and excellence in healthcare for the benefit of humanity.",
                'link' => "./about",
                'image' => "file_manager/images/i6NGAvAXIutfxGV6llkloJNNu23Fxl238xwEfAxG.jpg",
                'content' => '<a href="/about" class="btn btn-outline-light text-white">Join ICHS Membership</a> ',
            ],
            [
                'title'=>"Receive International Accreditation",
                'description' => "ICHS CME/CPD and International Conference accreditation and recognition is a guarantee of excellence and high quality in medical and health education.",
                'link' => "./pages/cme-cpd-program",
                'image' => "file_manager/images/iAurrfeNY8A65u2R4tdnHomjU3rbyFOCgiGcHQl4.jpg",
                'content' => '<a href="/pages/cme-cpd-program" class="mr-2 btn btn-outline-light text-white">CME/CPD Activity Accreditation</a><a href="/pages/international-conference-accreditation" class="btn ml-2  btn-outline-light text-white">International Conference Accreditation</a>',
            ],
            [
                'title'=>"ICHS Membership",
                'description' => "ICHS membership offers a wide range of benefits with unlimited access to various educational materials.",
                'link' => "./membership",
                'image' => "file_manager/images/QaPQw8fRcw3E8MXIpQ8d3swUs64j3WAgnnhCE153.jpg",
                'content' => '<a href="/membership" class="btn btn-outline-light text-white">Join ICHS Membership</a> ',
            ]
        ];
        Schema::disableForeignKeyConstraints();
        DB::table('sliders')->truncate();
        DB::table('sliders')->insert($data);
        // ... Some Truncate Query

        Schema::enableForeignKeyConstraints();
    }
}
