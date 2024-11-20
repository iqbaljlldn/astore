@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Table</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Table</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Table</h2>
                <p class="section-lead">Example of some Bootstrap table components.</p>

                <div class="row">
                    @foreach ($items as $item)
                        <div class="col-3 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Sales {{ $item->id }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chocolat-parent">
                                        <a href="{{ asset('img/example-image.jpg') }}" class="chocolat-image"
                                            title="Just an example">
                                            <div data-crop-image="285">
                                                <img alt="Example Image" src="{{ asset('img/example-image.jpg') }}"
                                                    class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="payment-details mt-3">
                                        <h6>Payment Method: {{ $item->payment_method }}</h6>
                                        <span
                                            class="badge badge-pill {{ $item->payment_status == 'Paid' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($item->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-content-right">
                                    <a href="{{ route('sales.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('sales.destroy', $item->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this sale?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
