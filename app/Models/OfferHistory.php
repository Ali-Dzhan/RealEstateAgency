<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferHistory extends Model
{
    protected $fillable = [
        'offer_id', 'user_id', 'field_changed', 'old_value', 'new_value'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
