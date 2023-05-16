@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Update Data Karyawan</h1>
        <a href="{{ route('karyawan.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('karyawan.update', $karyawan->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="photo_edit">Foto diri:</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" id="photo_edit" class="form-control">
                        @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name_edit">Nama:</label>
                        <input required type="" value="{{ $karyawan->name }}" name="name" id="name_edit"
                            class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="contact_edit">Contact:</label>
                        <input type="text" value="{{ $karyawan->contact }}" class="form-control" name="contact">
                    </div>
                    <div class="form-group">
                        <label for="service_manage_edit">Job:</label>
                        <select class="form-control" name="service_manage_id" class="form-control @error('job') is-invalid @enderror" id="service_manage_edit">
                            @foreach ($service_manages as $service_manage)
                                <option value="{{ $service_manage->id }}" {{ $karyawan->servicemanage->id == $service_manage->id ? 'selected' : '' }}>
                                    {{ ucwords($service_manage->title) }}</option>
                            @endforeach
                        </select>
                        @error('job')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender_edit">Jenis Kelamin:</label>
                        <select class="form-control" name="gender">
                            <option value="L" {{ $karyawan->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $karyawan->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hire_date_edit">Tanggal Diterima:</label>
                        <input type="date" value="{{ $karyawan->hire_date }}" class="form-control @error('hire_date') is-invalid @enderror" name="hire_date">
                        @error('hire_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address_edit">Address:</label>
                        <textarea class="form-control" name="address">{{ $karyawan->address }}</textarea>
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
