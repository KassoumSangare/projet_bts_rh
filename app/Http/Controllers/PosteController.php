<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePosteRequest;
use App\Models\Poste;
use Illuminate\Http\Request;
use Exception;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $postes = Poste::paginate(10);

            return view('backend.pages.postes.index', compact('postes'));
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error_message', 'Erreur lors du chargement des postes : ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.postes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Enregistre un nouveau département
    public function store(CreatePosteRequest $request)
    {


        try {

            Poste::create($request->validated());

            return redirect()
                ->route('postes.index')
                ->with('success_message', "Le poste a été créé avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Erreur lors de la création : " . $e->getMessage());
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
        $poste = Poste::find($id);

        return view('backend.pages.postes.edit', compact('poste'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePosteRequest $request, string $id)
    {
        $poste = Poste::find($id);

        try {
            $poste->update($request->validated());

            return redirect()
                ->route('postes.index')
                ->with('success_message', "Le poste a été créé avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Erreur lors de la modifiaction : " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {


        try {

            $poste = Poste::find($id);
            $poste->delete();

            return redirect()
                ->route('postes.index')
                ->with('success_message', "Le poste a été créé avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error_message', "Erreur lors de la supression : " . $e->getMessage());
        }
    }
}
