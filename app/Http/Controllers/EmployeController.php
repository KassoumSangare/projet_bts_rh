<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeRequest;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Poste;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $employes = Employe::with('departement')->paginate(10);

            return view('backend.pages.employers.index', compact('employes'));
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error_message', "Erreur survenu lors du chargement de la page employé : " . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        $postes = Poste::all();

        return view('backend.pages.employers.create', [
            'postes' => $postes,
            'departements' => $departements
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeRequest $request)
    {

        try {

            Employe::create($request->validated());
           
            return redirect()
                ->route('employes.index')
                ->with('success_message', "L'employé a été enregistré avec succès.");
        } catch (Exception $e) {

            return "Une erreur est survenue lors de l'enregistrément de l'employé: " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employe = Employe::find($id);
        $departements = Departement::all();

        return view('backend.pages.employers.edit', [

            'employe' => $employe,
            'departements' => $departements,
            'postes' => $postes = Poste::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $employe = Employe::find($id);
            $employe->update($request->all());

            return redirect()->route('employes.index')->with('success_message', "Les information de l'employé ont été modifié avec succès");
        } catch (Exception $e) {

            return "Une erreur est survenue lors de la modification de l'employé: " . $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    // Suppression
    public function delete($id)
    {

        try {

            Employe::find($id)->forceDelete();


            return response()->json(['status' => 200]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => "Erreur lors de la suppression : " . $e->getMessage()
            ]);
        }
    }


}
