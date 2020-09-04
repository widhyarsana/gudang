<div>
    <div class="card-header header-elements-md-inline shadow-sm mb-3">

        <div class="card-title" style="margin-right: 50%">
            <h5 class="card-title">Data Pegawai</h5>
        </div>
        <div class="card-elements">
            <button type="button" class="btn btn-primary btn-sm" style="width: 100px;" data-toggle="modal"
                data-target="#form" wire:click="storeEmployee()">Tambah +</button>
        </div>
    </div>
    <div wire:ignore.self id="form" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <input type="hidden" wire:model="employeeId">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama:</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="name" placeholder="Masukan Nama"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" wire:model="email" placeholder="Masukan Email"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">No. Hp:</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="phone" placeholder="Masukan No. HP"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Alamat:</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="address" placeholder="Masukan Alamat"
                                    class="form-control @error('address') is-invalid @enderror">
                                @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Jenis Kelamin:</label>
                            <div class="col-sm-9">
                                <select wire:model="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option>Pilih Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                                @error('gender') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                        @if ($statusUpdate)
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
