<x-layout>
    <h1>Autók</h1>
    <div class="row">
        @foreach ($cars as $car)
            <div class="card m-2 p-0" style="width: 18rem;">
                @if ($car->image == null)
                    <img src="/placeholder.png" class="card-img-top">
                @else
                    <img src="/cars/{{ $car->id }}/image" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                    <p class="card-text">
                        {{ $car->description }}
                    </p>

                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <a href="/reservations/create/{{ $car->id }}?begin={{ $begin }}&end={{ $end }}"
                            class="btn btn-primary">Foglalás</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
