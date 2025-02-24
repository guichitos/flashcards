<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

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

    /**
     * Actualizar una tarjeta existente.
     */
    public function update(Request $request, Card $card)
    {
        // Verifica que la tarjeta pertenece al usuario autenticado
        if ($request->user()->id !== $card->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        $card->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return response()->json(['message' => 'Tarjeta actualizada', 'card' => $card], 200);
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
