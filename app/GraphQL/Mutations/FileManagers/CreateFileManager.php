<?php

namespace App\GraphQL\Mutations\FileManagers;
use App\Models\FileManager;
use Illuminate\Support\Facades\Storage;

final class CreateFileManager
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file_type = $args['file']->getClientOriginalExtension();   
        $template = FileManager::create([
            'name' => Storage::putFile('/file_manager/images',$args['file']),
            'referance_id' => $args['reference'],
            'file_type' => $file_type,
            'label' => $args['label'],
        ]);
        return $template;
    }
}
