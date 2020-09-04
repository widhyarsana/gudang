<div>

    <div class="mx-3">
        @if (session()->has('rice'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">{{ session()->get('rice') }} </span>
            </div>
        @endif
    </div>

    {{-- <div class="card mx-3 p-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-teal-300 p-2 shadow-sm text-center"><a href="" class="text-white" style="font-family: 'Fjalla One', sans-serif; font-size: 14pt;"> <span>Penjualan Beras</span> </a></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-blue-300 p-2 shadow-sm text-center"><a href="" class="text-white" style="font-family: 'Fjalla One', sans-serif; font-size: 14pt;"> <span>Penjualan Dedak</span> </a></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info-300 p-2 shadow-sm text-center"><a href="" class="text-white" style="font-family: 'Fjalla One', sans-serif; font-size: 14pt;"> <span>Penjualan Menir</span> </a></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-primary-300 p-2 shadow-sm text-center"><a href="" class="text-white" style="font-family: 'Fjalla One', sans-serif; font-size: 14pt;"> <span>Penjualan Broken</span> </a></div>
            </div>
        </div>
    </div> --}}
<br><br>

    <div class="card mx-3">
        <div class="mx-3">
            <livewire:admin.product.rice.add> </livewire:admin.product.rice.add>
            <div class="row mb-1">

                @foreach ($kindRice as $rice)
                    <div class="col-md-3 text-left">
                        <div class="card bg-info-300 shadow-sm p-2">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4>{{ ucfirst($rice->name) }}</h4>
                                    <span>Rp. {{ number_format($rice->price, 2, ',', '.') }}</span>
                                    <div class="text-right">
                                        <strong >{{ number_format($rice->stock) }} Kg</strong>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="#" wire:click="getRice({{ $rice->id }})"><i class="far fa-edit"
                                            style="color:green
                                            ;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
        <livewire:admin.product.rice.form :kindRice="$kindRice"> </livewire:admin.product.rice.form>


        <div class="mx-3">

            <div class="row mb-1">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card px-1 shadow-sm">
                                <select wire:model="paginate" name="" id="" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card px-2 shadow-sm">
                                <input type="text" class="form-control form-control" wire:model="search"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card shadow-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><a href="#" role="button">No </a></th>
                                <th scope="col"><a href="#" wire:click.prevent="sortBy('product_id')" role="button">
                                        Jenis Beras <i class="fas fa-sort"></i></a></th>
                                <th scope="col"><a href="#" wire:click.prevent="sortBy('type')" role="button"> Tipe <i
                                            class="fas fa-sort"></i></a></th>
                                <th scope="col"><a href="#" wire:click.prevent="sortBy('stock')" role="button"> Jumlah
                                        <i class="fas fa-sort"></i></a></th>
                                <th scope="col"><a href="#" wire:click.prevent="sortBy('total_stock')" role="button">
                                        Stok <i class="fas fa-sort"></i></a></th>
                                <th scope="col"><a href="#" wire:click.prevent="sortBy('price')" role="button">
                                        Harga <i class="fas fa-sort"></i></a></th>
                                <th scope="col"><a href="#" role="button">Actions</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $key => $variant)
                                <tr>
                                    <td scope="row">{!! $loop->iteration !!}</td>
                                    <td>{{ \Str::ucfirst($variant->product->name) }}</td>
                                    <td>{{ $variant->type }} Kg</td>
                                    <td>{{ number_format($variant->stock) }}</td>
                                    <td>{{ number_format($variant->total_stock) }}</td>
                                    <td>Rp. {{ number_format($variant->price, 2, ',', '.') }}</td>

                                    <td style="width: 10%">
                                        <button class="btn btn-sm btn-info text-white" data-toggle="modal"
                                            data-target="#form" wire:click="getVariant({{ $variant->id }})">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 mt-2" style="margin-right: auto; margin-left: 40px;">
                    <i>Menampilkan {{ $variants->firstItem() }} sampai {{ $variants->lastItem() }} dari {{ $variants->total() }} hasil</i>
                </div>
                <div class="mb-3 mt-2" style="margin-left: auto; margin-right: 50px;">
                    {{ $variants->links() }}
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="mb-3 mt-2" style="margin-right: auto; margin-left: 40px;">
                <i>Menampilkan {{ $kindRice->firstItem() }} sampai {{ $admins->lastItem() }} dari
                    {{ $kindRice->total() }} hasil</i>
            </div>
            <div class="mb-3 mt-2" style="margin-left: auto; margin-right: 50px;">
                {{ $kindRice->links() }}
            </div>
        </div> --}}

    </div>






</div>
