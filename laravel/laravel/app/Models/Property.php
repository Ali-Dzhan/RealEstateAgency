<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'region_id',
        'agent_id',
        'address',
        'price',
        'area',
        'rooms',
        'status',
    ];

    public function agent() { return $this->belongsTo(Agent::class); }
    public function region() { return $this->belongsTo(Region::class); }
    public function type() { return $this->belongsTo(PropertyType::class, 'type_id'); }
    public function viewings() { return $this->hasMany(Viewing::class); }
    public function offers() { return $this->hasMany(Offer::class); }
    public function notes() { return $this->hasMany(Note::class); }
    public function photos() { return $this->hasMany(PropertyPhoto::class); }
}
