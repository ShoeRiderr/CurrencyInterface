@foreach ($currencies as $currency)
        <tr>
            <td>{{ $currency->currency }}</td>
            <td>{{ $currency->code }}</td>
            <td>{{ $currency->mid ?? '-' }}</td>
            <td>{{ $currency->ask ?? '-' }}</td>
            <td>{{ $currency->bid ?? '-' }}</td>
            <td>{{ $currency->updated_at }}</td>
            <td>
                <input type="checkbox" name="currencies[]" value="{{ $currency->id }}">
            </td>
        </tr>
@endforeach