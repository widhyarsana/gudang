<div>

    <div class="mx-2">
        @if (session()->has('employee'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">{{ session()->get('employee') }} </span>
            </div>
        @endif
    </div>
    <div class="card mx-2">

        <livewire:admin.employee.form> </livewire:admin.employee.form>

        <div class="mx-2">
            <div class="row mb-1">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card px-1">
                                <select wire:model="paginate" name="" id="" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card px-2">
                                <input type="text" class="form-control form-control" wire:model="search"
                                    placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><a href="#" role="button">No </a></th>
                            <th scope="col"><a href="#" wire:click.prevent="sortBy('name')" role="button"> Nama <i
                                        class="fas fa-sort"></i></a></th>
                            <th scope="col"><a href="#" wire:click.prevent="sortBy('email')" role="button"> E-Mail <i
                                        class="fas fa-sort"></i></a></th>
                            <th scope="col"><a href="#" wire:click.prevent="sortBy('address')" role="button"> Alamat <i
                                        class="fas fa-sort"></i></a></th>
                            <th scope="col"><a href="#" wire:click.prevent="sortBy('gender')" role="button"> Jenis
                                    Kelamin <i class="fas fa-sort"></i></a></th>
                            <th scope="col"><a href="#" role="button">Actions</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <td scope="row">{!! $loop->iteration !!}</td>
                                <td>{{ \Str::ucfirst($employee->name) }}</td>
                                <td>{{ \Str::ucfirst($employee->email) }}</td>
                                <td>{{ \Str::ucfirst($employee->address) }}</td>
                                <td>{{ $employee->gender == 1 ? 'Laki-Laki' : 'Perempuan' }}</td>
                                <td style="width: 18%">
                                    <button class="btn btn-sm btn-info text-white" data-toggle="modal"
                                        data-target="#form" wire:click="getEmployee({{ $employee->id }})">Edit</button>
                                    @if ($confirming === $employee->id)
                                        <button wire:click="destroy({{ $employee->id }})"
                                            class="btn btn-sm btn-danger">Yakin?</button>
                                    @else
                                        <button wire:click="confirmDelete({{ $employee->id }})"
                                            class="btn btn-sm btn-warning">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="mb-3 mt-2" style="margin-right: auto; margin-left: 40px;">
                <i>Menampilkan {{ $employees->firstItem() }} sampai {{ $employees->lastItem() }} dari
                    {{ $employees->total() }} hasil</i>
            </div>
            <div class="mb-3 mt-2" style="margin-left: auto; margin-right: 50px;">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
