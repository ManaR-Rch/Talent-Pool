<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

 

    protected $casts = [
        'date_limite' => 'date',
        'active' => 'boolean',
        'salaire_min' => 'decimal:2',
        'salaire_max' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('titre', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('lieu', 'like', "%{$search}%")
                ->orWhere('competences_requises', 'like', "%{$search}%");
        }
        return $query;
    }
}