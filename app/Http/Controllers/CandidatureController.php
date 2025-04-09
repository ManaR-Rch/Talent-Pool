<?php



use App\Http\Requests\CandidatureRequest;
use App\Services\AnnonceService;
use App\Services\CandidatureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    protected $candidatureService;
    protected $annonceService;

    public function __construct(CandidatureService $candidatureService, AnnonceService $annonceService)
    {
        $this->candidatureService = $candidatureService;
        $this->annonceService = $annonceService;
        $this->middleware('auth');
    }

    public function index()
    {
        $candidatures = $this->candidatureService->getCandidaturesByUser();
        
        return view('candidatures.index', compact('candidatures'));
    }

    public function show($id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('view', $candidature);
        
        return view('candidatures.show', compact('candidature'));
    }

    public function create($annonceId)
    {
        $this->authorize('create', \App\Models\Candidature::class);
        
        $annonce = $this->annonceService->getAnnonceById($annonceId);
        
        // Vérifier si l'utilisateur a déjà postulé
        if ($this->candidatureService->hasCandidatureForAnnonce($annonceId)) {
            return redirect()->route('annonces.show', $annonceId)
                ->with('error', 'Vous avez déjà postulé à cette annonce.');
        }
        
        return view('candidatures.create', compact('annonce'));
    }

    public function store(CandidatureRequest $request, $annonceId)
    {
        $this->authorize('create', \App\Models\Candidature::class);
        
        // Vérifier si l'utilisateur a déjà postulé
        if ($this->candidatureService->hasCandidatureForAnnonce($annonceId)) {
            return redirect()->route('annonces.show', $annonceId)
                ->with('error', 'Vous avez déjà postulé à cette annonce.');
        }
        
        $data = $request->validated();
        $data['annonce_id'] = $annonceId;
        
        $candidature = $this->candidatureService->createCandidature(
            $data,
            $request->file('cv'),
            $request->hasFile('lettre') ? $request->file('lettre') : null
        );
        
        return redirect()->route('candidatures.show', $candidature->id)
            ->with('success', 'Candidature envoyée avec succès.');
    }

    public function destroy($id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('delete', $candidature);
        
        $this->candidatureService->deleteCandidature($id);
        
        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature retirée avec succès.');
    }

    public function updateStatus(Request $request, $id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('updateStatus', $candidature);
        
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,acceptee,refusee',
        ]);
        
        $this->candidatureService->updateCandidatureStatus($id, $request->statut);
        
        return redirect()->back()
            ->with('success', 'Statut de la candidature mis à jour avec succès.');
    }

    public function updateNotes(Request $request, $id)
    {
        $candidature = $this->candidatureService->getCandidatureById($id);
        
        $this->authorize('updateStatus', $candidature);
        
        $request->validate([
            'notes_recruteur' => 'nullable|string',
        ]);
        
        $this->candidatureService->updateCandidatureNotes($id, $request->notes_recruteur);
        
        return redirect()->back()
            ->with('success', 'Notes mises à jour avec succès.');
    }
}