<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StatistiqueService;
use Illuminate\Support\Facades\Gate;

class StatistiqueController extends Controller
{
    protected $statistiqueService;

    public function __construct(StatistiqueService $statistiqueService)
    {
        $this->statistiqueService = $statistiqueService;
        $this->middleware('auth:sanctum');
    }

    public function recruteur()
    {
        if (!Gate::allows('access-recruteur')) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 403);
        }
        
        $stats = $this->statistiqueService->getRecruteurStats();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    public function global()
    {
        if (!Gate::allows('access-admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 403);
        }
        
        $stats = $this->statistiqueService->getGlobalStats();
        
        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}