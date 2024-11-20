@extends('layouts.app')

@section('title', 'Form')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add New Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></div>
                    <div class="breadcrumb-item">Create</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('products.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="custom-select">
                                            <option selected>Open this select menu</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>Buying Price</label>
                                        <input type="text" class="form-control" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" class="form-control" name="discount">
                                    </div>
                                    <div class="form-group">
                                        <label>Selling Price</label>
                                        <input type="text" class="form-control" name="selling_price">
                                    </div>
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="text" class="form-control" name="stock">
                                    </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
