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
                        <form action="{{ route('sales.store') }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    Sales
                                </div>
                                    <div class="form-group">
                                        <label for="paymentMethod">Payment Method</label>
                                        <input type="text" name="payment_method" id="paymentMethod">
                                    </div>
                                    <div class="form-group">
                                        <label for="paymentStatus">Payment Status</label>
                                        <input type="text" name="payment_status" id="paymentStatus">
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
