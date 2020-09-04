<div>
    <div class="mx-3">
        <div class="card-header header-elements-md-inline shadow-sm mb-3">

            <div class="card-title" style="margin-right: 50%">
                <h5 class="card-title">Data Varian Beras</h5>
            </div>
            <div class="card-elements">
                <button type="button" class="btn btn-primary btn-sm" style="width: 100px;" data-toggle="modal"
                    data-target="#form" wire:click="storeVariant()">Tambah +</button>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="form" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Varian Beras</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <input type="hidden" wire:model="variantId">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Jenis Beras:</label>
                            <div class="col-sm-9">
                                <select wire:model="riceId" class="form-control @error('riceId') is-invalid @enderror">
                                    <option value="0">Pilih Jenis Beras</option>
                                    <!-- Start looping from here -->
                                    @foreach ($kindRice as $rice)
                                    <option value="{{  $rice->id }}">{{ ucfirst($rice->name) }}</option>
                                    @endforeach
                                </select>
                                @error('riceId') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Tipe:</label>
                            <div class="col-sm-9">
                                <select wire:model="type" class="form-control @error('type') is-invalid @enderror">
                                    <option>Pilih Tipe Varian</option>
                                    <option value="5">5 Kg</option>
                                    <option value="10">10 Kg</option>
                                    <option value="15">15 Kg</option>
                                    <option value="20">20 Kg</option>
                                    <option value="25">25 Kg</option>
                                    <option value="50">50 Kg</option>
                                </select>
                                @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Jumlah:</label>
                            <div class="col-sm-9">
                                <input type="number" wire:model="stock" placeholder="Masukan Jumlah (Dalam satuan)"
                                    class="form-control @error('stock') is-invalid @enderror">
                                @error('stock') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Stok:</label>
                            <div class="col-sm-9">
                                <span class="text-muted pt-5">{{ $type && $stock ? number_format($stock * $type) . ' Kg' : '0 Kg' }}</span>
                                {{-- <input type="text" wire:model="totalStock" placeholder="Masukan stok (Dalam kiloan)" value=""
                                    class="form-control @error('totalStock') is-invalid @enderror">
                                @error('totalStock') <span class="text-danger error">{{ $message }}</span>@enderror --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        @if ($statusVariantUpdate)
                            <button type="button" wire:click.prevent="update()"
                                class="btn btn-primary close-modal">Simpan</button>
                        @else
                            <button type="button" wire:click.prevent="store()"
                                class="btn btn-primary close-modal">Simpan</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
