<?php

namespace App\Models;

use App\Models\JournalType;
use App\Traits\LoggerManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\JournalApplicationContent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JournalApplication extends Model
{
    use HasFactory, SoftDeletes, LoggerManager;

    protected $table='journal_applications';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function hii_authors()
    {
        return $this->morphMany(HIIAuthor::class, 'authorable');
    }
    public function all_authors()
    {
        return $this->morphMany(HIIAuthor::class, 'authorable');
    }


    public function formType()
    {
        return $this->belongsTo(JournalType::class, 'form_type_id', 'id');
    }
    public function journalContent()
    {
        return $this->hasOne(JournalApplicationContent::class, 'journal_application_id', 'id');
    }

    public function getFilePathAttribute($value)
    {
        if($value)
            return Storage::url($value);
        else
            return $value;
    }
    public function remarks()
    {
        return $this->morphMany(Remark::class, 'model')->orderBy('id','desc');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');

    }

    public function transactions()
    {
        return $this->morphMany(TransactionDetail::class, 'model');
    }
    public function logs()
    {
        return $this->morphMany(Log::class, 'model');
    }
}
