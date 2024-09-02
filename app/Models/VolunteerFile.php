<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerFile extends Model
{
    use HasFactory;

    protected $fillable = ['volunteer_id', 'file_path', 'file_name'];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
