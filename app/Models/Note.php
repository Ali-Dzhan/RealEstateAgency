<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'author_id', 'text'];

    public function property() { return $this->belongsTo(Property::class); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
}
