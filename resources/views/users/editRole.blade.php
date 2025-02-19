@extends('admin')

@section('adminsection')
<h1>Modifier le rôle de l'utilisateur</h1>

<form action="{{ route('users.updateRole', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="role">Rôle :</label>
        <select name="role_id" id="role" class="form-control" required>
            <option value="">Sélectionnez un rôle</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour le rôle</button>
</form>
@endsection
