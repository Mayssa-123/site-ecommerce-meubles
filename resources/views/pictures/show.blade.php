<div class="container">
    @if($picture)
    <h1 class="mb-3 mt-4 display-5 fw-bold">{{ $picture->title }}</h1>
    <p class="mb-4 pe-lg-6">{{ $picture->description }}</p>
    <a href="{{ $picture->url }}" class="btn btn-outline-primary">Discover More</a>
    @if($picture->image)
    <img src="{{ asset($picture->image) }}" alt="{{ $picture->title }}" class="img-fluid mt-3">
    @endif
    @else
    <p>No picture data available.</p>
    @endif
</div>
