<style>
    .card-1 {
    }

    .card-1:hover {
        transform: translateY(-5px);
    }
</style>

<div class="col p-1">
    <a href="{{ $route }}" class="card text-white bg-primary text-decoration-none card-1">
        <div class="card-header">{{ $header }}</div>
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <p class="card-text"> {{ $text }}</p>
        </div>
    </a>
</div>
