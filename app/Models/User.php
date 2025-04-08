<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'bio',
        'entreprise',
        'poste',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function isRecruteur()
    {
        return $this->role === 'recruteur';
    }

    public function isCandidat()
    {
        return $this->role === 'candidat';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}