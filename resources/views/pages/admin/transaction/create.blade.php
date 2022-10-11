@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Transaction</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Anggota</label>
                        <select name="name" required class="form-control @error('name')
                            is-invalid
                        @enderror">
                            <option value="">Pilih Nama Aggota</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_start">Tanggal Pinjam</label>
                        <input type="date" required class="form-control @error('date_start')
                        is-invalid
                        @enderror" name="date_start" placeholder="Tanggal Pinjam"
                            value="{{ old('date_start') }}">
                            @error('date_start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_end">Tanggal Kembali</label>
                        <input type="date" required class="form-control @error('date_end')
                        is-invalid
                        @enderror" name="date_end" placeholder="Tanggal Kembali"
                            value="{{ old('date_end') }}">
                            @error('date_end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="book">Buku</label>
                        {{-- <input type="text" name="title" required class="form-control @error('title')
                            is-invalid
                        @enderror"> --}}
                        <select id="title" name="title[]" multiple="multiple" required class="form-control @error('title')
                            is-invalid
                        @enderror">
                            <option value="">Pilih Buku</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">
                                    {{ $book->title }}</option>
                            @endforeach
                        </select>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $("#title").select2({
            placeholder: "Silahkan Pilih Buku"
        });
    });
</script>
@endsection
