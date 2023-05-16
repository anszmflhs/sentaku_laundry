@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Update Data Price List</h1>
        <a href="{{ route('pricelist.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('pricelist.update', $pricelist->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="quantity_edit">Quantity:</label>
                        <input required type="" value="{{ $pricelist->quantity }}" name="quantity" id="quantity_edit"
                            class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="harga_edit">Harga:</label>
                        <input type="text" value="{{ $pricelist->harga }}" class="form-control" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="another_edit">Others:</label>
                        <textarea class="form-control" name="another">{{ $pricelist->another }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga_another_edit">Others:</label>
                        <textarea class="form-control" name="hargaanother">{{ $pricelist->hargaanother }}</textarea>
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
