<x-dashboard title="{{ $title }}">
    <h3>Home</h3>
    <p>Date : {{ Date("d M Y") }}</p>
    <div class="row mb-3">
        <div class="col-md-10">
            @if(session()->has('success'))
            <div class="card">
                <!-- pesan -->

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >
                    {{ session("success") }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="close"
                    ></button>
                </div>

                <!-- endpesan -->
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/cash/create"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Create New Transaction"
                    class="btn btn-primary"
                    ><i class="bi bi-file-plus"></i
                ></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form">
                <div class="input-group mb-3 col-4">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="cari"
                        aria-label="cari"
                        aria-describedby="button-addon2"
                    />
                    <button
                        class="btn btn-outline-secondary"
                        type="submit"
                        id="button-addon2"
                    >
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
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
                <th scope="col">action</th>
            </tr>
        </thead>
        @php $ttldebet=0; $ttlcredit=0; @endphp
        <tbody>
            @foreach($datas as $data)
            <tr>
                <th scope="row">
                    {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
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
                <td>
                    <a
                        href="/cash/{{ $data->slug }}/edit"
                        class="badge bg-warning"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Edit transaction"
                        ><i class="bi bi-pencil-square"></i
                    ></a>
                    <form
                        action="/cash/{{ $data->slug }}"
                        method="post"
                        class="d-inline"
                    >
                        @method('delete') @csrf
                        <button
                            class="badge bg-danger border-0"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Delete product"
                            onclick="return confirm('are You sure ??')"
                        >
                            <i class="bi bi-file-x-fill"></i>
                        </button>
                    </form>
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

    <div class="row">
        <div class="col-md-8">
            {{ $datas->onEachside(2)->links() }}
        </div>
    </div>
</x-dashboard>
