<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Services\AnnonceService;
use App\Services\CandidatureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    protected $annonceService;
    protected $candidatureService;

    public function __construct(AnnonceService $annonceService, CandidatureService $candidatureService)
    {
        $this->annonceService = $annonceService;
        $this->candidatureService = $candidatureService;
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $annonces = $this->annonceService->getAllAnnonces($search);
        
        return view('annonces.index', compact('annonces', 'search'));
    }

    public function show($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        $hasCandidature = false;
        
        if (Auth::check() && Auth::user()->isCandidat()) {
            $hasCandidature = $this->candidatureService->hasCandidatureForAnnonce($id);
        }
        
        return view('annonces.show', compact('annonce', 'hasCandidature'));
    }

    public function create()
    {
        $this->authorize('create', \App\Models\Annonce::class);
        
        return view('annonces.create');
    }

    public function store(AnnonceRequest $request)
    {
        $this->authorize('create', \App\Models\Annonce::class);
        
        $annonce = $this->annonceService->createAnnonce($request->validated());
        
        return redirect()->route('annonces.show', $annonce->id)
            ->with('success', 'Annonce créée avec succès.');
    }

    public function edit($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('update', $annonce);
        
        return view('annonces.edit', compact('annonce'));
    }

    public function update(AnnonceRequest $request, $id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('update', $annonce);
        
        $this->annonceService->updateAnnonce($id, $request->validated());
        
        return redirect()->route('annonces.show', $id)
            ->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('delete', $annonce);
        
        $this->annonceService->deleteAnnonce($id);
        
        return redirect()->route('annonces.index')
            ->with('success', 'Annonce supprimée avec succès.');
    }

    public function toggleStatus($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('update', $annonce);
        
        $this->annonceService->toggleAnnonceStatus($id);
        
        return redirect()->back()
            ->with('success', 'Statut de l\'annonce mis à jour avec succès.');
    }

    public function candidatures($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('viewCandidatures', $annonce);
        
        $candidatures = $this->candidatureService->getCandidaturesByAnnonce($id);
        
        return view('annonces.candidatures', compact('annonce', 'candidatures'));
    }
}