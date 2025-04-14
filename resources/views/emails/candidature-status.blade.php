<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre candidature</title>
</head>
<body>
    <h1>Mise à jour de votre candidature</h1>
    
    <p>Bonjour {{ $candidature->user->name }},</p>
    
    <p>Le statut de votre candidature pour le poste "{{ $candidature->annonce->titre }}" a été mis à jour.</p>
    
    <p><strong>Nouveau statut :</strong> 
    @switch($candidature->statut)
        @case('en_attente')
            En attente
            @break
        @case('en_cours')
            En cours d'évaluation
            @break
        @case('acceptee')
            Acceptée
            @break
        @case('refusee')
            Refusée
            @break
    @endswitch
    </p>
    
    <p>Vous pouvez consulter les détails de votre candidature en vous connectant à votre espace personnel.</p>
    
    <p>Cordialement,<br>
    L'équipe TalentPool</p>
</body>
</html>