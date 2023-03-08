@extends('layouts.admin')

@section('content')
    <div class="card mt-5">
        <div class="bg-secondary bg-gradient card-header">
            {{ $project->title }}
            @if ($project->file_img)
                <div class="my-4">
                    <img src="{{ asset('storage/' . $project->file_img) }}" alt="{{ $project->title }}">
                </div>
            @endif
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Field: {{ $project->type_id ? $project->type->title : 'N/D' }}</li>
            <li class="list-group-item">{{ $project->budget }}&euro;</li>
            <li class="list-group-item">{{ $project->members_num }} members</li>
            <li class="mt-4 list-group-item">{{ $project->description }}</li>
        </ul>
    </div>
@endsection
