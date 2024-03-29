@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$project->title}}</h1>
    <h5>Tipologia: @if ($project->type) {{$project->type->label}} @else nessuna @endif</h5>
    <p>{{$project->description}}</p>
    <img src="{{asset('storage/' . $project->image)}}" alt="" class="img-fluid">
    <div class="d-flex justify-content-between">
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">INDIETRO</a>
        <div class="d-flex justify-content-between gap-3">
            <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning">MODIFICA</a>
            <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">                           
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">ELIMINA</button>
            </form>
        </div>
    </div>
</div>   
@endsection
