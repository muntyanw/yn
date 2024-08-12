<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'comment'];

    public function files()
    {
        return $this->hasMany(FinancialReportFile::class);
    }
}