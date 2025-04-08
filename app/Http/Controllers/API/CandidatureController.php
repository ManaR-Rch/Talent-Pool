<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidatureRequest;
use App\Services\CandidatureService;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    protected $candidatureService;

    public function __construct(CandidatureService $candidatureService)
    {
        $this->candidatureService = $candidatureService;
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $candidatures = $this->candidatureService->getCandidaturesByUser();
        
        return response()->json([
            'success' => true,
            'data' => $candidatures
        ]);
    }

    public function show($id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('view', $candidature);
        
        return response()->json([
            'success' => true,
            'data' => $candidature
        ]);
    }

    public function store(CandidatureRequest $request)
    {
        $this->authorize('create', \App\Models\Candidature::class);
        
        $annonceId = $request->input('annonce_id');
        
        // Vérifier si l'utilisateur a déjà postulé
        if ($this->candidatureService->hasCandidatureForAnnonce($annonceId)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà postulé à cette annonce'
            ], 422);
        }
        
        $candidature = $this->candidatureService->createCandidature(
            $request->validated(),
            $request->file('cv'),
            $request->hasFile('lettre') ? $request->file('lettre') : null
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Candidature envoyée avec succès',
            'data' => $candidature
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('updateStatus', $candidature);
        
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,acceptee,refusee',
        ]);
        
        $updatedCandidature = $this->candidatureService->updateCandidatureStatus($id, $request->statut);
        
        return response()->json([
            'success' => true,
            'message' => 'Statut de la candidature mis à jour avec succès',
            'data' => $updatedCandidature
        ]);
    }

    public function destroy($id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('delete', $candidature);
        
        $this->candidatureService->deleteCandidature($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Candidature retirée avec succès'
        ]);
    }
}