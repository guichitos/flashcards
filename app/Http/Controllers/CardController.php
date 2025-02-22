<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 

class CardController extends Controller
{
    public function index()
    {
        return response()->json(Card::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        $card = Card::create($request->all());
        return response()->json($card, 201);
    }

    public function destroy($id)
    {
        $card = Card::find($id);
        if (!$card) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        $card->delete();
        return response()->json(['message' => 'Tarjeta eliminada'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        $card = Card::find($id);

        if (!$card) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        $card->update($request->all());

        return response()->json(['message' => 'Tarjeta actualizada', 'card' => $card], 200);
    }

}
