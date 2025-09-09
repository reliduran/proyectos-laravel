@extends('layouts.app')

@section('title','Editar proyecto')

@section('content')
<h1>Editar proyecto</h1>
@include('proyectos._form', ['proyecto' => $proyecto])
@endsection
