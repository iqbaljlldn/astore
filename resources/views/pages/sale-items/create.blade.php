@extends('layouts.app')

@section('title', 'Form')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Form</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Forms</h2>
                <p class="section-lead">
                    Examples and usage guidelines for form control styles, layout options, and custom components for
                    creating a wide variety of forms.
                </p>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <form action="{{ route('sale-item-store', ['saleId' => $saleId]) }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    Sales
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="sales_id" value="{{ $saleId }}">
                                    <div class="form-group">
                                        <label for="products_id">Product</label>
                                        <input type="text" name="items[0][products_id]" id="products_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="items[0][quantity]" id="quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="items[0][price]" id="price" value="{{ $product-> }}">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
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
