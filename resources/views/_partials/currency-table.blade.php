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
                'currencies' => $currencies,
                'userCurrencies' => isset($userCurrencies) ? $userCurrencies : collect()
            ])
        </form>
    </tbody>
</table>