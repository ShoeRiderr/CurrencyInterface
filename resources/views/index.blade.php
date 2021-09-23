@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!Auth::check())
            <div class="alert alert-info" role="alert">
                <a href="{{ route('login') }}">Zaloguj się</a>, żeby rozpocząć
            </div>
        @else
            @if ($currencies->isEmpty())
                <div class="alert alert-info" role="alert">
                    Aktualnie nie ma żadnych walut.
                </div>
            @else
                <h2>Dodaj waluty do ulubionej listy</h2>
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
                        <form id="currency-form" method="POST" action="{{ route('currency.action') }}">
                            @csrf
                            @include('_partials.currency-table-body', [
                                    'currencies' => $currencies
                                ])

                        </form>
                    </tbody>
                </table>
                <div class="d-flex flex-row-reverse p-3">
                    <button
                        type="submit"
                        name="state"
                        value="{{ ActionType::ADD_FAVOURITES }}"
                        form="currency-form"
                        class="btn btn-outline-primary"
                    >
                        Dodaj do ulbionej listy
                    </button>
                </div>
                {{ $currencies->links() }}
            @endif
        @endif
    </div>
@endsection