<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Mostrar lista paginada
    public function index()
    {
        $proyectos = Proyecto::orderBy('created_at', 'desc')->paginate(10);
        return view('proyectos.index', compact('proyectos'));
    }

    // Formulario crear
    public function create()
    {
        return view('proyectos.create');
    }

    // Guardar nuevo proyecto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completado',
        ]);

        Proyecto::create($validated);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
    }

    // Mostrar un proyecto
    public function show(Proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto'));
    }

    // Formulario editar
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    // Actualizar proyecto
    public function update(Request $request, Proyecto $proyecto)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completado',
        ]);

        $proyecto->update($validated);

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    // Eliminar proyecto
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado.');
    }
}
