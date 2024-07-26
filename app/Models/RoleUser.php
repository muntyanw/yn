<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user'; // Указываем имя таблицы, если оно отличается от имени модели в множественном числе

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    // Определяем связи
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
