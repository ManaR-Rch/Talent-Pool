<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnonceRequest;
use App\Services\AnnonceService;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    protected $annonceService;

    public function __construct(AnnonceService $annonceService)
    {
        $this->annonceService = $annonceService;
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $annonces = $this->annonceService->getAllAnnonces($search);
        
        return response()->json([
            'success' => true,
            'data' => $annonces
        ]);
    }

    public function show($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        return response()->json([
            'success' => true,
            'data' => $annonce
        ]);
    }

    public function store(AnnonceRequest $request)
    {
        $this->authorize('create', \App\Models\Annonce::class);
        
        $annonce = $this->annonceService->createAnnonce($request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Annonce créée avec succès',
            'data' => $annonce
        ], 201);
    }

    public function update(AnnonceRequest $request, $id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('update', $annonce);
        
        $updatedAnnonce = $this->annonceService->updateAnnonce($id, $request->validated());
        
        return response()->json([
            'success' => true,
            'message' => 'Annonce mise à jour avec succès',
            'data' => $updatedAnnonce
        ]);
    }

    public function destroy($id)
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        $this->authorize('delete', $annonce);
        
        $this->annonceService->deleteAnnonce($id);
        
        return response()->json([
            'success' => true,
            'message' => 'Annonce supprimée avec succès'
        ]);
    }
}