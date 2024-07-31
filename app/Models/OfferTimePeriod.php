<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferTimePeriod extends Model
{
    use HasFactory;

    protected $fillable = ['offer_id', 'start_date', 'end_date', 'start_time', 'end_time'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
