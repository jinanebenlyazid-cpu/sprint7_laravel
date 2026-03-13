<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Billet;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    // ─────────────────────────────────────────
    // GET /voyageurs
    // Formulaire infos voyageurs avant paiement
    // ─────────────────────────────────────────
    public function formVoyageurs()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect(url('/cart'))->with('error', '⚠️ Votre panier est vide.');
        }

        $totalBillets = collect($cart)->sum('qte');
        $total        = collect($cart)->sum(fn($item) => $item['prix'] * $item['qte']);

        return view('voyageurs', compact('cart', 'totalBillets', 'total'));
    }
    
    public function showPaiement()
{
    $cart  = session()->get('cart', []);
    if (empty($cart)) return redirect(url('/cart'));
    $total = collect($cart)->sum(fn($item) => $item['prix'] * $item['qte']);
    return view('paiement', compact('cart', 'total'));
}
    // ─────────────────────────────────────────
    // POST /paiement
    // Créer Commande + Billets en BD
    // ─────────────────────────────────────────
    public function payer(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect(url('/cart'))->with('error', '⚠️ Votre panier est vide.');
        }

        // 1. Créer la commande (id_client = 1 si pas connecté)
        $commande = Commande::create([
            'id_client'  => 1,
            'date_comm'  => Carbon::today(),
        ]);

        // 2. Créer un Billet par voyage dans le panier
        // Structure de la table billets : id, id_voyage, id_commande, qte
        foreach ($cart as $voyageId => $item) {
            Billet::create([
                'id_voyage'   => $voyageId,
                'id_commande' => $commande->id,
                'qte'         => $item['qte'],
            ]);
        }

        // 3. Vider le panier
        session()->forget('cart');

        // 4. Rediriger vers la page des billets
        return redirect(url('/billets/' . $commande->id));
    }

// GET /mes-billets
public function mesBillets()
{
    $derniere = Commande::where('id_client', Auth::id())
        ->orderBy('date_comm', 'desc')
        ->first();

    if (!$derniere) {
        return redirect(url('/'))->with('error', '⚠️ Vous n\'avez aucune réservation.');
    }

    return redirect(url('/billets/' . $derniere->id));
}
    // ─────────────────────────────────────────
    // GET /billets/{id}
    // Afficher + imprimer les billets
    // ─────────────────────────────────────────
    public function billets($id)
    {
        // Charger la commande avec ses billets et les voyages associés
        $commande = Commande::with(['billets.voyage'])->findOrFail($id);

        return view('billets', compact('commande'));
    }
}