@extends('admin')

@section('adminsection')
<div class="container">
    <h1>Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr id="role-{{ $role->id }}">
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger delete-button" data-id="{{ $role->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $roles->links('vendor.pagination.bootstrap-5') !!}

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $('.delete-button').on('click', function () {
            const roleId = $(this).data('id');
            const row = $(`#role-${roleId}`);

            swal({
                title: "Are you sure?",
                text: "Once deleted, you won't be able to recover this role!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `/roles/${roleId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            swal("Poof! The role has been deleted!", {
                                icon: "success",
                            });
                            row.remove();  // Remove the deleted role's row
                        },
                        error: function () {
                            swal("Oops! Something went wrong.", {
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("Your role is safe!");
                }
            });
        });
    });
</script>

@endsection
