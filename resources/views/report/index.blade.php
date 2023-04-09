<x-dashboard title="{{ $title }}">
    <h3>Report</h3>

    <ul class="list-group">
        @foreach($datas as $data)
        <li class="list-group-item">
            {{ $data->name }} - {{ $data->description }}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                @if($data->cashflow->count())
                <tbody>
                    @foreach($data->cashflow as $cf)

                    <tr>
                        @php $ttl = 0; $jml=0; @endphp
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($cf->tgl)->format('d M Y') }}
                        </td>
                        <td>{{ $cf->description }}</td>
                        <td>
                            @if($data->state == 0) @php $jml = $cf->credit;
                            @endphp @else @php $jml = $cf->debet; @endphp @endif
                            @currency($jml)
                        </td>
                        @php $ttl = $ttl + $jml @endphp
                    </tr>

                    @endforeach
                    <tr>
                        <th colspan="3">TOTAL</th>
                        <th colspan="">@currency($ttl)</th>
                    </tr>

                    @else

                    <tr>
                        <td colspan="4">Data Masih Kosong</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </li>

        @endforeach
    </ul>
</x-dashboard>
