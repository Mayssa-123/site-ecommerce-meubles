@extends('admin')
@section('adminsection')
<h1>Modifier l'utilisateur</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="form-group">
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmer le mot de passe :</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
