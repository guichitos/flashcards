<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Log;


class CardController extends Controller
{
    /**
     * Mostrar todas las tarjetas del usuario autenticado.
     */
    public function index(Request $request)
    {
        $cards = $request->user()->cards; // Solo devuelve las tarjetas del usuario autenticado
        return response()->json($cards, 200);
    }

    /**
     * Guardar una nueva tarjeta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        $card = $request->user()->cards()->create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return response()->json(['message' => 'Tarjeta creada', 'card' => $card], 201);
    }

    public function update(Request $request, $id)
    {
        $id = intval($id); // 🔹 Asegurar que el ID sea un número válido

        if (!$id) {
            return response()->json(['error' => 'ID inválido'], 400);
        }

        $card = Card::find($id);

        if (!$card) {
            return response()->json(['error' => 'Tarjeta no encontrada'], 404);
        }

        $card->update($request->only(['question', 'answer']));

        return response()->json($card);
    }

    


    /**
     * Eliminar una tarjeta.
     */
    public function destroy($id)
    {
        $card = Card::find($id);
    
        if (!$card) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }
    
        // 🔐 Asegurar que el usuario solo pueda eliminar sus propias tarjetas
        if ($card->user_id !== auth()->id()) {
            return response()->json(['message' => 'No tienes permiso para eliminar esta tarjeta'], 403);
        }
    
        $card->delete();
        return response()->json(['message' => 'Tarjeta eliminada'], 200);
    }
    
}
