@extends('admin')

@section('adminsection')
<h2>change order status</h2>

<form action="{{ route('admin.checkouts.updateStatus', $checkout->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="d-flex align-items-center">
        <select name="status" class="form-select mr-2">
            <option value="Pending" {{ $checkout->status == 'Pending' ? 'selected' : '' }}>En attente</option>
            <option value="In progress" {{ $checkout->status == 'In progress' ? 'selected' : '' }}>En cours</option>
            <option value="Delivered" {{ $checkout->status == 'Delivered' ? 'selected' : '' }}>Livrée</option>
            <option value="Canceled" {{ $checkout->status == 'Canceled' ? 'selected' : '' }}>Annulée</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
    </div>
</form>
@endsection
