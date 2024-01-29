<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthInnovationInitiativeType extends Model
{
    use HasFactory, SoftDeletes;

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

    public function HealthInnovationInitiatives()
    {
        return $this->belongsToMany(HealthInnovationInitiative::class, 'hii_types', 'hii_type_id', 'hii_id');
    }
}
