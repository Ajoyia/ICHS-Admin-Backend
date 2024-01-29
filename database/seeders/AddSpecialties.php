<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class AddSpecialties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delimiter = ',';
        $file = base_path('data/specialties.csv');
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
                        Specialty::create([
                            'name' => $row[0],
                            'parent_id' =>  null,
                        ]);
                    }
                    else{
                        Specialty::create([
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
