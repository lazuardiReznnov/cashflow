<x-dashboard title="Form New Transaction">
    @push('css')
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    />
    @endpush @push('script2')

    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk="
        crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".js-example-basic-multiple").select2({ placeholder: "Tags" });
        });
    </script>
    @endpush
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
                    <select
                        class="form-select @error('tag_id') is-invalid @enderror js-example-basic-multiple"
                        id="tag_id[]"
                        aria-label="acount"
                        name="tag_id"
                        multiple="multiple"
                    >
                        @foreach($tags as $tag) @if(old('tag_id')==$tag->id)
                        <option value="{{ $tag->id }}" selected>
                            {{ $tag->name }}
                        </option>
                        @else
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                        @endif @endforeach
                    </select>
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
