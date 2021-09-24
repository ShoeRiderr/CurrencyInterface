@extends('layouts.app')

@section('content')
    <div class="container">
        @include('_partials/message-alert')
        @if ($currencies->isEmpty())
            <div class="alert alert-info" role="alert">
                Brak ulubionych walut.
            </div>
        @else
            <h2>Lista ulubionych walut</h2>

            @include('_partials.currency-table', [
                'currencies' => $currencies
            ])

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