<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'legal_address',
        'contact_person_name',
        'contact_person_phone',
        'tender_id',
    ];

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}
