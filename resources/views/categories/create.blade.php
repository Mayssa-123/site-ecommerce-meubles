@extends('admin')
@section('adminsection')
<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Enter Category Name" required>
    <button type="submit" class="btn btn-primary">Add</button>
</form>

@endsection
