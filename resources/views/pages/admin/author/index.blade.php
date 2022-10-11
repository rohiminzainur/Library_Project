@extends('layouts.admin')

@section('css')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="controller">

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Author</h1>
            <p class="text-muted">Ini Halaman Author</p>
            <!-- Button trigger modal -->
            <button type="button" @click="addData()" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Create New Author
            </button>
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
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone Number</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone Number</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create New Author</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form :action="actionUrl" method="post" @submit="submitForm($event, data.id)">
                    @csrf

                    <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                    <div class="form-group">
                        <label for="name">Name Author</label>
                        <input type="text" class="form-control @error('name') is-invalid
                        @enderror" name="name" :value="data.name" autofocus placeholder="Enter Name">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid
                        @enderror" name="email" :value="data.email" autofocus placeholder="Enter Email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid
                        @enderror" name="phone_number" :value="data.phone_number" autofocus placeholder="Enter Phone Number">

                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" rows="10" class="d-block w-100 form-control @error('address') is-invalid
                            
                        @enderror" :value="data.address"></textarea>

                        @error('address')
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
      <div class="modal-footer">
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
    var actionUrl = '{{ url('admin/authors') }}';
    var apiUrl = '{{ url('admin/api/authors') }}';

    var columns = [
        {data: 'DT_RowIndex', class: 'text-center', orderable: true},
        {data: 'name', class: 'text-center', orderable: true},
        {data: 'email', class: 'text-center', orderable: true},
        {data: 'phone_number', class: 'text-center', orderable: true},
        {data: 'address', orderable: true},
        {data: 'date', class: 'text-center', orderable: true},
        {render: function (index, row, data, meta) {
            return `
                <a href="#" class="btn btn-info btn-sm" onclick="controller.editData(event, ${meta.row})">
                <i class="fa fa-pencil-alt fa-2x"></i>
                </a>
                <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                <i class="fa fa-trash fa-2x"></i>
                </a>`;
        }, orderable: false, width: '200px', class: 'text-center'},
    ];
</script>
<script src="{{ url('backend/js/data.js') }}"></script>
    {{-- <script type="text/javascript">
        var controller = new Vue({
            el: '#controller',
            data: {
                data : {},
                actionUrl : '{{ url('admin/authors') }}',
                editStatus : false 
            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('admin/authors') }}';
                    this.editStatus = false;
                    $('#staticBackdrop').modal();
                },
                editData(data) {
                    this.data = data;
                    this.actionUrl = '{{ url('admin/authors') }}'+'/'+data.id;
                    this.editStatus = true;   
                    $('#staticBackdrop').modal();               
                },
                deleteData(id) {
                    this.actionUrl = '{{ url('admin/authors') }}'+'/'+id;
                    if (confirm("Yakin Dihapus?")) {
                        axios.post(this.actionUrl, {_method: 'DELETE'}).then(response => {
                            location.reload();
                        })
                    }
                }
            }
        });
    </script> --}}
@endsection

