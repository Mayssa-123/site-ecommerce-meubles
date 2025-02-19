@extends('admin')

@section('adminsection')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<h1>Liste des utilisateurs</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Rôle</th> <!-- Colonne modifiée -->
            <th>Password</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr id="user-{{ $user->id }}">
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role ? $user->role->name : 'Pas de rôle' }}</td> <!-- Affichage du nom du rôle -->
            <td>******</td>
            <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('users.editRole', $user) }}" class="btn btn-warning">Edit Role</a>
                <!-- Bouton de suppression -->
                <button type="button" class="btn btn-danger delete-button" data-id="{{ $user->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
{!! $users->links('vendor.pagination.bootstrap-5') !!}

<script>
    $(document).ready(function () {
        // Gestion de la suppression
        $('.delete-button').on('click', function () {
            const userId = $(this).data('id');
            const row = $(`#user-${userId}`);

            // Afficher la confirmation avec SweetAlert
            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimé, vous ne pourrez pas récupérer cet utilisateur !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Requête AJAX pour supprimer l'utilisateur
                    $.ajax({
                        url: `/users/${userId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            swal("L'utilisateur a été supprimé !", {
                                icon: "success",
                            });
                            row.remove(); // Supprimer la ligne du tableau
                        },
                        error: function () {
                            swal("Une erreur est survenue.", {
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("L'utilisateur est en sécurité !", {
                        icon: "info"
                    });
                }
            });
        });
    });
</script>

@endsection
