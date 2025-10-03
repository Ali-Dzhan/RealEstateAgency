<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
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
