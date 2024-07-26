<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillVolunteer extends Model
{
    use HasFactory;

    protected $table = 'skill_volunteer'; // Указываем имя таблицы, если оно отличается от имени модели в множественном числе

    protected $fillable = [
        'volunteer_id',
        'skill_id',
    ];

    // Определяем связи
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}

