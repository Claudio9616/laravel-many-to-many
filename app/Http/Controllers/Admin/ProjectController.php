<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects',
            'description' => 'required|string',
            'language' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Il titolo è già esistente',
            'description.required' => 'La descrizione è obligatoria',
            'language.required' => 'La lingua è obbligatoria',
            'image.image' => 'Il file inserito non è valido',
            'type_id.exists' => 'La categoria non è valida'
        ]);
        $data = $request->all();
        $project = new Project();
        $project->fill($data);
        if(Arr::exists($data, 'image')){
            $img_url = Storage::putFile('project_images', $data['image']);
            $project->image = $img_url;
        }
        $project->save();
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'language' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'type_id' => 'nullable|exists:types,id'
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Il titolo è già esistente',
            'description.required' => 'La descrizione è obligatoria',
            'language.required' => 'La lingua è obbligatoria',
            'image.image' => 'Il file inserito non è valido',
            'type_id.exists' => 'La categoria non è valida'
        ]);
        $data = $request->all();
        $project->fill($data);
        if(Arr::exists($data, 'image')){
            if($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_images', $data['image']);
            $project->image = $img_url;
        }
        $project->save();
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete(); 
        return to_route('admin.projects.index')->with('message', "$project->title eliminato con successo");
    }
}
