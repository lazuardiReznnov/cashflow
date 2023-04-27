<x-dashboard title="{{ $title }}">
    <h3>CASHFLOW</h3>
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
    <div class="row justify-content-bettwen">
        <div class="col-md-8">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/cash/create-in"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Transaction In"
                    class="btn btn-success"
                    ><i class="bi bi-file-plus"></i> Cash In</a
                >
                <a
                    href="/cash/create-out"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Transaction Out"
                    class="btn btn-danger"
                    ><i class="bi bi-file-plus"> Cash Out</i></a
                >
                <a
                    href="/cash/acount"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Transaction Out"
                    class="btn btn-primary"
                    ><i class="bi bi-tag"></i> Acount</a
                >
                <a
                    href="/cash/tag"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Tag"
                    class="btn btn-warning"
                    ><i class="bi bi-tag"></i> Tags</a
                >
                <a
                    href="/cash/export-excel"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Export Excel"
                    class="btn btn-success"
                    ><i class="bi bi-file-earmark-spreadsheet"></i> Export
                    Excel</a
                >
                <a
                    href="/cash/export-pdf"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Export Pdf"
                    class="btn btn-danger"
                    ><i class="bi bi-file-earmark-spreadsheet"></i> Export
                    Pdf</a
                >
            </div>
        </div>
        <div class="col-md-4">
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
                        href="#"
                        class="badge bg-success"
                        data-bs-toggle="modal"
                        data-bs-target="#image"
                        ><i class="bi bi-pencil-square"></i
                    ></a>
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

            <!-- Modal -->
            <div
                class="modal fade"
                id="image"
                tabindex="-1"
                aria-labelledby="imageLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="imageLabel">
                                {{ $data->description }}
                            </h1>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                @if($data->image)
                                <img
                                    width="200"
                                    src="{{ asset('storage/'. $data->image->url) }}"
                                    class="rounded mx-auto d-block shadow my-3"
                                    alt="about Image"
                                />

                                @else
                                <img
                                    class="rounded mx-auto d-block shadow my-3"
                                    src="http://source.unsplash.com/200x200?truck"
                                    alt=""
                                    width="250"
                                />
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- endmodal -->
            @endforeach
            <tr class="fw-bold">
                <td colspan="4">Total</td>
                <td>@currency($ttldebet)</td>
                <td>@currency($ttlcredit)</td>
                <td>@currency($saldo)</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-8">
            {{ $datas->onEachside(2)->links() }}
        </div>
    </div>

    <!-- Modal -->
</x-dashboard>
