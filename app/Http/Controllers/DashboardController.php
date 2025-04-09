<?php

namespace App\Http\Controllers;

use App\Services\AnnonceService;
use App\Services\CandidatureService;
use App\Services\StatistiqueService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $annonceService;
    protected $candidatureService;
    protected $statistiqueService;

    public function __construct(
        
    ) {
        $this->annonceService = $annonceService;
        $this->candidatureService = $candidatureService;
        $this->statistiqueService = $statistiqueService;
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isRecruteur()) {
            return $this->recruteurDashboard();
        } else {
            return $this->candidatDashboard();
        }
    }

    protected function adminDashboard()
    {
        $stats = $this->statistiqueService->getGlobalStats();
        
        return view('dashboard.admin', compact('stats'));
    }

    protected function recruteurDashboard()
    {
        $stats = $this->statistiqueService->getRecruteurStats();
        $annonces = $this->annonceService->getAnnoncesByUser();
        
        return view('dashboard.recruteur', compact('stats', 'annonces'));
    }

    protected function candidatDashboard()
    {
        $candidatures = $this->candidatureService->getCandidaturesByUser();
        $totalCandidatures = $this->candidatureService->countCandidaturesByUser();
        
        return view('dashboard.candidat', compact('candidatures', 'totalCandidatures'));
    }
}