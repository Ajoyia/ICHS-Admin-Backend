<?php

namespace App\Exports;

use App\Models\CMELearner;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class LearnersExport implements FromCollection, WithHeadings
{
     
    private $completed_form_id;

    public function __construct($completed_form_id)
    {
        $this->completed_form_id = $completed_form_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return CMELearner::where('completion_form_id',$this->completed_form_id)->get();
       
        return CMELearner::where('completion_form_id',$this->completed_form_id)->select('first_name','last_name','degree','credit_hours_awarded','unique_reference_id')->get();

        
        // return CMELearner::all();
    }
    public function headings(): array
    {
        return ["First Name", "Last Name", "Degree", "Credit Hours Awarded", "Unique Reference Id"];
    }
    
}