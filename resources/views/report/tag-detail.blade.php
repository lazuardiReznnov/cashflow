<x-dashboard title="{{ $title }}">
    <h3 class="text-uppercase my-3">{{ $title }}</h3>

    <div class="row justify-content-bettwen">
        <div class="col-md-8">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Back"
                    class="btn btn-primary"
                    ><i class="bi bi-backspace-fill"></i> Back</a
                >
            </div>
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">date</th>

                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <?php
                            $ttl = 0;
                            $nilai=0;
                         ?>
                        <tbody>
                            @foreach($datas as $cf)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($cf->tgl)->format('d M Y') }}
                                </td>
                                <td>{{ $cf->description }} <br /></td>
                                @if($cf->debet != 0)
                                <?php 
                                    $nilai = $cf->debet ?> @else
                                <?php 
                            $nilai = $cf->credit ?> @endif
                                <td>@currency($nilai)</td>
                            </tr>
                            <?php $ttl = $ttl+$nilai ?>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="3" align="center">Total</td>
                                <td>@currency($ttl)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
