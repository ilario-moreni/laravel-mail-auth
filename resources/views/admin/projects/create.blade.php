@extends('layouts.admin')

@section('content')
    <div class='m-3 text-white'>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="title">
            <label for="" class="form-label">Members</label>
            <input name="members_num" id="members_num" type="number" class="form-control"
                placeholder="Amount of members partecipate at the project">
            <label for="" class="form-label">Budget</label>
            <input name="budget" id="budget" type="number" class="form-control"
                aria-label="Amount (to the nearest dollar)" placeholder='&euro;'>
            <label for="" class="contro-label">Type of project</label>
            <select name="type_id" id="type_id" class="form-control">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>
            <div>Technologies:</div>
            @foreach ($technologies as $technology)
                <input type="checkbox" value="{{ $technology->id }}" name="technologies[]">
                <label class="form-check-label">{{ $technology->title }}</label>
            @endforeach
            <br>
            <label for="formFile" class="mt-3 form-label">Insert image file</label>
            <input class="form-control" type="file" name='file_img' id="formFile">

            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea name="description" placeholder='Description of the project' class="form-control" id="description"
                rows="3"></textarea>
            <div class="mt-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
