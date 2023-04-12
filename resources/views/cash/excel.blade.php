<h3>CASHFLOW</h3>
<p>Date : {{ Date("d M Y") }}</p>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Acount</th>
            <th scope="col">Date</th>
            <th scope="col">Description</th>
            <th scope="col">Debet</th>
            <th scope="col">Credit</th>
            <th scope="col">Saldo</th>
        </tr>
    </thead>
    @php $ttldebet=0; $ttlcredit=0; @endphp
    <tbody>
        @foreach($datas as $data)
        <tr>
            <th scope="row">
                {{ $loop->iteration }}
            </th>
            <td>
                {{ $data->acount->name }} - {{ $data->acount->description }}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
            </td>
            <td>{{ $data->description }}</td>
            <td>@currency($data->debet)</td>
            <td>@currency($data->credit)</td>
            <td>
                @php $saldo = ($saldo+$data->credit)-$data->debet @endphp
                @currency($saldo)
            </td>

            @php $ttldebet = $ttldebet+$data->debet; $ttlcredit =
            $ttlcredit+$data->credit; @endphp
        </tr>
        @endforeach
        <tr class="fw-bold">
            <td colspan="4">Total</td>
            <td>@currency($ttldebet)</td>
            <td>@currency($ttlcredit)</td>
            <td>@currency($saldo)</td>
        </tr>
    </tbody>
</table>
