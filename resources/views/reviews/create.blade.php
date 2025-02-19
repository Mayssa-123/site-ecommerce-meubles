<!-- Formulaire d'avis -->
@extends('admin')

@section('adminsection')
<div class="mt-4">
    <h5>Laisser un avis</h5>
    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Note</label>
            <select name="rating" id="rating" class="form-select">
                <option value="1">1 étoile</option>
                <option value="2">2 étoiles</option>
                <option value="3">3 étoiles</option>
                <option value="4">4 étoiles</option>
                <option value="5">5 étoiles</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre un avis</button>
    </form>
</div>
@endsection
