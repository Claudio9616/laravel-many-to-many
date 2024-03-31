@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('admin.projects.update', $project->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="my-3">
            <label for="title" class="form-label">Aggiungi titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror" id="title" name="title" placeholder="Titolo progetto" value="{{old('title', $project->title)}}">
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Aggiungi linguaggio</label>
            <input type="text" class="form-control @error('language') is-invalid @elseif (old('language', '')) is-valid @enderror" id="language" name="language" placeholder="Linguaggio del progetto" value="{{old('language', $project->language)}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Aggiungi descrizione</label>
            <textarea class="form-control @error('description') is-invalid @elseif (old('description', '')) is-valid @enderror" id="description" name="description" rows="3">{{old('description', $project->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Aggiungi immagine del progetto</label>
            <input type="file" class="form-control @error('image') is-invalid @elseif (old('image', '')) is-valid @enderror" id="image" name="image" placeholder="Immagine progetto" value="{{old('image', $project->image)}}">
        </div>
        <label for="type">Seleziona una categoria</label>
        <select class="form-select mb-3 @error('type_id') is-invalid @elseif (old('type_id', '')) is-valid @enderror" name="type_id" id="type">
            <option value="">Nessuna</option>
            @foreach ($types as $type)
            <option value="{{$type->id}}" @if(old('type_id', $project->type?->id) == $type->id) selected @endif>{{$type->label}}</option>                
            @endforeach
            {{-- dentro la option gli passi il label, ma per passare davvero il type id lo scrivi nel value e nell'if gli metti l'old per passare la selected --}}
        </select>
         {{-- per favorire la validazione il name dovrà essere composto da un array, per lo stesso motivo in questo caso il secondo parametro dell'old dovrà essere
        un array vuoto--}}
        <div class="mb-3">
            @foreach ($technologies as $tech)
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="{{"tech-$tech->id"}}">{{$tech->label}}</label>
                <input class="form-check-input" type="checkbox" id="{{"tech-$tech->id"}}" value="{{$tech->id}}" name="tech[]" @if(in_array($tech->id, old('tech', $prev_tech))) checked @endif>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">INDIETRO</a>
            <div class="d-flex justify-content-between gap-3">
                <button type="reset" class="btn btn-warning">Svuoata campi</button>
                <button type="submit" class="btn btn-success">Salva</button>
            </div>
        </div>
    </form>  
</div>     
@endsection