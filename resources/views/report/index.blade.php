<x-dashboard title="{{ $title }}">
    <h3 class="text-uppercase my-3">Report</h3>

    <div class="row mt-3 mb-3">
        <div class="col-md-6">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    href="/cash"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Cash Flow"
                    class="btn btn-primary"
                    ><i class="bi bi-wallet"></i> CASHFLOW</a
                >
            </div>
        </div>
    </div>

    <ul class="list-group">
        @foreach($datas as $data)
        <li class="list-group-item">
            {{ $data->name }}-{{ $data->description }} <br />
            @if($data->cashflow->count())
            <div class="row">
                <div class="col">
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
                            @foreach($data->cashflow as $cf)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($cf->tgl)->format('d M Y') }}
                                </td>
                                <td>
                                    {{ $cf->description }} <br />
                                    @foreach($cf->tags as $tag)
                                    <a
                                        href="/report/tag-detail/{{ $tag->id }}"
                                        class="badge bg-primary text-decoration-none"
                                        >{{ $tag->name }}</a
                                    >

                                    @endforeach
                                </td>
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
            @else @endif
        </li>
        @endforeach
    </ul>
    <div class="card">
        <div class="row">
            <div class="col-md-8">
                {{ $datas->onEachside(2)->links() }}
            </div>
        </div>
    </div>
</x-dashboard>
