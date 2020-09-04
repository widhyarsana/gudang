
<div>

    <div class="mx-2">
        @if (session()->has('menir'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">{{ session()->get('menir') }} </span>
            </div>
        @endif
    </div>
    <div class="card mx-2">

        <div class="card-header header-elements-md-inline shadow-sm mb-3">

            <div class="card-title" style="margin-right: 50%">
                <h5 class="card-title">Data Menir</h5>
            </div>
        </div>

        <div class="mx-2">
            <div class="row mb-1 px-3">
                <div class="col-md-3">
                    <div class="card p-3 shadow-lg">
                        <span>Stok Menir:</span>
                        <h3> {{ number_format($menir->stock) }} Kg</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 shadow-lg">
                        <span>Harga PerKg:</span>
                        <h3>Rp. {{ number_format($menir->price,2,',','.')}}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 shadow-lg">
                        @if($added == 'add')
                        <form class="form">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="label">Quantity:</label>
                                </div>
                                <div class="col-md-4">
                                    <input wire:model="qty" type="number" class="form-control @error('qty') is-invalid @enderror" required>
                                </div>
                                <div class="col-md-3">
                                    <button wire:click.prevent="updateQty()" class="btn btn-sm btn-primary">Tambah</button>
                                </div>
                                <div class="col-md-3">
                                    <button wire:click.prevent="cancel()" class="btn btn-sm btn-secondary">Batal</button>
                                </div>
                            </div>
                        </form>
                        @elseif($added == 'price')
                        <form class="form">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="label">Harga:</label>
                                </div>
                                <div class="col-md-4">
                                    <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror" required>
                                </div>
                                <div class="col-md-3">
                                    <button wire:click.prevent="updatePrice()" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                                <div class="col-md-3">
                                    <button wire:click.prevent="cancel()" class="btn btn-sm btn-secondary">Batal</button>
                                </div>
                            </div>
                        </form>
                        @else
                            <div class="row">
                                <div class="col-md-4">
                                    <button wire:click.prevent="add()" class="btn btn-sm btn-info">Tambah Stok</button>
                                </div>
                                <div class="col-md-4">
                                    <button wire:click.prevent="price()" class="btn btn-sm btn-info">Ubah Harga</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card p-2 shadow">
                        <img src="/storage/pd.jpg" alt="user-picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
