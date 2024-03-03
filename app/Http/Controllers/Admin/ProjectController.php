<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Type;


use App\Http\Controllers\Controller;

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
        $types = Type::all();
        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $form_data = $request->all();
        $project = new Project();

        if($request->hasFile('preview_image')) {
            $path = Storage::disk('public')->put('projects_image', $form_data['preview_image']);
            $form_data['preview_image'] = $path;
        }
            

        $slug = Str::slug($form_data['title'], '-');
        $form_data['slug'] = $slug;
        $project->fill($form_data);

        $project->save();

        return redirect()->route('admin.projects.index');

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
        return view('admin.projects.edit', compact('project', 'types'));
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
        $form_data = $request->all();

        $exists = Project::where('title', '=', $form_data['title'])->where('id', '!=', $project->id)->get();

        if(count($exists) > 0){
            $error_message = 'This title is already used in another project!';
            return redirect()->route('admin.projects.edit', compact('project', 'error_message'));
        }

        if($request->hasFile('preview_image')){
            if($project->preview_image != null){
                Storage::disk('public')->delete($project->preview_image);
            }

            $path = Storage::disk('public')->put('projects_image', $form_data['preview_image']);
            $form_data['preview_image'] = $path;
        }

        $slug = Str::slug($form_data['title'], '-');
        $form_data['slug'] = $slug;

        $project->update($form_data);

        return redirect()->route('admin.projects.index', ['project' => $project->slug]);
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
        return redirect()->route('admin.projects.index');

    }
}
