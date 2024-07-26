<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'photo',
        'registration_date',
        'phone',
        'email',
        'address',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
    ];
}
