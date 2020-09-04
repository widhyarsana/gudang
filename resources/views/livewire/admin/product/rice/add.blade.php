<div>
    <div class="card shadow-sm p-3 mt-2">
        <form action="" class="form">
            <input type="hidden" wire:model="riceId">
            <div class="row">
                <div class="col-md-3"><h5 class="card-title">Data Beras</h5></div>
                <div class="col-md-3">
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Jenis beras">
                </div>
                <div class="col-md-3">
                    <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Harga">
                </div>
                <div class="col-md-3">
                    @if ($statusUpdate)
                    <button wire:click.prevent="update()" class="btn btn-sm bg-teal-400">Perbarui </button>
                    @else 
                    <button wire:click.prevent="store()" class="btn btn-sm bg-teal-400">Tambah Jenis Beras</button>
                    @endif
                </div>

            </div>
        </form>
    </div>
</div>
