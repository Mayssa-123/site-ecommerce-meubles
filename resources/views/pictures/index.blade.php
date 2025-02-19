@extends('admin')
@section('adminsection')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="container">
    <h1 class="my-4">Liste des Images</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Description</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pictures as $picture)
                <tr id="picture-{{ $picture->id }}">
                    <td><img src="{{ asset('storage/' . $picture->image) }}" alt="{{ $picture->description }}" width="100"></td>
                    <td>{{ $picture->title }}</td>
                    <td>{{ $picture->description }}</td>
                    <td>{{ $picture->url }}</td>
                    <td>
                        <a href="{{ route('pictures.edit', $picture->id) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger delete-button" data-id="{{ $picture->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('pictures.create') }}" class="btn btn-primary mb-3">Add</a>
    {!! $pictures->links('vendor.pagination.bootstrap-5') !!}

</div>

<script>
    $(document).ready(function () {
        $('.delete-button').on('click', function () {
            const pictureId = $(this).data('id');
            const row = $(`#picture-${pictureId}`);

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this product!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `/pictures/${pictureId}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            swal("Poof! The product has been deleted!", {
                                icon: "success",
                            });
                            row.remove();
                        },
                        error: function () {
                            swal("Oops! Something went wrong.", {
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("Your product is safe!");
                }
            });
        });
    });
</script>
@endsection
