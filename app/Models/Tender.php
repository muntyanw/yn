<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_date',
        'submission_deadline',
        'delivery_date_range_start',
        'delivery_date_range_end',
        'product_service_name',
        'quantity',
        'delivery_address',
    ];

    protected $casts = [
        'publication_date' => 'datetime',
        'submission_deadline' => 'datetime',
        'delivery_date_range_start' => 'datetime',
        'delivery_date_range_end' => 'datetime',
    ];

    public function proposals()
    {
        return $this->hasMany(TenderProposal::class);
    }
}
