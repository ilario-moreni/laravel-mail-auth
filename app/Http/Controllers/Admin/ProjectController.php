<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $form_data = $request->validated();

        
        if($request->has('file_img')){
            $path = Storage::disk('public')->put('file_img', $request->file_img);
            
            $form_data['file_img'] = $path;
        }
        
        $slug = Project::generateSlug($request->title);
        
        $form_data['slug'] = $slug;

        
        $newProject = new Project();
        
        
        $newProject->fill($form_data);
        
        $newProject->save();
        
        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }
        
        $newLead = new Lead();
        
        $newLead->title = $form_data['title'];
        $newLead->slug = $form_data['slug'];
        $newLead->description = $form_data['description'];
        
        $newLead->save();
        

        Mail::to('info@boolpress.com')->send(new NewContact($newLead));

        
        return redirect()->route('admin.projects.index')->with('message', 'Post creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        /* dd($technologies);  */
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        $form_data = $request->validated();
        
        $slug = Project::generateSlug($request->title, '-');
   
        $form_data['slug'] = $slug;
   
        if($request->has('file_img')){
            if($project->file_img){
                Storage::delete($project->file_img);
            }

            $path = Storage::disk('public')->put('file_img', $request->file_img);
            
            $form_data['file_img'] = $path;
        }

        $project->update($form_data);

        if($request->has('technologies'))
            $project->technologies()->sync($request->technologies);
        else
            $project->technologies()->detach();
       
        return redirect()->route('admin.projects.index')->with('message', 'La modifica del progetto è andata a buon fine.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        

        return redirect()->route('admin.projects.index')->with('message', 'La cancellazione del progetto è andata a buon fine.');
    }
}