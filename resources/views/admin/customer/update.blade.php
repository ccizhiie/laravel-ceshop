@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit Data Pelanggan
            </div>
            <div class="card-body">
                <form action="{{ route('customer.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $id->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $id->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis Kelamin:</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="jenis">
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('gender', $id->gender) == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan" {{ old('gender', $id->gender) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telepon">No. Telepon:</label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                            name="telepon" value="{{ old('telepon', $id->telepon) }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat:</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $id->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto:</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                            name="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Foto Sebelumnya:</label><br>
                        @if ($id->foto)
                            <img src="{{ Storage::url($id->foto) }}" alt="Foto Customer" class="rounded"
                                style="width: 100%; max-width: 150px; height: auto;">
                        @else
                            <img src="{{ asset('image/nophoto.jpg') }}" alt="No Foto" class="rounded"
                                style="width: 100%; max-width: 150px; height: auto;">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                </form>
            </div>

        </div>
    </div>
@endsection
