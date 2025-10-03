<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'author_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
