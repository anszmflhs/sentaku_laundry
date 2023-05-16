@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Tambah Data Price List</h1>
        <a href="{{ route('pricelist.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('pricelist.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="quantity_create">Quantity:</label>
                        <input type="" name="quantity" id="quantity_create"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga_create">Price:</label>
                        <input type="" name="harga" id="harga_create"
                            class="form-control @error('harga') is-invalid @enderror">
                        @error('harga')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="another_create">Others:</label>
                        <input type="" name="another" id="another_create"
                            class="form-control @error('another') is-invalid @enderror">
                        @error('another')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price_other_create">Price Others:</label>
                        <input type="" name="hargaanother" id="price_other_create"
                            class="form-control @error('price_other') is-invalid @enderror">
                        @error('price_other')
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
