<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\CMELearner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CMELearnerImport implements ToModel, WithStartRow,  WithHeadingRow
{
    private $completion_form_id;

    public function __construct($completion_form_id)
    {
        $this->completion_form_id = $completion_form_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row!=null){
            CMELearner::create([
                'completion_form_id' => $this->completion_form_id,
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'degree' =>$row['degree'],
                'credit_hours_awarded' => $row['credit_hours_awarded'],
                'unique_reference_id' => $row['unique_reference_id'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id
            ]);

        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function rules(): array
    {
        return [
            'first_name'  => ['required'],
            'unique_reference_id' => ['required',
                        ]
        ];

    }

}
