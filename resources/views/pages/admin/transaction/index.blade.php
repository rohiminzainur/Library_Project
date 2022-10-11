@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div id="controller">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Peminjaman</h1>
                <p class="text-muted">Ini Halaman Peminjaman</p>
                <div class="form-group col-3 pr-0 float-right">
                    <select class="form-control" name="status1" id="exampleFormControlSelect1">
                        <option>Status</option>
                        <option value="1">Sudah dikembalikan</option>
                        <option value="0">Belum dikembalikan</option>
                    </select>
                </div>
                <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white">Tambah Transaksi</i>
                </a>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal Pinjam</th>
                                    <th class="text-center">Tanggal Kembali</th>
                                    <th class="text-center">Nama Peminjam</th>
                                    <th class="text-center">Lama Pinjam (Hari)</th>
                                    <th class="text-center">Total Buku</th>
                                    <th class="text-center">Total Bayar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal Pinjam</th>
                                    <th class="text-center">Tanggal Kembali</th>
                                    <th class="text-center">Nama Peminjam</th>
                                    <th class="text-center">Lama Pinjam (Hari)</th>
                                    <th class="text-center">Total Buku</th>
                                    <th class="text-center">Total Bayar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                            {{-- <tbody>
                        @foreach ($transactions as $no => $transaction)
                        <tr>
                            <td class="text-center">{{ $no+1 }}</td>
                            <td>{{ conver_date1($transaction->date_start) }}</td>
                            <td>{{ conver_date1($transaction->date_end) }}</td>
                            <td>{{ $transaction->name }}</td>
                            <td>{{ ($transaction->lama).' hari'}}</td>
                            <td>{{ ($transaction->qty)}}</td>
                            <td>{{ ($transaction->price*$transaction->qty)}}</td>
                            <td>{{ ($transaction->status == 0 ? "Belum Dikembalikan" : "Sudah Dikembalikan")}}</td>
                            @if ($transaction->status == 0)
                                <td>Belum Dikembalikan</td>
                            @else
                                <td>Sudah Dikembalikan</td>
                            @endif
                            <td>{{ ($transaction->price*$transaction->qty)}}</td>
                            
                            <td class="text-center">{{ convert_date($catalog->created_at) }}</td>
                            <td>
                                <a href="{{ route('catalogs.edit', $catalog->id) }}" class="btn btn-info">
                                <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="post"
                                    class="d-inline" onclick="return confirm('Yakin Ingin Dihapus?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')
    <script type="text/javascript">
        var actionUrl = '{{ url('admin/transactions') }}';
        var apiUrl = '{{ url('admin/api/transactions') }}';
        var columns = [{
                data: 'DT_RowIndex',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'date_start',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'date_end',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'name',
                orderable: true
            },
            {
                data: 'lama',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total_buku',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'total',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'status1',
                class: 'text-center',
                orderable: true
            },
            {
                render: function(index, row, data, meta) {
                    let response = `
                <a href="{{ route('transactions.edit', ':id') }}" class="btn btn-info btn-sm">
                <i class="fa fa-pencil-alt"></i>
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                <i class="fa fa-trash"></i>
                </a>`;
                    response = response.replace(':id', data.id);
                    console.log(response);
                    return response;
                },
                orderable: false,
                width: '200px',
                class: 'text-center'
            },
        ];
    </script>
    <script src="{{ url('backend/js/data.js') }}"></script>
    <script type="text/javascript">
        $('select[name=status1]').on('change', function() {
            gender = $('select[name=status1]').val();

            if (status1 == 0) {
                controller.table.ajax.url(apiUrl).load();
            } else {
                controller.table.ajax.url(apiUrl + '?status1=' + status1).load();
            }
        });
    </script>
@endsection
