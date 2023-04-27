<x-dashboard title="Form New Transaction">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            <h2>Form New Transaction</h2>
            <hr class="mb-5" />
            <form action="/cash" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="credit" value="0" />

                <div class="mb-3 col-md-5">
                    <label for="formFile" class="form-label">Image</label>
                    <img
                        width="200"
                        class="img-preview img-fluid mb-2"
                        alt=""
                    />
                    <input
                        id="pic"
                        type="file"
                        class="form-control @error('url') is-invalid @enderror"
                        name="url"
                        value="{{ old('url') }}"
                        onchange="previewImage()"
                        autocomplete="url"
                        autofocus
                    />

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating mb-3 col-md-5">
                    <input
                        class="form-control @error('date') is-invalid @enderror"
                        placeholder="date"
                        id="date"
                        name="tgl"
                        type="date"
                    />

                    <label for="date">date</label>
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating mb-3 col-md-5">
                    <select
                        class="form-select @error('description') is-invalid @enderror"
                        id="acount"
                        aria-label="acount"
                        name="acount_id"
                    >
                        <option selected>Select Acount</option>
                        @foreach($datas as $data)
                        @if(old('acount_id')==$data->id)
                        <option value="{{ $data->id }}" selected>
                            {{ $data->name }} - {{ $data->description }}
                        </option>
                        @else
                        <option value="{{ $data->id }}">
                            {{ $data->name }} - {{ $data->description }}
                        </option>
                        @endif @endforeach
                    </select>
                    <label for="acount">Works with selects</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Description"
                        id="description"
                        name="description"
                        >{{ old("description") }}</textarea
                    >
                    <label for="description">Description</label>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input
                        class="form-control @error('debet') is-invalid @enderror"
                        placeholder="debet"
                        id="debet"
                        name="debet"
                        type="text"
                    />

                    <label for="debet">Debet</label>
                    @error('debet')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
    <script src="/asset/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
