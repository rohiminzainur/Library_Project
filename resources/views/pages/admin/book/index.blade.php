@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div id="controller">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" placeholder="Search from title" v-model="search">
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary" @click="addData()">Create New Book</button>
            </div>
        </div>
        <hr>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col mb-3" v-for="book in filteredList">
                <div class="card h-100 border-bottom-dark" v-on:click="editData(book)">
                <div class="card-header bg-gradient-primary text-white">Book</div>
                <div class="card-body text-primary">
                    <h5 class="card-title">@{{ book.title }} ( @{{ book.qty }} )</h5>
                    <p class="card-text">Rp. @{{ numberWithSpaces(book.price) }} ,-</p>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Create -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create New Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form :action="actionUrl" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="isbn">Isbn</label>
                            <input type="text" class="form-control" name="isbn" :value="book.isbn" autofocus placeholder="Enter Isbn">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" :value="book.title" autofocus placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" name="year" :value="book.year" autofocus placeholder="Enter Year">
                        </div>
                        <div class="form-group">
                            <label for="publisher_id">Publisher</label>
                            <select name="publisher_id" class="form-control">
                                <option value="">Pilih Publisher</option>
                                @foreach ($publishers as $publisher)
                                <option :selected="book.publisher_id == {{ $publisher->id }}" value="{{ $publisher->id }}">
                                        {{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select name="author_id" class="form-control">
                                <option value="">Pilih Author</option>
                                @foreach ($authors as $author)
                                    <option :selected="book.author_id == {{ $author->id }}" value="{{ $author->id }}">
                                        {{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catalog_id">Catalog</label>
                            <select name="catalog_id" class="form-control">
                                <option value="">Pilih Catalog</option>
                                @foreach ($catalogs as $catalog)
                                    <option :selected="book.catalog_id == {{ $catalog->id }}" value="{{ $catalog->id }}">
                                        {{ $catalog->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" name="qty" :value="book.qty" autofocus placeholder="Enter Qty">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" :value="book.price" autofocus placeholder="Enter Title">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Simpan
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form :action="actionUrl" method="post" autocomplete="off">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                        <div class="form-group">
                            <label for="isbn">Isbn</label>
                            <input type="text" class="form-control" name="isbn" :value="book.isbn" autofocus placeholder="Enter Isbn">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" :value="book.title" autofocus placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control" name="year" :value="book.year" autofocus placeholder="Enter Year">
                        </div>
                        <div class="form-group">
                            <label for="publisher_id">Publisher</label>
                            <select name="publisher_id" class="form-control">
                                <option :value="book.publisher_id">Jangan Diubah</option>
                                @foreach ($publishers as $publisher)
                                    <option :selected="book.publisher_id == {{ $publisher->id }}" value="{{ $publisher->id }}">
                                        {{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select name="author_id" class="form-control">
                                <option :value="book.author_id">Jangan Diubah</option>
                                @foreach ($authors as $author)
                                    <option :selected="book.author_id == {{ $author->id }}" value="{{ $author->id }}">
                                        {{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catalog_id">Catalog</label>
                            <select name="catalog_id" class="form-control">
                                <option :value="book.catalog_id">Jangan Diubah</option>
                                @foreach ($catalogs as $catalog)
                                    <option :selected="book.catalog_id == {{ $catalog->id }}" class="text-black" value="{{ $catalog->id }}">
                                        {{ $catalog->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control" name="qty" :value="book.qty" autofocus placeholder="Enter Qty">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" :value="book.price" autofocus placeholder="Enter Title">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Simpan
                        </button>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" v-if="editStatus" v-on:click="deleteData(book.id)">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
@section('js')
<script type="text/javascript">
    var actionUrl = '{{ url('admin/books') }}';
    var apiUrl = '{{ url('admin/api/books') }}';
    
    var app = new Vue({
        el: '#controller',
        data: {
            books: [],
            search: '',
            book: {},
            actionUrl,
            editStatus: false
        },
        mounted: function () {
            this.get_books();
        },
        methods: {
            get_books() {
                const _this = this;
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function (data) {
                        _this.books = JSON.parse(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
            addData() {
                this.book = {};
                this.actionUrl = '{{ url('admin/books') }}';
                this.editStatus = false;
                $('#staticBackdrop').modal();
            },
            editData(book) {
                this.book = book;
                this.actionUrl = '{{ url('admin/books') }}'+'/'+book.id;
                this.editStatus = true;
                $('#staticBackdrop1').modal();
            },
            deleteData(id) {
                this.actionUrl = '{{ url('admin/books') }}'+'/'+id;
                    if (confirm("Yakin Dihapus?")) {
                        axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                            location.reload();
                        })
                    }
                },
            numberWithSpaces(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        },
        computed: {
            filteredList() {
                return this.books.filter(book => {
                    return book.title.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        }
    });
</script>
@endsection