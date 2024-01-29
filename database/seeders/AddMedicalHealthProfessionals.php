<?php

namespace Database\Seeders;

use App\Models\MedicalHealthProfessional;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class AddMedicalHealthProfessionals extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delimiter = ',';
        $file = base_path('data/medical_health_professionals.csv');
        $header = null;
        $data = array();
        if (($handle = fopen($file, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                {
                    $data[] = array_combine($header, $row);
                    if($row[1]==''){
                        MedicalHealthProfessional::create([
                            'name' => $row[0],
                            'parent_id' =>  null,
                        ]);
                    }
                    else{
                        MedicalHealthProfessional::create([
                            'name' => $row[0],
                            'parent_id' =>  $row[1]
                        ]);
                    }
                    
                }
            }
            fclose($handle);
           
        }
        
    }
}
