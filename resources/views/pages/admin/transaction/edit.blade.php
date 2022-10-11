@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Transaction</h1>
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
                <form action="{{ route('transactions.update', $transaction->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Anggota</label>
                        <select name="name" readonly class="form-control @error('name')
                            is-invalid
                        @enderror">
                            <option value="">Jangan Diubah</option>
                            @foreach ($members as $member)
                                <option {{ $member->id == $transaction->member_id ? 'selected' : '' }} value="{{ $member->id }}">
                                    {{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
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
                    </div> --}}
                    <div class="form-group">
                        <label for="date_start">Tanggal Pinjam</label>
                        <input type="date" readonly required class="form-control @error('date_start')
                        is-invalid
                        @enderror" name="date_start" placeholder="Tanggal Pinjam"
                            value="{{ old('date_start', $transaction->date_start) }}">
                            @error('date_start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_end">Tanggal Kembali</label>
                        <input type="date" readonly required class="form-control @error('date_end')
                        is-invalid
                        @enderror" name="date_end" placeholder="Tanggal Kembali"
                            value="{{ old('date_end', $transaction->date_end) }}">
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
                        <?php $cnt=1; ?>
                        @foreach ($books as $book)
                        @foreach ($transactiondetails as $trxd)
                        @if ($book->id == $trxd->book_id)
                        <span>{{ $cnt }}. {{ $book->title }}</span><br>
                        <?php $cnt+=1; ?>
                        @endif
                        @endforeach
                            @endforeach
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" id="status1" name="status" value="1" {{ $transaction->status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="status1">
                            Sudah dikembalikan
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" id="status0" name="status" value="0" {{ $transaction->status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="status0">
                            Belum dikembalikan
                        </label>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
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
