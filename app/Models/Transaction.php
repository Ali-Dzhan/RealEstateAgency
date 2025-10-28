<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id','amount','payment_method','status','reference','paid_at'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
