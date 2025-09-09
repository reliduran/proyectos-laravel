@extends('layouts.app')

@section('title', $proyecto->titulo)

@section('content')
<h1>{{ $proyecto->titulo }}</h1>

<p><strong>Descripción:</strong><br>{{ $proyecto->descripcion ?? '-' }}</p>
<p><strong>Inicio:</strong> {{ $proyecto->fecha_inicio ?? '-' }}</p>
<p><strong>Fin:</strong> {{ $proyecto->fecha_fin ?? '-' }}</p>
<p><strong>Estado:</strong> {{ ucfirst(str_replace('_',' ',$proyecto->estado)) }}</p>

<a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver</a>
<a href="{{ route('proyectos.edit', $proyecto) }}" class="btn btn-primary">Editar</a>
@endsection
