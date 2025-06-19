<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;
use Exception;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $employes = Employe::paginate(10);

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
        return view('backend.pages.employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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

        return view('backend.pages.employers.create', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $employe = Employe::find($id);
        try {
            $employe->delete();
            return redirect()->route('employes.index')
                ->with('success', "l'employé a été supprimé avec succès");
        } catch (Exception $e) {

            return "Erreur survenu lors de la supression de l'employe" . $e->getMessage();
        }
    }
}
