<?php

namespace App\Http\Controllers;
use App\Models\Voyage;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function formRecherche()
    {
        $villesDepart = Voyage::distinct()->pluck('villeDepart');
        $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

        return view('rechercher',compact('villesDepart','villesArrivee'));
    }
   public function resultatRecherche(Request $request)
{
    $vd = $request->ville_depart;
    $va = $request->ville_arrivee;

    $voyages = Voyage::where('villeDepart', $vd)->where('villeDarrivee', $va)->get();

    // ← ajouter ces deux lignes :
    $villesDepart  = Voyage::distinct()->pluck('villeDepart');
    $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

    return view('rechercher', compact('voyages', 'villesDepart', 'villesArrivee'));
}

public function accueil()
{
    $voyages = Voyage::all();
    return view('accueil', compact('voyages'));
}
}
