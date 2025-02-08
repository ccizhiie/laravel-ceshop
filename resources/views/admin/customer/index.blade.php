@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <a href="{{ route('customer.create') }}" type="button" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->telepon }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    @if (empty($customer->foto))
                                        <img src="{{ asset('image/nophoto.jpg') }}" alt="{{ $customer->name }}"
                                            class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <img src="{{ Storage::url($customer->foto) }}" alt="{{ $customer->name }}"
                                            class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    @endif
                                </td>


                                <td>
                                <a href="{{ route('customer.edit', $customer->id) }}" type="button"
                                    class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $customer->id }}">
                                    Hapus
                                </button>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('components.delete')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                $('#form-delete').attr('action',
                    `{{ route('customer.delete', '') }}/${id}`);
                $('#modal-delete').modal('show');
            });
        });
    </script>
@endsection
