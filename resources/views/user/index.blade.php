@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($currencies->isEmpty())
            <div class="alert alert-info" role="alert">
                Brak śledzonych walut.
            </div>
        @else
            <h2>Lista ulubionych walut</h2>
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
                    value="{{ ActionType::REMOVE_FAVOURITES }}"
                    form="currency-form"
                    class="btn btn-outline-danger"
                >
                    Usuń zaznaczone
                </button>
            </div>
            {{ $currencies->links() }}
        @endif
    </div>
@endsection