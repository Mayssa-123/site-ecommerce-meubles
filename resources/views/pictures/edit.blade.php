@extends('admin')
@section('adminsection')
    <div class="container">
        <h1 class="my-4">Éditer l'Image</h1>

        <form action="{{ route('pictures.update', $picture->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $picture->title }}" required>
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ $picture->url }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $picture->description }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="{{ asset('storage/' . $picture->image) }}" width="100" class="mt-2" alt="Current Image">
            </div>

            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
@endsection
