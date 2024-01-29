<?php

namespace App\GraphQL\Mutations\FileManagers;
use App\Models\FileManager;
use Illuminate\Support\Facades\Storage;

final class DeleteFileManager
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $template = FileManager::find($args['id']);
        
        $template->delete();
    }
}
