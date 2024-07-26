<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Указываем имя таблицы, если оно отличается от имени модели в множественном числе

    protected $fillable = [
        'name',
        'description',
    ];

    // Определяем связи
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}

