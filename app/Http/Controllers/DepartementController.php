<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartementRequest;
use App\Models\Departement;
use Exception;
use PHPUnit\Framework\Attributes\Depends;

class DepartementController extends Controller
{
    // Affiche la liste des départements
    public function index()
    {
        try {
            $departements = Departement::paginate(10);

            return view('backend.pages.departements.index', compact('departements'));
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error_message', 'Erreur lors du chargement des départements : ' . $e->getMessage());
        }
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('backend.pages.departements.create');
    }

    // Enregistre un nouveau département
    public function store(CreateDepartementRequest $request)
    {
        try {

            Departement::create($request->validated());

            return redirect()
                ->route('departements.index')
                ->with('success_message', "Le département a été créé avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error_message', "Erreur lors de la création : " . $e->getMessage());
        }
    }

    // // Affiche un département spécifique
    // public function show(Departement $departement)
    // {
    //     return view('backend.pages.departements.show', compact('departement'));
    // }

    // edit
    public function edit($id)
    {

        $departement = Departement::find($id);

        return view('backend.pages.departements.edit', compact('departement'));
    }

    // Met à jour un département
    public function update(CreateDepartementRequest $request, Departement $departement)
    {

        try {
            $departement->update($request->validated());
            return redirect()
            ->route('departements.index')
            ->with('success_message', "Le département a été modifié avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error_message', "Erreur lors de la mise à jour : " . $e->getMessage());
        }
    }

    // // Supprime un département
    public function delete($id)
    {
        try {
            $departement = Departement::find($id);
            $departement->delete();

            return response()->json(['status' => 200]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => "Erreur lors de la suppression : " . $e->getMessage()
            ]);
        }
    }
}
