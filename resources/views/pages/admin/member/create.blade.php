@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Member</h1>
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
                <form action="{{ route('members.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name Member</label>
                        <input type="text" class="form-control @error('name') is-invalid
                        @enderror" name="name" value="{{ old('name') }}" autofocus placeholder="Enter Name Member">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <div class="form-check">
                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="genderM" value="M" {{ old('gender') == 'M' ? 'checked' : '' }}>
                        <label class="form-check-label" for="genderM">
                            Male
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender"  id="genderF" value="F" {{ old('gender') == 'F' ? 'checked' : '' }}>
                        <label class="form-check-label" for="genderF">
                            Female
                        </label>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control @error('phone_number') is-invalid
                        @enderror" name="phone_number" value="{{ old('phone_number') }}" autofocus placeholder="Enter Phone Number">

                        @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" rows="10" class="d-block w-100 form-control @error('address') is-invalid
                            
                        @enderror">{{ old('address') }}</textarea>

                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid
                        @enderror" name="email" value="{{ old('email') }}" autofocus placeholder="Enter Email">

                        @error('email')
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
