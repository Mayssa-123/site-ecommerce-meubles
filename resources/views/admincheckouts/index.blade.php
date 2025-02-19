@extends('admin')

@section('adminsection')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="container">
    <h2>Gestion des Commandes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Utilisateur</th>
                <th>Prix Total</th>
                <th>Méthode de Paiement</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkouts as $checkout)
            <tr id="checkout-{{ $checkout->id }}">
                <td>{{ $checkout->id }}</td>
                <td>{{ $checkout->user->name ?? 'Utilisateur inconnu' }} </td>
                <td>{{ number_format($checkout->calculateTotalPrice(), 2) }} TND</td>
                <td>{{ $checkout->payment_method }}</td>
                <td>
                    <span class="badge bg-{{ $checkout->status == 'Pending' ? 'warning' : ($checkout->status == 'Delivered' ? 'success' : ($checkout->status == 'In progress' ? 'info' : 'danger')) }}">
                        {{ $checkout->status }}
                    </span>
                </td>
                <td>{{ $checkout->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.checkouts.edit', $checkout->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    <!-- Bouton de suppression sans formulaire -->
                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $checkout->id }}">Supprimer</button>
                    <a href="{{ route('admin.checkouts.generateInvoice', ['id' => $checkout->id])}}"><i class='bx bx-radio-circle'></i>Factures</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $checkouts->links('vendor.pagination.bootstrap-5') !!}

</div>

<script>
    $(document).ready(function () {
        // Gérer le bouton de suppression avec sweetalert
        $('.delete-button').on('click', function () {
            const orderId = $(this).data('id');  // Récupérer l'ID de la commande à supprimer

            // Afficher la fenêtre de confirmation
            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimée, cette commande ne pourra pas être récupérée !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Si l'utilisateur confirme la suppression, envoyer la requête AJAX
                    $.ajax({
                        url: '/admin/checkouts/' + orderId,  // L'URL de suppression avec l'ID
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'  // Ajout du token CSRF pour la sécurité
                        },
                        success: function (response) {
                            // Si la suppression réussie, afficher un message et supprimer la ligne de la table
                            swal("La commande a été supprimée !", {
                                icon: "success",
                            });
                            $('#checkout-' + orderId).remove();  // Retirer la ligne correspondante de la table
                        },
                        error: function () {
                            // En cas d'erreur, afficher un message d'erreur
                            swal("Une erreur est survenue. Veuillez réessayer.", {
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("Votre commande est en sécurité !");
                }
            });
        });
    });
</script>

@endsection
