<x-layout>
    <h1>Autó foglalás</h1>
    <div class="d-flex justify-content-center">
        <div class="border rounded p-3 m-3">
            <form method="POST" action="/reservations/search">
                @csrf
                <h5>Foglalás időtartama</h5>
                <div class="row">
                    <div class="input-group mb-3 col">
                        <span class="input-group-text">Kezdete</span>
                        <input class="form-control" type="date" name="begin">
                    </div>
                    <div class="input-group mb-3 col">
                        <span class="input-group-text">Vége</span>
                        <input class="form-control" type="date" name="end">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Keresés</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
