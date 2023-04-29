<x-dashboard title="{{ $title }}">
    <h3 class="mb-3">{{ $title }}</h3>

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
        <div class="col-md-3">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/cash/tag/create"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Create tag"
                    class="btn btn-primary"
                    ><i class="bi bi-file-plus"></i
                ></a>
            </div>
        </div>
        <div class="col-md-3">
            <form action="/cash/tag" method="get">
                <div class="input-group mb-3 col-4">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search"
                        aria-label="Seacrh"
                        aria-describedby="search"
                        name="search"
                    />
                    <button
                        class="btn btn-outline-secondary"
                        type="submit"
                        id="search"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card col-md-6">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>

                    <th scope="col">action</th>
                </tr>
            </thead>

            <tbody>
                @if($datas->count()) @foreach($datas as $data)
                <tr>
                    <th scope="row">
                        {{ ($datas->currentpage()-1) * $datas->perpage() + $loop->index + 1 }}
                    </th>
                    <td>
                        {{ $data->name }}
                    </td>

                    <td>
                        <a
                            href="/cash/tag/{{ $data->id }}/edit"
                            class="badge bg-warning"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit Tag"
                            ><i class="bi bi-pencil-square"></i
                        ></a>
                        <form
                            action="/cash/tag/{{ $data->id }}"
                            method="post"
                            class="d-inline"
                        >
                            @method('delete') @csrf
                            <button
                                class="badge bg-danger border-0"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Delete Tag"
                                onclick="return confirm('are You sure ??')"
                            >
                                <i class="bi bi-file-x-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach @else
                <tr class="fw-bold">
                    <td colspan="4">Data Masih Kosong</td>
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
