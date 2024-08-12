<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReportFile extends Model
{
    use HasFactory;

    protected $fillable = ['financial_report_id', 'file_path'];

    public function report()
    {
        return $this->belongsTo(FinancialReport::class);
    }
}
