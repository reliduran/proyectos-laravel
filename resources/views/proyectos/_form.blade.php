@php
    $isEdit = isset($proyecto);
@endphp

<form action="{{ $isEdit ? route('proyectos.update', $proyecto) : route('proyectos.store') }}" method="POST">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror"
               value="{{ old('titulo', $proyecto->titulo ?? '') }}">
        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $proyecto->descripcion ?? '') }}</textarea>
        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Fecha inicio</label>
            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror"
                   value="{{ old('fecha_inicio', isset($proyecto->fecha_inicio) ? $proyecto->fecha_inicio->format('Y-m-d') : '') }}">
            @error('fecha_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Fecha fin</label>
            <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror"
                   value="{{ old('fecha_fin', isset($proyecto->fecha_fin) ? $proyecto->fecha_fin->format('Y-m-d') : '') }}">
            @error('fecha_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                @php $sel = old('estado', $proyecto->estado ?? 'pendiente'); @endphp
                <option value="pendiente" {{ $sel=='pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_progreso" {{ $sel=='en_progreso' ? 'selected' : '' }}>En progreso</option>
                <option value="completado" {{ $sel=='completado' ? 'selected' : '' }}>Completado</option>
            </select>
            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">{{ $isEdit ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
