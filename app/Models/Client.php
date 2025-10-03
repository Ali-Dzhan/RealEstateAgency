<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
