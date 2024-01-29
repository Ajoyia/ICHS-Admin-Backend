<?php

namespace App\Models;

use App\Models\User;
use App\Classes\LogsModules;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LoggerActivity extends Model
{
    public $timestamps = false;

    protected $appends = ["reference_url"];

    protected $fillable = ["instance_type", "instance_method", "reference_type", "reference_id", "log", "created_by", "created_at", "event_id", "edition_id", "source_type", "mocked_by"];

    public function user()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    // public function edition()
    // {
    // 	return $this->belongsTo(\App\Models\Edition::class, "edition_id");
    // }

    // Check by the reference type to get the URL of the view page
    // public function getReferenceUrlAttribute() {
    //     $link = LogsModules::fetch_type($this->instance_type, $this->reference_id, $this->event_id, $this->edition_id);
    //     return $link;
    // }

    public function mocked()
    {
        return $this->belongsTo(User::class, "mocked_by");
    }
    public function reference(){
        return $this->morphTo();
    }
    public function time(){
        $c= new Carbon($this->created_at);
        return $c->diffForHumans();
    }
}
