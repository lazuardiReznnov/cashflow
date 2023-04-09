<x-dashboard title="Form New Transaction">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            <h2>Form New Transaction</h2>
            <hr class="mb-5" />
            <form action="/cash/acount" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Name"
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                    />

                    <label for="name">Name</label>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input
                        class="form-control @error('slug') is-invalid @enderror"
                        placeholder="slug"
                        id="slug"
                        name="slug"
                        type="text"
                        value="{{ old('slug') }}"
                    />

                    <label for="slug">slug</label>
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                    <select
                        class="form-select @error('slug') is-invalid @enderror"
                        id="state"
                        aria-label="state"
                        name="state"
                    >
                        <option selected>Select State</option>
                        <option value="0">In Come</option>
                        <option value="1">Out Come</option>
                    </select>
                    <label for="state">State</label>
                    @error('state')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        const link = "/cash/acount/checkSlug?name=";

        makeslug(name, slug, link);
    </script>
    @push('script')
    <script src="/asset/js/lazuardicode.js"></script>

    @endpush
</x-dashboard>
