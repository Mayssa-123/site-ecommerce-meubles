@extends('admin')
@section('adminsection')
{{-- <script src="{{ asset('js/deleteConfirmation.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger delete-button" data-id="{{$category->id}}">
                    Delete
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        <a href="{{ route('categories.create') }}" class="btn btn-success my-3">
            Add Category
        </a>
        {!! $categories->links('vendor.pagination.bootstrap-5') !!}

<script>
    $(document).ready(function () {
    // Attach click event to delete buttons
    $('.delete-button').on('click', function () {
        const categoryId = $(this).data('id'); // Get the category ID
        const row = $(`#category-${categoryId}`); // Get the row to remove later

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this category!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Send DELETE request via AJAX
                $.ajax({
                    url: `/categories/${categoryId}`, // Assuming your route is RESTful
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function (response) {
                        swal("Poof! The category has been deleted!", {
                            icon: "success",
                        });
                        row.remove(); // Remove the category row from the table
                        location.reload();
                    },
                    error: function (xhr) {
                        swal("Oops! Something went wrong.", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Your category is safe!");
            }
        });
    });
});

</script>
@endsection
