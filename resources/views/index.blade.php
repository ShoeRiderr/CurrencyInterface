@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/message-alert')
        @guest
            <div class="alert alert-info" role="alert">
                <a href="{{ route('login') }}">Zaloguj się</a>, żeby rozpocząć
            </div>
        @else
            @if ($currencies->isEmpty())
                <div class="alert alert-info" role="alert">
                    Aktualnie nie ma żadnych walut.
                </div>
            @else
                <h2>Lista walut</h2>

                @include('_partials.currency-table', [
                    'currencies' => $currencies,
                    'userCurrencies' => $userCurrencies
                ])

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
        @endguest
    </div>
@endsection