@extends('layouts.app')

@section('title','Lista de proyectos')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Proyectos</h1>
    <a href="{{ route('proyectos.create') }}" class="btn btn-primary align-self-center">Crear proyecto</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @forelse($proyectos as $p)
        <tr>
            <td>{{ $p->titulo }}</td>
            <td>{{ $p->fecha_inicio ?? '-' }}</td>
            <td>{{ $p->fecha_fin ?? '-' }}</td>
            <td>{{ ucfirst(str_replace('_', ' ', $p->estado)) }}</td>
            <td>
                <a href="{{ route('proyectos.show', $p) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                <a href="{{ route('proyectos.edit', $p) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                <form action="{{ route('proyectos.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar proyecto?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">No hay proyectos aún.</td></tr>
    @endforelse
    </tbody>
</table>

{{ $proyectos->links() }}
@endsection
