<?php

namespace App\Http\Controllers\Api;
use App\Models\Voyage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // ─────────────────────────────────────────
    // GET /api/voyages/search
    // ?ville_depart=Casablanca&ville_arrivee=Rabat
    // ─────────────────────────────────────────
    public function search(Request $request)
    {
        $vd = $request->query('ville_depart');
        $va = $request->query('ville_arrivee');
 
        // Si les deux paramètres sont vides → retourner tous les voyages
        if (!$vd && !$va) {
            $voyages = Voyage::all();
        } else {
            $voyages = Voyage::query()
                ->when($vd, fn($q) => $q->where('villeDepart', $vd))
                ->when($va, fn($q) => $q->where('villeDarrivee', $va))
                ->get();
        }
 
        return response()->json([
            'success' => true,
            'count'   => $voyages->count(),
            'data'    => $voyages->map(fn($v) => [
                'id'            => $v->id,
                'code_voyage'   => $v->code_voyage,
                'villeDepart'   => $v->villeDepart,
                'villeDarrivee' => $v->villeDarrivee,
                'heureDepart'   => $v->heureDepart,
                'heureDarrivee' => $v->heureDarrivee,
                'prixVoyage'    => $v->prixVoyage,
            ]),
        ]);
    }
 
    // ─────────────────────────────────────────
    // GET /api/voyages/villes
    // Retourner toutes les villes disponibles
    // ─────────────────────────────────────────
    public function villes()
    {
        $departs  = Voyage::distinct()->pluck('villeDepart');
        $arrivees = Voyage::distinct()->pluck('villeDarrivee');
 
        return response()->json([
            'success'         => true,
            'villesDepart'    => $departs,
            'villesArrivee'   => $arrivees,
        ]);
    }
}
