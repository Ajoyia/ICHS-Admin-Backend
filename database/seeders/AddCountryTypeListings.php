<?php

namespace Database\Seeders;

use App\Models\CountriesTypesListing;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AddCountryTypeListings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delimiter = ',';
        $file = base_path('data/countries_type_listings.csv');
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
                    $country_exists = Country::where('name',$row[0])->first();
                    if($country_exists === null){
                            Log::info($row[0]);
                    }else{
                        CountriesTypesListing::create([
                            'country_id' => $country_exists->id,
                            'country_type_id' =>  $row[1]
                        ]);
                    }
                        
                    
                    
                }
            }
            fclose($handle);
           
        }
        
    }
}
