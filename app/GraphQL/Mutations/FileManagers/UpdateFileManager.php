<?php

namespace App\GraphQL\Mutations\FileManagers;
use App\Models\FileManager;
use Illuminate\Support\Facades\Storage;

final class UpdateFileManager
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['image'];
        
        $template = FileManager::find($args['id']);
        $template->referance_id = $args['reference'];
        $template->label = $args['label'];
        if($file!=null){
            $template->name =  Storage::putFile('/file_manager/images',$args['image']);
            $template->file_type = $file->getClientOriginalExtension(); 
            
        }
        $template->save();
    }
}
