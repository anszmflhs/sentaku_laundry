@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
        <a href="{{ route('karyawan.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
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
                        <label for="name_create">Name:</label>
                        <input type="" name="name" id="name_create"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_create">Contact:</label>
                        <input type="" name="contact" id="contact_create"
                            class="form-control @error('contact') is-invalid @enderror">
                        @error('contact')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="service_manage_create">Job:</label>
                        <select class="form-control @error('service_manage_id') is-invalid @enderror" name="service_manage_id"
                            id="service_manage_create">
                            @foreach ($service_manages as $service_manage)
                                <option value="{{ $service_manage->id }}">{{ ucwords($service_manage->title) }}</option>
                            @endforeach
                        </select>
                        @error('job_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender_create">Jenis Kelamin:</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>

                        @error('gender')
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
                        <label for="address_create">Address:</label>
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
