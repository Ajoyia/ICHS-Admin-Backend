<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChapterEndorsement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'chapter_endorsements';
    protected $fillable = [
        'user_id',
        'chapter_id',
        'is_email_sent',
        'email_sent_date',
        'is_endorsed',
        'endorsed_date',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function chapter(){
        return $this->belongsTo(Chapter::class,'chapter_id');
    }
}
