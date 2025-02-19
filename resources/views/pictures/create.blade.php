@extends('admin')
@section('adminsection')
    <div class="container">
        <h1 class="my-4">Ajouter une Image</h1>

        <form action="{{ route('pictures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Entrez le titre de l'image" required>
            </div>


            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
