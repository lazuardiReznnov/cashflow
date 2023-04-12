<x-dashboard title="{{ $title }}">
    <h3 class="text-uppercase my-3">Report</h3>

    <div class="row mt-3 mb-3">
        <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/cash"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Cash Flow"
                    class="btn btn-primary"
                    ><i class="bi bi-wallet"></i> CASHFLOW</a
                >
            </div>
        </div>
        <div class="col-md-6">
            <form action="/" method="get">
                <div class="input-group">
                    <select
                        class="form-select"
                        id="acount"
                        aria-label="Acount"
                        name="search"
                    >
                        <option selected>Choise Acount</option>
                        @foreach($acounts as $acount)
                        <option value="{{ $acount->id }}">
                            {{ $acount->name }}-{{ $acount->description }}
                        </option>

                        @endforeach
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Jumlah</th>
                </tr>
            </thead>

            <tbody>
                @if($datas->count()) @foreach($datas as $data)
                <tr>
                    <th scope="row">
                        {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                    </th>

                    <td>
                        {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y') }}
                    </td>
                    <td>{{ $data->description }}</td>
                    @php $jml = 0; @endphp
                    <td>
                        @if($data->acount->state == 0 ) @php $jml =
                        $data->credit @endphp @else @php $jml = $data->debet
                        @endphp @endif @currency($jml)
                    </td>
                    @php $ttl = 0; $ttl = $ttl+$jml @endphp @endforeach
                </tr>

                <tr class="fw-bold">
                    <td colspan="3">Total</td>
                    <td>@currency($ttl)</td>
                </tr>
                @else

                <tr>
                    <td colspan="4" class="text-center fw-bold">
                        Data Masih Kosong
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-8">
                {{ $datas->onEachside(2)->links() }}
            </div>
        </div>
    </div>
</x-dashboard>
