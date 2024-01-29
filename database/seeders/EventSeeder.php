<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
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
                'title'=>"AEEDC Dubai Conference 2023",
                'image' => "file_manager/images/32UOQvkCrqrhwVAdwS3tifzGi7GzBU7VYtoP77H1.png",
                'date' => "7-9 Feb 2023",
                'link' => "https://aeedc.com/aeedc-conference/",
                'location' => 'Dubai, UAE',
                'cme_points' => '19 ICHS CME Credit',
                'recent_flag' => 0,
                'upcoming_flag' => 1,
                'order' => 1,
            ],
            [
                'title'=>"AEEDC Dubai World Orthodontic Conference 2023",
                'image' => "file_manager/images/nFofZL9AmnCAXmsWC56vcru9rB0AQWwWvywSWXE8.png",
                'date' => "6-7 Feb 2023",
                'link' => "https://aeedc.com/aeedc-dubai-world-orthodontic-conference/",
                'location' => 'Dubai, UAE',
                'cme_points' => '16 ICHS CME Credits',
                'recent_flag' => 0,
                'upcoming_flag' => 1,
                'order' => 2,
            ],
            [
                'title'=>"AEEDC Advanced Specialties Courses",
                'image' => "file_manager/images/tr024IycBLowYdyjBehbf6vd5LtrIxYPEnQ1dvni.png",
                'date' => "7-9 Feb 2023",
                'link' => "https://aeedc.com/advanced-speciality-courses/",
                'location' => 'Dubai, UAE',
                'cme_points' => 'Between 4-7 ICHS CPD Credits for Each Course',
                'recent_flag' => 0,
                'upcoming_flag' => 1,
                'order' => 3,
            ],
            [
                'title'=>"Dubai World Dental Meeting",
                'image' => "file_manager/images/leja8BWj294SpNfxEx3Th7eXCDCXTRtoQYSK25ph.png",
                'date' => "4-6 Feb 2023",
                'link' => "https://aeedc.com/dubai-world-dental-meeting/",
                'location' => 'Dubai, UAE',
                'cme_points' => '7 ICHS CPD Credits for Each Course',
                'recent_flag' => 0,
                'upcoming_flag' => 1,
                'order' => 4,
            ],
            [
                'title'=>"AEEDC DUBAI World Oral & Maxillofacial Surgery Conference 2023",
                'image' => "file_manager/images/37w0LwxI7k4JmMJplek1gKAfq98BPNCdxA650X6r.png",
                'date' => "8-9 Feb 2023",
                'link' => "https://aeedc.com/aeedc-dubai-world-oral-maxillofacial-surgery-conference-2023/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 0,
                'upcoming_flag' => 1,
                'order' => 5,
            ],
            //Recent
            [
                'title'=>"GNYDM",
                'image' => "file_manager/images/ob9aSP2SrpK8JcHkjinESg7upjfoNKcOQp5YOi2q.png",
                'date' => "8-9 Feb 2023",
                'link' => "https://www.gnydm.com/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 1,
            ],
            [
                'title'=>"ICHS",
                'image' => "file_manager/images/gAI9Ny00gWQ0JMQsznnZMg4rLtU6Rds515RUek2v.jpg",
                'date' => "8-9 Feb 2023",
                'link' => "https://ichs.uk/events/igphs",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 2,
            ],
            [
                'title'=>"DUPHAT",
                'image' => "file_manager/images/Z529xUysHacf8pBKWLMsXwBPtVMVia4b7u7cuEaw.jpg",
                'date' => "8-9 Feb 2023",
                'link' => "https://duphat.ae/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 3,
            ],
            [
                'title'=>"IFED20222",
                'image' => "file_manager/images/KxyMQkm6vfhKS7aLm6tsaWtqr1TJWq07XaYXk2k1.png",
                'date' => "8-9 Feb 2023",
                'link' => "https://ifed2022.com/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 4,
            ],
            [
                'title'=>"IFM",
                'image' => "file_manager/images/JDIwL6eQimFRzkpq8nfh0gRQvs3bwQ80e0Ef7hbQ.jpg",
                'date' => "8-9 Feb 2023",
                'link' => "https://ifm.ae/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 5,
            ],
            [
                'title'=>"Makkah Dental",
                'image' => "file_manager/images/vnt8TH7UqtthadDxA5vZA42c3pBSf2m8cV4Ala6I.png",
                'date' => "8-9 Feb 2023",
                'link' => "https://makkahdental.com/",
                'location' => 'Dubai, UAE',
                'cme_points' => '13.5 ICHS CME Credits',
                'recent_flag' => 1,
                'upcoming_flag' => 0,
                'order' => 6,
            ],
        ];
        Schema::disableForeignKeyConstraints();
        DB::table('events')->truncate();
        DB::table('events')->insert($data);
        // ... Some Truncate Query

        Schema::enableForeignKeyConstraints();
    }
}
