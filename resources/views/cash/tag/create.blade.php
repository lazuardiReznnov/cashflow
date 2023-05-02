<x-dashboard title="{{ $title }}">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
            <h2>{{ $title }}</h2>
            <hr class="mb-5" />
            <div class="card col-md-6">
                <div class="card-body">
                    <form action="/cash/tag" method="post" e>
                        @csrf

                        <div class="form-floating mb-3">
                            <input
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="date"
                                id="name"
                                name="name"
                                type="text"
                            />

                            <label for="date">Tag Name</label>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
