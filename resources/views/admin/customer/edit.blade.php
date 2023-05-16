@extends('layouts.master')

@section('content')
    <div class="container-fluid">
      


        <h1 class="h3 mb-2 text-gray-800">Update Data Customer</h1>
        <a href="{{ route('customer.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name_edit">Nama Customer:</label>
                        <input required type="" value="{{ $customer->user->name }}" name="name" id="name_edit"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email_create">Email:</label>
                        <input type="email" value="{{ $customer->user->email }}" name="email" id="email_create"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_create">Status:</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="Inactive">Inactive</option>
                            <option value="Active">Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nohp_create">No HP:</label>
                        <input type="number" class="form-control @error('nohp') is-invalid @enderror" value="{{ $customer->nohp }}" name="nohp">
                        @error('nohp')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_create">Alamat:</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat">{{$customer->alamat}}</textarea>

                        @error('alamat')
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
