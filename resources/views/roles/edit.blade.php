@extends('admin')
@section('adminsection')
<div class="container">
    <h1>Edit Role</h1>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
