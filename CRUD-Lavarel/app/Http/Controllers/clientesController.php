<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    // Mostrar todos los clientes
    public function index()
    {
        $clientes = Clientes::all();

        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'No hay clientes disponibles'], 404);
        }

        return response()->json($clientes, 200);
    }

    // Mostrar un solo cliente
    public function show($id)
    {
        $cliente = Clientes::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($cliente, 200);
    }

    // Crear nuevo cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
        ]);

        $cliente = Clientes::create($validated);

        return response()->json($cliente, 201);
    }

    // Actualizar cliente existente
    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string',
            'apellido' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'telefono' => 'sometimes|required|string',
        ]);

        $cliente->update($validated);

        return response()->json($cliente, 200);
    }

    // Eliminar cliente
    public function destroy($id)
    {
        $cliente = Clientes::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado con éxito'], 200);
    }
}
