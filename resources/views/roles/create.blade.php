@extends('admin')
@section('adminsection')
<div class="container">
    <h1>Create Role</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Role</button>
    </form>
</div>
@endsection
