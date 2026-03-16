<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'description',
        'image',
        'github_url',
        'live_url',
        'technologies',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
