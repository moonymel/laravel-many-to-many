@extends('layouts.admin')

@section('content')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-6 d-flex justify-content-between">
                <div class="image-sec">
                    <img src="{{ asset('/storage/' . $project->preview_image) }}">
                </div>
                <div class="infos">
                    <b>Titolo</b>: {{ $project->title }}<br>
                    <b>Description</b>: {{ $project->description }}<br>
                    <b>Authors</b>: {{ $project->authors }}<br>
                    <b>Completed</b>: {{ $project->description ? 'Yes' : 'No' }}<br>
                    <b>Technologies</b>: 
                    @forelse ($project->technologies as $technology) 
                        #{{ $technology->name }}
                    @empty 
                        No technologies selected
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>

@endsection