<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'skills_type',
        'created_at',
        'vacancies',
        'is_active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
