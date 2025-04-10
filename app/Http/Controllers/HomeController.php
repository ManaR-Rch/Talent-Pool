<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer quelques statistiques pour la page d'accueil
        $stats = [
            'total_annonces' => Annonce::count(),
            'total_candidats' => User::where('role', 'candidat')->count(),
            'total_recruteurs' => User::where('role', 'recruteur')->count(),
        ];
        
        // Récupérer les dernières annonces actives
        $dernieres_annonces = Annonce::where('active', true)
            ->with('user')
            ->latest()
            ->take(3)
            ->get();
        
        return view('home', compact('stats', 'dernieres_annonces'));
    }
}