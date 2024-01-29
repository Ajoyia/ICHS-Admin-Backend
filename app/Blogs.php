<?php
namespace App;
use Illuminate\Support\Facades\Log;

class Blogs {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        Log::info($whereConditions);

        // $builder->join('speaker_roles','cme_session_speakers.role_id','=','speaker_roles.id')
        //     ->join('cme_speakers','cme_session_speakers.cme_speakers_id','=','cme_speakers.id')
        //     ->where('speaker_roles.name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('cme_speakers.first_name','like',$whereConditions['OR'][0]['value']);
            // ->orWhere('countries_type.name','like',$whereConditions['OR'][0]['value']);

        // $builder
        //         // ->rightJoin('taggables', "taggables.taggable_id", "=", "blogs.id")
        //         // ->rightJoin('tags', 'taggables.tag_id', "=", "tags.id")
        //         ->select(
        //             'blogs.id as id',
        //             'blogs.user_id as user_id',
        //             'blogs.tag_id as tag_id',
        //             'blogs.title as title',
        //             'blogs.description as description',
        //             'blogs.body as body',
        //             'blogs.feature as feature',
        //             'blogs.image as image',
        //             // 'tags.id as tags_id',
        //             // 'tags.title as tags_title',
        //             // 'tags.created_at as tags_created_at',
        //             // 'tags.updated_at as tags_updated_at',
        //             )
        //         ->where('blogs.title','like','%'.$whereConditions['OR'][0]['value'].'%')
        //         // ->orWhere('tags.title','like','%'.$whereConditions['OR'][0]['value'].'%')
        //         ->groupBy('blogs.id');

            // $builder->join('taggables', function($q) {
            //     $q->on('taggables.tag_id', '=', 'inventories.id');
            //     $q->where('media.model_type', '=', 'App\Models\Inventory');
            //     $q->orderBy('media.order_column', 'asc');
            //     $q->groupBy('model.model_id');
            // });
    }
}
