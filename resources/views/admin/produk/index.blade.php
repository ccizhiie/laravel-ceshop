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
                <a href="{{ route('produk.create') }}" type="button" class="btn btn-primary">Tambah</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($products as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->jenis }}</td>
                                <td>{{ $produk->harga_jual }}</td>
                                <td>{{ $produk->harga_beli }}</td>
                                <td>
                                @empty($produk->foto)
                                    <img src="{{ url('image/nophoto.jpg') }}" alt="{{ $produk->nama }}" class="rounded"
                                        style="width: 100%; max-width: 100px; height: auto;">
                                @else
                                    <img src="{{ url('image') }}/{{ $produk->foto }}" alt="{{ $produk->nama }}"
                                        class="rounded" style="width: 100%; max-width: 100px; height: auto;">
                                @endempty
                            </td>
                            <td>
                                <a href="#" type="button" class="btn btn-info text-white">Detail</a>
                                <a href="{{ route('produk.edit', $produk->id) }}" type="button"
                                    class="btn btn-warning">Edit</a>
                                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $produk->id }}">
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
            `{{ route('produk.destroy', '') }}/${id}`);
            $('#modal-delete').modal('show'); 
        });
    });
</script>
@endsection
