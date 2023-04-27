<x-dashboard title="Form New Transaction">
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
                        class="form-select @error('description') is-invalid @enderror"
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
                    <label for="acount">Works with selects</label>
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
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard>
