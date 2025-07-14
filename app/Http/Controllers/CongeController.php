<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCongeRequest;
use App\Http\Requests\StoreDemandeCongeRequest;
use App\Http\Requests\StoreDemandeCongeResuest;
use App\Models\TypeConge;
use App\Models\DemandeConge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Carbon\Carbon;
// use Illuminate\Container\Attributes\Auth;

class CongeController extends Controller
{
    public function form()
    {

        return view('backend.pages.conge.formConge');
    }

    public function index()
    {

        return view('backend.pages.conge.index', [
            'congeItems' => TypeConge::all()
        ]);
    }

    public function registerForm()
    {

        return view('backend.pages.conge.formtypeConge');
    }


    public function store(StoreCongeRequest $request)
    {
        try {

            $data = $request->validated();

            TypeConge::create($data);

            return redirect()->route('conge.index')->with('success_message', "Le congé a été crée avec succès.");
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error_message', "Erreur lors de la création du congés : " . $e->getMessage());
        }
    }

    public function edit($id)
    {


        $congeItem = TypeConge::findOrfail($id);

        return view('backend.pages.conge.edit', ['congeItem' => $congeItem]);
    }


    public function update(StoreCongeRequest $request, $id)
    {
        try {


            $congeItem = TypeConge::findOrfail($id);

            $congeItem->update($request->validated());



            return redirect()->route('conge.index')->with('success_message', 'Le type de congé a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error_message', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }



    public function delete($id)
    {

        try {

            $congeItem = TypeConge::findOrfail($id);
            $congeItem->forceDelete();

            return redirect()->route('conge.index')
                ->with('success_message', 'Le type de congé a été supprimé avec succès.');
        } catch (\Exception $e) {

            return redirect()->back()

                ->withInput()

                ->with('error_message', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }


    public function demandeConge()
    {


        return view('backend.pages.conge.demandeConge', [
            'types' => TypeConge::all(),
        ]);
    }


    public function storeDemandeConge(StoreDemandeCongeRequest $request)
    {

        try {
            $user = Auth::user();

            $dateDebut = Carbon::parse($request->date_debut);
            $dateFin   = Carbon::parse($request->date_fin);

            $duree = $dateDebut->diffInDays($dateFin) + 1;

            DemandeConge::create([
                'user_id'        => $user->id,
                'type_conge_id'  => $request->type_conge,
                'date_debut'     => $request->date_debut,
                'date_fin'       => $request->date_fin,
                'motif'          => $request->motif,
                'duree'          => $duree,
                'statut'         => 'en_attente',
            ]);

            return redirect()->back()->with('success', 'Votre demande a bien été envoyée.');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de la demande de congé.');
        }
    }



    public function ListeCongeDemander()
    {
        return view('backend.pages.conge.ListeCongeDemander', [

            'demandes' => DemandeConge::where('statut', '=', 'en_attente')->oldest()->paginate(10),
        ]);
    }



    public function accepteStatut($id)
    {

        $demande = DemandeConge::findOrFail($id);

        $demande->statut = 'accepter';
        $demande->save();

        return redirect()->back()->with('success', 'Demande approuvée avec succès.');
    }
    public function refuseStatut($id)
    {

        $demande = DemandeConge::findOrFail($id);

        $demande->statut = 'refuser';
        $demande->save();

        return redirect()->back()->with('success', 'Demande refusée avec succès.');
    }


    public function StatutConge(){

        return view('backend.pages.conge.statutDemande',[
            'demandes' => DemandeConge::where('statut','!=','en_attente')->latest()->paginate(10),
        ]);
    }
}
