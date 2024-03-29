@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="my-3">
            <label for="title" class="form-label">Aggiungi titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror" id="title" name="title" placeholder="Titolo progetto" value="{{old('title', '')}}">
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Aggiungi linguaggio</label>
            <input type="text" class="form-control @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror" id="language" name="language" placeholder="Linguaggio del progetto" value="{{old('language', '')}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Aggiungi descrizione</label>
            <textarea class="form-control @error('title') is-invalid @elseif (old('title', '')) is-valid @enderror" id="description" name="description" rows="3">{{old('description', '')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Aggiungi immagine del progetto</label>
            <input type="file" class="form-control @error('image') is-invalid @elseif (old('image', '')) is-valid @enderror" id="image" name="image" placeholder="Immagine progetto" value="{{old('image', '')}}">
        </div>
        <div class="mb-3">
            <label for="type">Seleziona una categoria</label>
            <select class="form-select mb-3 @error('type_id') is-invalid @elseif (old('type_id', '')) is-valid @enderror" name="type_id" id="type">
                <option value="">Nessuna</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" @if(old('type_id', '') == $type->id) selected @endif>{{$type->label}}</option>                
                @endforeach
                {{-- dentro la option gli passi il label, ma per passare davvero il type id lo scrivi nel value e nell'if gli metti l'old per passare la selected --}}
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <button type="reset">Svuoata campi</button>
        <button type="submit">Salva</button>
    </form>  
</div>  
@endsection