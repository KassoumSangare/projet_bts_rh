<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaireRequest;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Poste;
use App\Models\Salaire;
use Throwable;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function formSalaire()
    {
        return view('backend.pages.salaire.formSalaire', [
            'employes' => Employe::orderBy('nom')->get(),
        ]);
    }





    public function storeSalaire(StoreSalaireRequest $request)
    {
        try {
            // Récupération de l'employé avec ses relations poste et département
            $employes = Employe::with(['poste', 'departement'])->findOrFail($request->employe_id);

            // Création du salaire
            $salaire =  Salaire::create($request->validated());
            $employes->montant = $salaire->montant;
            // Message de succès avec contexte utile
            return view('backend.pages.salaire.AllFicheEmploye', [
                'employes' => collect([$employes]),
            ])->with('success_message', 'Salaire enregistré avec succès');
        } catch (Throwable $e) {
            // Gestion propre de l'erreur, sans lancer une autre exception inutilement
            return back()->with('error', 'Erreur lors de l\'enregistrement du salaire : ' . $e->getMessage());
        }
    }




    public function genererPDF($id)
    {

        // Récupérer le salaire avec les relations employe, poste, departement
        $employe = Employe::with(['poste', 'departement'])->findOrFail($id);


        // Nettoyer le nom de l'employé pour un nom de fichier valide
        $nom = preg_replace('/[^A-Za-z0-9\-]/', '_', $employe->nom);
         $salaire = Salaire::where('employe_id', $employe->id)->latest()->firstOrFail();
         $employe->montant = $salaire->montant;
        $numero = random_int(1000, 9999);

        // Générer le PDF avec la vue ficheSalaire
        $pdf = Pdf::loadView('backend.pages.salaire.ficheSailre', compact('employe','numero'));

        // Retourner le PDF en téléchargement avec un nom dynamique
        return $pdf->download('fiche_de_paie_' . $nom . '.pdf');
    }
}
