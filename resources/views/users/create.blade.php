@extends('admin')

@section('adminsection')

<h1>Ajouter un utilisateur</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="role">Rôle</label>
        <select class="form-control" id="role" name="role_id">
            <option value="">Sélectionnez un rôle</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Ajouter l'utilisateur</button>
</form>

@endsection
