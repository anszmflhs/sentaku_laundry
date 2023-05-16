@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Update Data Karyawan</h1>
        <a href="{{ route('employee.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="photo_edit">Foto diri:</label>
                        <input type="file" name="photo" id="photo_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name_edit">Nama Karyawan:</label>
                        <input required type="" value="{{ $employee->name }}" name="name" id="name_edit"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender_edit">Jenis Kelamin:</label>
                        <select class="form-control" name="gender">
                            <option value="L" {{ $employee->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $employee->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birth_date_edit">Tanggal Lahir:</label>
                        <input type="date" value="{{ $employee->birth_date }}" class="form-control" name="birth_date">
                    </div>
                    <div class="form-group">
                        <label for="hire_date_edit">Tanggal Diterima:</label>
                        <input type="date" value="{{ $employee->hire_date }}" class="form-control" name="hire_date">
                    </div>
                    <div class="form-group">
                        <label for="mobile_edit">No HP:</label>
                        <input type="text" value="{{ $employee->mobile }}" class="form-control" name="mobile">
                    </div>
                    <div class="form-group">
                        <label for="job_id_edit">Pekerjaan:</label>
                        <select class="form-control" name="job_id" id="job_id_edit">
                            @foreach ($jobs as $job)
                                <option value="{{ $job->id }}" {{ $employee->job_id == $job->id ? 'selected' : '' }}>
                                    {{ ucwords($job->title) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bank_id_edit">Pekerjaan:</label>
                        <select class="form-control" name="bank_id" id="bank_id_edit">
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}"
                                    {{ $employee->bank_id == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_account_bank_edit">No Rekening:</label>
                        <input type="number" value="{{ $employee->no_account_bank }}" class="form-control"
                            name="no_account_bank">
                    </div>
                    <div class="form-group">
                        <label for="address_edit">Alamat:</label>
                        <textarea class="form-control" name="address">{{ $employee->address }}</textarea>

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
