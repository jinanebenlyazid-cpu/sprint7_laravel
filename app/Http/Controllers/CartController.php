<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ─────────────────────────────────────────
    // POST /cart/add
    // Ajouter un voyage au panier (session)
    // ─────────────────────────────────────────
    public function add(Request $request)
    {
        // ✅ Si non connecté → rediriger vers login
        if (!Auth::check()) {
            return redirect(url('/login'))->with('error', '🔑 Veuillez vous connecter pour réserver.');
        }

        $request->validate([
            'voyage_id' => 'required|exists:voyages,id',
            'qte'       => 'required|integer|min:1|max:10',
        ]);

        $voyage = Voyage::findOrFail($request->voyage_id);

        $cart = session()->get('cart', []);
        $id   = $voyage->id;

        if (isset($cart[$id])) {
            $cart[$id]['qte'] += $request->qte;
        } else {
            $cart[$id] = [
                'code_voyage'   => $voyage->code_voyage,
                'villeDepart'   => $voyage->villeDepart,
                'villeDarrivee' => $voyage->villeDarrivee,
                'heureDepart'   => $voyage->heureDepart,
                'heureDarrivee' => $voyage->heureDarrivee,
                'prix'          => $voyage->prixVoyage,
                'qte'           => $request->qte,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '✅ Voyage ajouté au panier !');
    }

    // ─────────────────────────────────────────
    // GET /cart
    // Afficher le panier
    // ─────────────────────────────────────────
    public function show()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['prix'] * $item['qte']);

        return view('cart', compact('cart', 'total'));
    }

    // ─────────────────────────────────────────
    // PATCH /cart/update
    // Modifier la quantité d'un voyage
    // ─────────────────────────────────────────
    public function update(Request $request)
    {
        $request->validate([
            'voyage_id' => 'required',
            'qte'       => 'required|integer|min:1|max:10',
        ]);

        $cart = session()->get('cart', []);
        $id   = $request->voyage_id;

        if (isset($cart[$id])) {
            $cart[$id]['qte'] = $request->qte;
            session()->put('cart', $cart);
        }

        return redirect(url('/cart'))->with('success', '✏️ Quantité mise à jour.');
    }

    // ─────────────────────────────────────────
    // DELETE /cart/remove
    // Supprimer un voyage du panier
    // ─────────────────────────────────────────
    public function remove(Request $request)
    {
        $request->validate([
            'voyage_id' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $id   = $request->voyage_id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect(url('/cart'))->with('success', '🗑️ Voyage retiré du panier.');
    }
}