<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Document</title>
    </head>

    <body>
        <h3>CASHFLOW</h3>
        <p>Date : {{ Date("d M Y") }}</p>

        <table>
            <thead>
                <tr>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        #
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Acount
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Date
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Description
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Debet
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Credit
                    </th>
                    <th
                        scope="col"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                        "
                    >
                        Saldo
                    </th>
                </tr>
            </thead>
            @php $ttldebet=0; $ttlcredit=0; @endphp
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <th scope="row" style="border: solid; text-align: center">
                        {{ $loop->iteration }}
                    </th>
                    <td style="border: solid">
                        {{ $data->acount->name }} -
                        {{ $data->acount->description }}
                    </td>
                    <td style="border: solid">
                        {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                    </td>
                    <td style="border: solid">{{ $data->description }}</td>
                    <td style="border: solid; text-align: right">
                        @currency($data->debet)
                    </td>
                    <td style="border: solid; text-align: right">
                        @currency($data->credit)
                    </td>
                    <td style="border: solid; text-align: right">
                        @php $saldo = ($saldo+$data->credit)-$data->debet
                        @endphp @currency($saldo)
                    </td>

                    @php $ttldebet = $ttldebet+$data->debet; $ttlcredit =
                    $ttlcredit+$data->credit; @endphp
                </tr>
                @endforeach
                <tr class="fw-bold">
                    <td
                        colspan="4"
                        style="
                            border: solid;
                            text-align: center;
                            font-weight: bold;
                            font-size: 14px;
                        "
                    >
                        Total
                    </td>
                    <td
                        style="
                            border: solid;
                            text-align: right;
                            font-weight: bold;
                            font-size: 14px;
                        "
                    >
                        @currency($ttldebet)
                    </td>
                    <td
                        style="
                            border: solid;
                            text-align: right;
                            font-weight: bold;
                            font-size: 14px;
                        "
                    >
                        @currency($ttlcredit)
                    </td>
                    <td
                        style="
                            border: solid;
                            text-align: right;
                            font-weight: bold;
                            font-size: 14px;
                        "
                    >
                        @currency($saldo)
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
