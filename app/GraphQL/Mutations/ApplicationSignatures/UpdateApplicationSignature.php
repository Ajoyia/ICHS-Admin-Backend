<?php

namespace App\GraphQL\Mutations\ApplicationSignatures;
use App\Models\ApplicationSignature;
use Illuminate\Support\Facades\Storage;

final class UpdateApplicationSignature
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['image'];
        
        $template = ApplicationSignature::find($args['id']);
        $template->referance_id = $args['reference'];
        $template->label = $args['label'];
        if($file!=null){
            $template->name =  Storage::put('/file_manager/images',$args['image']);
            $template->file_type = $file->getClientOriginalExtension(); 
            
        }
        $template->save();
    }
}
