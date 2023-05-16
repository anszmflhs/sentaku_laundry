@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
        <a href="{{ route('employee.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="photo_create">Foto diri:</label>
                        <input type="file" name="photo" id="photo_create"
                            class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username_create">Username:</label>
                        <input type="" name="username" id="username_create"
                            class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email_create">email:</label>
                        <input type="email" name="email" id="email_create"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role_create">Pekerjaan:</label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role_create">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name_create">Nama Karyawan:</label>
                        <input type="" name="name" id="name_create"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender_create">Jenis Kelamin:</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>

                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date_create">Tanggal Lahir:</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                            name="birth_date">
                        @error('birth_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hire_date_create">Tanggal Diterima:</label>
                        <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                            name="hire_date">
                        @error('hire_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mobile_create">No HP:</label>
                        <input type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile">
                        @error('mobile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="job_id_create">Pekerjaan:</label>
                        <select class="form-control @error('job_id') is-invalid @enderror" name="job_id"
                            id="job_id_create">
                            @foreach ($jobs as $job)
                                <option value="{{ $job->id }}">{{ ucwords($job->title) }}</option>
                            @endforeach
                        </select>
                        @error('job_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bank_id_create">Nama Bank:</label>
                        <select class="form-control @error('bank_id') is-invalid @enderror" name="bank_id"
                            id="bank_id_create">
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_account_bank_create">No Rekening:</label>
                        <input type="number" class="form-control @error('no_account_bank') is-invalid @enderror"
                            name="no_account_bank">
                        @error('no_account_bank')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address_create">Alamat:</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address"></textarea>

                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-fw"></i> SIMPAN
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
