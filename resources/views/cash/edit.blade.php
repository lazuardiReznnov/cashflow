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
            <h2>Form Edit Transaction</h2>
            <hr class="mb-5" />
            <form
                action="/cash/{{ $data->slug }}"
                method="post"
                enctype="multipart/form-data"
            >
                @csrf @method('put')

                <div class="mb-3 col-md-5">
                    <label for="formFile" class="form-label">Image</label>

                    @if($data->image)
                    <img
                        width="200"
                        class="img-fluid mb-2"
                        alt=""
                        src="{{ asset('storage/'. $data->image->url) }}"
                    />
                    <input
                        type="hidden"
                        name="old_url"
                        value="{{ $data->image->url }}"
                    />
                    @else
                    <img
                        width="200"
                        class="img-preview img-fluid mb-2"
                        alt=""
                    />
                    @endif

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

                <div class="form-floating mb-3">
                    <input
                        class="form-control @error('debet') is-invalid @enderror"
                        placeholder="date"
                        id="date"
                        name="tgl"
                        type="date"
                        value="{{ old('tgl', $data->tgl) }}"
                    />

                    <label for="debet">date</label>
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating mb-3 col-md-5">
                    <select
                        class="form-select @error('acount_id') is-invalid @enderror"
                        id="acount"
                        aria-label="acount"
                        name="acount_id"
                    >
                        <option selected>Select Acount</option>
                        @foreach($acount as $ac)
                        @if(old('acount_id',$data->acount_id)==$ac->id)
                        <option value="{{ $ac->id }}" selected>
                            {{ $ac->name }} - {{ $ac->description }}
                        </option>
                        @else
                        <option value="{{ $ac->id }}">
                            {{ $ac->name }} - {{ $ac->description }}
                        </option>
                        @endif @endforeach
                    </select>
                    <label for="acount">Select Acount</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Description"
                        id="description"
                        name="description"
                        >{{ old("description", $data->description) }}</textarea
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
                        value="{{ old('debet', $data->debet) }}"
                    />

                    <label for="debet">Debet</label>
                    @error('debet')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input
                        class="form-control @error('debet') is-invalid @enderror"
                        placeholder="credit"
                        id="credit"
                        name="credit"
                        type="text"
                        value="{{ old('credit', $data->credit) }}"
                    />

                    <label for="credit">credit</label>
                    @error('credit')
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
                        @foreach($tags as $tag) @foreach($data->tags as $tg)
                        @if(old('tag_id', $tg->id)==$tag->id)
                        <option value="{{ $tag->id }}" selected>
                            {{ $tag->name }}
                        </option>
                        @else
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                        @endif @endforeach @endforeach
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('script')
    <script src="/asset/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
