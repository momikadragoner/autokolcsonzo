<x-layout>
    @if ($edit)
        <h1>Autó szerkesztése</h1>
    @else
        <h1>Autó hozzáadása</h1>
    @endif
    <form method="POST" enctype="multipart/form-data"
        action="{{ $edit ? route('cars.update', $car) : route('cars.store') }}">
        @csrf
        @if ($edit)
            @method('patch')
        @endif
        <div class="mb-3">
            <label for="make" class="form-label">Márka</label>
            <input type="text" class="form-control" id="make" name="make" value="{{ $car->make ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Modell</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $car->model ?? '' }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Napi ár</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $car->price ?? 0 }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Fénykép</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>
        <div class="mb-3">s
            <label class="form-label" for="description">Leírás</label>
            <textarea class="form-control" name="description" id="description" style="height: 100px">{{ $car->description ?? '' }}</textarea>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">
            @if ($edit)
                Mentés
            @else
                Hozzáad
            @endif
        </button>
    </form>
</x-layout>
