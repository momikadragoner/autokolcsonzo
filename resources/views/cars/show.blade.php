<x-layout>
    <img src="" class="card-img-top">
    <div class="">
        <h2 class="card-title">{{ $car->make }} {{ $car->model }}</h2>
        <span>{{ $car->price }}</span>
        <p class="card-text">
            {{ $car->description }}
        </p>
    </div>
</x-layout>
