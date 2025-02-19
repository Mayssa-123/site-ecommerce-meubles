@extends('admin')

@section('adminsection')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Images</th>
            <th scope="col">Product Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Promotion</th>
            <th scope="col">Stock</th>
            <th scope="col">Is Best</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr id="product-{{ $product->id }}">
            <th scope="row">{{ $product->id }}</th>
            <td>
                @if($product->images->count() > 0)
                    @foreach($product->images as $image)
                        <img src="{{ asset($image->image_path) }}" alt="Product Image" style="width: 100px; height: auto; margin-right: 5px;">
                    @endforeach
                @else
                    <p>No images</p>
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->promotion ?? 'No Promotion' }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->is_best ? 'Yes' : 'No' }}</td>

            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Show</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger delete-button" data-id="{{ $product->id }}">Delete</button>
               
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('products.create') }}" class="btn btn-success my-3">Add Product</a>

<!-- Pagination Links -->

    {!! $products->links('vendor.pagination.bootstrap-5') !!}


<script>
    $(document).ready(function () {
        $('.delete-button').on('click', function () {
            const productId = $(this).data('id');
            const row = $(`#product-${productId}`);

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this product!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: `/products/${productId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
