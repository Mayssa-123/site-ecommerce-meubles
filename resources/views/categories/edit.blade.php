@extends('admin')
@section('adminsection')

<div class="container">
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary my-3">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary my-3">Back to Categories</a>
    </form>
</div>

@endsection

