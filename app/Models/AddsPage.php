<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'header_additions',
        'body_additions',
        'script_additions',
        'enabled',
    ];
}

