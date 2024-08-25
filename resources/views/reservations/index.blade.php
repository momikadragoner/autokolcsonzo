<x-layout>
    <h1>Foglalások</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Név</th>
                <th scope="col">Email</th>
                <th scope="col">Telefon</th>
                <th scope="col">Cím</th>
                <th scope="col">Auto ID</th>
                <th scope="col">Kezdete</th>
                <th scope="col">Vége</th>
                <th scope="col">Napok száma</th>
                <th scope="col">Fizetett összeg</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $res)
                <tr>
                    <td>{{ $res->name }}</td>
                    <td>{{ $res->email }}</td>
                    <td>{{ $res->phone }}</td>
                    <td>{{ $res->address }}</td>
                    <td>{{ $res->car_id }}</td>
                    <td>{{ $res->date_begin }}</td>
                    <td>{{ $res->date_end }}</td>
                    <td>{{ $res->days_reserved }}</td>
                    <td>{{ $res->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
