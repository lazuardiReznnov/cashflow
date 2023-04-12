<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap demo</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <h3>CASHFLOW</h3>
        <p>Date : {{ Date("d M Y") }}</p>

        <table class="table" border="1" padding="0">
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
                        {{ $data->acount->name }} -
                        {{ $data->acount->description }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                    </td>
                    <td>{{ $data->description }}</td>
                    <td>@currency($data->debet)</td>
                    <td>@currency($data->credit)</td>
                    <td>
                        @php $saldo = ($saldo+$data->credit)-$data->debet
                        @endphp @currency($saldo)
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

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
