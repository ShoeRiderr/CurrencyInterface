@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Waluta</th>
                    <th>Skrócona nazwa</th>
                    <th>Uśredniony kurs wymiany</th>
                    <th>Cena kupna</th>
                    <th>Cena sprzedaży</th>
                    <th>Data pobrania informacji</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $currency)
                    <tr>
                        <td>{{ $currency->currency }}</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->mid }}</td>
                        <td>{{ $currency->ask }}</td>
                        <td>{{ $currency->bid }}</td>
                        <td>{{ $currency->updated_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $currencies->links() }}
    </div>
@endsection