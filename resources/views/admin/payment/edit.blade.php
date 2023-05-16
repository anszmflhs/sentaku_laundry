@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <x-alert></x-alert>


        <h1 class="h3 mb-2 text-gray-800">Update Data Payment</h1>
        <a href="{{ route('payment.index') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('payment.update', $payments->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user_create">Customer:</label>
                        <select class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                            id="user_create">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ ucwords($user->name) }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="service_manage_create">Service Manage:</label>
                        <select class="form-control @error('service_manage_id') is-invalid @enderror" name="service_manages_id"
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
                        <label for="pricelist_create">Others:</label>
                        <select class="form-control @error('price_lists_id') is-invalid @enderror" name="price_lists_id" id="pricelist_create">
                            @foreach ($price_lists as $price_list)
                                <option value="{{ $price_list->id }}">{{ ucwords($price_list->another) }}</option>
                            @endforeach
                        </select>
                        @error('price_list')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity_create">Quantity:</label>
                        <input type="text" name="quantity" id="quantity_create" value="{{ $payments->quantity }}"
                            class="form-control @error('quantity') is-invalid @enderror">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_create">Total:</label>
                        <input type="" name="total" id="total_create" value="{{ $payments->total }}"
                            class="form-control @error('total') is-invalid @enderror">
                        @error('total')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_create">Status:</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                        @error('status')
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
