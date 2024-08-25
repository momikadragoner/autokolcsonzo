<x-layout>
    <h1>Autók</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Gyártó</th>
                <th scope="col">Modell</th>
                <th scope="col">Ár</th>
                <th scope="col">Leírás</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->price }}</td>
                    <td>{{ $car->description }}</td>
                    <td>
                        <a href="{{ route('cars.edit', $car) }}">szerkeszt</a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('cars.destroy', $car) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn {{ $car->active ? 'btn-danger' : 'btn-secondary' }}"
                                {{ $car->active ? '' : 'disabled' }}>{{ $car->active ? 'deaktívál' : 'inaktív' }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('cars.create') }}" class="btn btn-primary">Új autó hozzáadása</a>
</x-layout>
