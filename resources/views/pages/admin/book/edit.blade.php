@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Book</h1>
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
                <form action="{{ route('books.update', $book->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="isbn">Isbn</label>
                        <input type="text" class="form-control @error('isbn') is-invalid
                        @enderror" name="isbn" value="{{ $book->isbn }}" autofocus placeholder="Enter Isbn">

                        @error('isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid
                        @enderror" name="title" value="{{ $book->title }}" autofocus placeholder="Enter Title">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control @error('year') is-invalid
                        @enderror" name="year" value="{{ $book->year }}" autofocus placeholder="Enter Year">

                        @error('year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="publisher_id">Publisher</label>
                        <select name="publisher_id" class="form-control @error('publisher_id')
                            is-invalid
                        @enderror">
                            <option value="{{ $book->publisher_id }}">Jangan Diubah</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}">
                                    {{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select name="author_id" class="form-control @error('author_id')
                            is-invalid
                        @enderror">
                            <option value="{{ $book->author_id }}">Jangan Diubah</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">
                                    {{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="catalog_id">Catalog</label>
                        <select name="catalog_id" class="form-control @error('catalog_id')
                            is-invalid
                        @enderror">
                            <option value="{{ $book->catalog_id }}">Jangan Diubah</option>
                            @foreach ($catalogs as $catalog)
                                <option class="text-black" value="{{ $catalog->id }}">
                                    {{ $catalog->name }}</option>
                            @endforeach
                        </select>
                        @error('catalog_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="text" class="form-control @error('qty') is-invalid
                        @enderror" name="qty" value="{{ $book->qty }}" autofocus placeholder="Enter Qty">

                        @error('qty')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid
                        @enderror" name="price" value="{{ $book->price }}" autofocus placeholder="Enter Price">

                        @error('price')
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
