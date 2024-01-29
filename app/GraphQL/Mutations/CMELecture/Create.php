<?php

namespace App\GraphQL\Mutations\CMELecture;

use App\Models\CMELecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_lecture = new CMELecture();
        if(isset($args['name'])){
            $cme_lecture->name = $args['name'];
        }
        if(isset($args['heading'])){
            $cme_lecture->heading = $args['heading'];
        }
        if(isset($args['featured'])){
            $cme_lecture->featured = $args['featured'];
        }
        if(isset($args['description'])){
            $cme_lecture->description = $args['description'];
        }
        if(isset($args['special_accommodations'])){
            $cme_lecture->special_accommodations = $args['special_accommodations'];
        }
        if(isset($args['learning_objectives'])){
            $cme_lecture->learning_objectives = $args['learning_objectives'];
        }
        if(isset($args['break_time'])){
            $cme_lecture->break_time = $args['break_time'];
        }
        if(isset($args['audio_visual_type'])){
            $cme_lecture->audio_visual_type = $args['audio_visual_type'];
        }
        if(isset($args['audio_visual_other'])){
            $cme_lecture->audio_visual_other = $args['audio_visual_other'];
        }
        if(isset($args['interactive_technology_other'])){
            $cme_lecture->interactive_technology_other = $args['interactive_technology_other'];
            
        }
        if(isset($args['presentation_format_id'])){
            $cme_lecture->presentation_format_id = $args['presentation_format_id'];
            
        }
        if(isset($args['presentation_format_other'])){
            
            $cme_lecture->presentation_format_other = $args['presentation_format_other'];
        }
        if(isset($args['starttime'])){
            
            $cme_lecture->starttime = $args['starttime'];
        }
        if(isset($args['endtime'])){
            
            $cme_lecture->endtime = $args['endtime'];
        }
        if(isset($args['break'])){
            
            $cme_lecture->break = $args['break'];
        }
        if(isset($args['order'])){
            
            $cme_lecture->order = $args['order'];
        }
        if(isset($args['session_location_id'])){
            
            $cme_lecture->session_location_id  = $args['session_location_id'];
        }
        if(isset($args['status'])){
            
            $cme_lecture->status = $args['status'];
        }
        if(isset($args['cme_session_id'])){
            
            $cme_lecture->cme_session_id = $args['cme_session_id'];
        }
        if(isset($args['cme_application_id'])){
            
            $cme_lecture->cme_application_id = $args['cme_application_id'];
        }
        if(isset($args['file'])){
            $file = $args['file'];
            if($file!=null){
                $cme_lecture->file =  Storage::putFile('/CMELectures/file',$args['file']);
            }
        }
        
        $cme_lecture->created_by = Auth::id();
        $cme_lecture->updated_by = Auth::id();
        
        $cme_lecture->save();
        // \Log::info($args['audio_visual_id']);
        // \Log::info($args['interactive_technology_id']);
        // die();
        if(isset($args['audio_visual_id'])){
            foreach($args['audio_visual_id'] as $audioVisuals){
                \DB::table('lecture_audio_visuals')->insert(
                    ['lecture_audio_visuals_id'=>$audioVisuals, 'lecture_id'=>$cme_lecture->id]
                );
            }
        }
        if(isset($args['interactive_technology_id'])){
            foreach($args['interactive_technology_id'] as $interactiveTechnology){
                \DB::table('lecture_interactive_technologies')->insert(
                    ['lit_id'=>$interactiveTechnology, 'lecture_id'=>$cme_lecture->id]
                );
            }
        }
        return $cme_lecture;
    }
}
