@extends('admin')

@section('adminsection')
<div class="container mt-4">
    <h3 class="mb-3">Gestion des Avis Clients</h3>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Produit</th>
                <th>Utilisateur</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Approuvé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->product->name }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>
                        {{$review->rating}}
                    </td>

                    <td>{{ $review->comment }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="form-check-input toggle-approval" data-id="{{ $review->id }}" {{ $review->approved ? 'checked' : '' }}>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Suppression -->
                            <form action="{{ route('reviews.delete', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>

                            <!-- Réponse -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#responseModal-{{ $review->id }}">
                                <i class="bi bi-reply"></i> Répondre
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Réponse -->
                <div class="modal fade" id="responseModal-{{ $review->id }}" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Répondre à l'avis de {{ $review->user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('reviews.respond', $review->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="response" class="form-control" rows="3" placeholder="Votre réponse ici..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Envoyer la réponse</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal -->
            @endforeach
        </tbody>
    </table>
    {!! $reviews->links('vendor.pagination.bootstrap-5') !!}

</div>

<script>
document.querySelectorAll('.toggle-approval').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        let reviewId = this.getAttribute('data-id');
        let isChecked = this.checked;

        fetch(`/reviews/${reviewId}/toggle-approval`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ approved: isChecked })
        }).then(response => response.json())
          .then(data => console.log(data.message));
    });
});
</script>

@endsection
