<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'agent_id',
        'client_id',
        'signed_on',
        'price',
    ];

    public function property() { return $this->belongsTo(Property::class); }
    public function agent() { return $this->belongsTo(Agent::class); }
    public function client() { return $this->belongsTo(Client::class); }
}
