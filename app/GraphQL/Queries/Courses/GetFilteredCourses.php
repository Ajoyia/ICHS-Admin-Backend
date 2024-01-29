<?php

namespace App\GraphQL\Queries\Courses;

use App\Models\Rating;
use App\Models\IvlnCourse;
use App\Models\IvlnFavorite;
use App\Models\IvlnLecturesType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class getFilteredCourses
{
    public function __invoke($_, array $args)
    {
        $ivlnCourse=ivlnCourse::where('status',1)->whereHas('lectures')->withAvg('courseRating','rating');
        if(!Auth::user()||!(isset(Auth::user()->memberships->status)&&Auth::user()->memberships->status==1)){

            $ivlnCourse->where('paid',0);
        }
        if(isset($args['rating'])){
            $rating=$args['rating'];
            $ratings=[];
            $token = strtok($rating, '-');
            while ($token !== false) {
                array_push($ratings,$token);
                $token = strtok('-');
            }
            if($ratings[0]=='3.0')
                $ivlnCourse->having('course_rating_avg_rating','<=',3)
                    ->orWhereNotExists('course_rating_avg_rating');
            else
                $ivlnCourse->having('course_rating_avg_rating','<=',$ratings[0])
                    ->having('course_rating_avg_rating','>=',$ratings[1]);

        }
        if(isset($args['industries'])){
            $industriesIds=[];
            foreach($args['industries'] as $industry){
                array_push($industriesIds,$industry->id);
            }
            if(count($industriesIds)>0)
                $ivlnCourse->whereHas('specialities',function($query) use($industriesIds){
                        $query->whereIn('specialties.id',$industriesIds);
                    });
            // return $ivlnCourse->get();
        }
        if(isset($args['tags'])){
            $tagIds=[];
            foreach($args['tags'] as $tag){
                array_push($tagIds,$tag->id);
            }
            if(count($tagIds)>0)
                $ivlnCourse
                    ->whereHas('ivlnTags',function($query) use($tagIds){
                        $query->whereIn('ivln_tags.id',$tagIds);
                    });
            // return $ivlnCourse->get();
        }

        if(!((isset($args['paid'])&&isset($args['free']))&&$args['paid']&&$args['free'])){
            if(isset($args['paid'])){
                if($args['paid'])
                    if(Auth::user()&&isset(Auth::user()->memberships->status)&&Auth::user()->memberships->status==1){
                        $ivlnCourse->where('paid',1);
                    }
            }

            if(isset($args['free'])){
                if($args['free'])
                    $ivlnCourse->where('paid',0);
            }
        }
        if(isset($args['featured'])){
           if($args['featured']||$args['featured']==0)
                $ivlnCourse->where('featured','=',$args['featured']);
            // return $ivlnCourse->get();
        }
        $lectureFilters=0;
        if(isset($args['length'])&&!is_null($args['length'])){
            $lectureFilters=1;
            $length=$args['length'];
            $lengths=[];
            if(strpos($args['length'],'-')){
                $token = strtok($length, '-');
                while ($token !== false) {
                    $token*=60;
                    array_push($lengths,$token);
                    $token = strtok('-');
                }
                $ivlnCourse->whereHas('lectures',function($query)use($lengths){
                    $query->where('total_minuts','>=',$lengths[0])
                        ->where('total_minuts','<=',$lengths[1]);
                });
            }
            else{
                $ivlnCourse->whereHas('lectures',function($query)use($lengths){
                    $query->where('total_minuts','>=',17);

                });
            }
            // return $ivlnCourse->get();
        }
        if(isset($args['type'])){
            $lectureFilters=1;
            Log::info(count($args['type']));
            if(count($args['type'])>0)
                $ivlnCourse->whereHas('lectures',function($query)use($args){
                    $query->whereIn('lecture_type_id',$args['type']);
                });
            // return $ivlnCourse->get();
        }
        if(isset($args['language'])){
            $lectureFilters=1;
            $languagesIds=[];
            foreach($args['language'] as $language){
                array_push($languagesIds,$language->id);
            }
            if(count($languagesIds)>0)
                $ivlnCourse->whereHas('lectures',function($query)use($languagesIds){
                    $query->whereIn('language_id',$languagesIds);
                });
            // return $ivlnCourse->get();
        }
        if(isset($args['speakers'])){
            $lectureFilters=1;
            $speakersIds=[];
            foreach($args['speakers'] as $speaker){
                array_push($speakersIds,$speaker->id);
            }
            if(count($speakersIds)>0)
                $ivlnCourse->whereHas('lectures',function($query)use($speakersIds){
                    $query->whereHas('speakers',function($query) use($speakersIds){
                        $query->whereIn('ivln_speakers.id',$speakersIds);
                    });
                });
            // return $ivlnCourse->get();
        }
        if(!$lectureFilters){
            $ivlnCourse->whereHas('lectures');
        }
        if(isset($args['sorting'])&&!is_null($args['sorting'])){
            switch($args['sorting']){
                case 'newest':
                    $ivlnCourse->orderBy('id','DESC');
                    // return $ivlnCourse->get();
                    break;
                case 'high_rated':
                    $ivlnCourse=DB::select("SELECT ivln_courses.*,ROUND(avg (ratings.rating),1) as course_rating_avg_rating FROM ivln_courses
                                left join ratings on ivln_courses.id=ratings.model_id and ratings.model_type='App\\\Models\\\IvlnCourse'
                                inner join ivln_lectures on ivln_courses.id=ivln_lectures.course_id
                                where ivln_courses.deleted_at is null
                                group by ivln_courses.id
                                order by course_rating_avg_rating desc
                                limit ".$args['data_count'] );

                    return json_encode($ivlnCourse);
                    break;
                case 'most_reviewed':
                    $ivlnCourse=DB::select("SELECT ivln_courses.*, count(distinct logs.id) as views,ROUND(avg (ratings.rating),1) as course_rating_avg_rating FROM ivln_courses
                                left join ratings on ivln_courses.id=ratings.model_id and ratings.model_type='App\\\Models\\\IvlnCourse'
                                inner join logs on ivln_courses.id=logs.model_id and logs.model_type='App\\\Models\\\IvlnCourse' and logs.deleted_at is null
                                inner join ivln_lectures on ivln_courses.id=ivln_lectures.course_id
                                where ivln_courses.deleted_at is null
                                group by ivln_courses.id
                                order by views desc
                                limit ".$args['data_count'] );

                    return json_encode($ivlnCourse);
                    break;
            }
        }

        $ivlnCourse->with('courseRating')
            ->whereHas('lectures' , function($query) {
                    $query->where('status', 1);
                }
            );
        Log::info($args['data_count']);
        $courses=$ivlnCourse->paginate($args['data_count']);
        Log::info($courses);
        //getting courses which dont have rating
        if(isset($args['rating'])){
            if($ratings[0]=='3.0'){
                $corsesWithoutRating=ivlnCourse::where('status',1)->whereDoesntHave('courseRating')->get();
                $courses=$courses->merge($corsesWithoutRating);
            }
        }
        foreach($courses as $course){
            $ratings=$course->courseRating;
            if(count($ratings)){
                $course->course_rating_avg_rating=round($course->course_rating_avg_rating,2);
            }
            else
                $course->course_rating_avg_rating=1;
            if(isset($course->lectures[0]->speakers[0]->name))
                $course->by=$course->lectures[0]->speakers[0]->name;
            else
                $course->by='------';
        }
        return json_encode($courses);
    }
}
