<x-layout>
    <h1>Foglalás</h1>
    <form method="POST" action="{{ route('reservations.store') }}">
        <h5>Személyes adatok</h5>
        <div class="rounded border p-3 mb-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Név</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Cím</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
        </div>
        <h5>Foglalás részletei</h5>
        <div class="rounded border p-3 mb-3">
            <div class="mb-3">
                <span>{{ $car->make }}</span>
                <span>{{ $car->model }}</span>
                <span>{{ $id }}</span>
                <input type="hidden" name="car_id" value="{{ $id }}">
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Kezdete</span>
                        <input class="form-control" type="date" name="date_begin" value="{{ $begin }}"
                            readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Vége</span>
                        <input class="form-control" type="date" name="date_end" value="{{ $end }}" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Foglás hossza</span>
                        <input type="number" class="form-control" id="days" name="days_reserved"
                            value="{{ $days }}" readonly>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Végösszeg</label>
                <input type="number" class="form-control" id="price" name="total_price"
                    value="{{ $price }}" readonly>
            </div>
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
        <button type="submit" class="btn btn-primary">Foglalás véglegesítése</button>
    </form>
</x-layout>
