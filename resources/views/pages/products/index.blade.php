@extends('layouts.app')

@section('title', 'Table')

@push('style')
    <style>
        /* Sliding form style */
        .sliding-form {
            position: fixed;
            top: 0;
            right: -100%;
            width: 400px;
            height: 100%;
            background-color: #fff;
            z-index: 1050;
            transition: right 0.4s ease-in-out;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            padding-top: 20px;
        }

        .sliding-form.show {
            right: 0;
        }

        /* Overlay style for blur effect */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(1px);
            z-index: 1040;
            transition: opacity 0.3s ease-in-out;
        }

        .overlay.d-none {
            display: none;
        }

        /* Close button style */
        .sliding-form .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            background: transparent;
            border: none;
        }
    </style>
@endpush

@section('main')
    <div class="main-content" id="mainContent">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input id="searchInput" type="text" class="form-control"
                                                placeholder="Search...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right"> TODO: {{-- membuat fitur all --}}
                                        <button class="btn btn-primary" data-filter="all">All</button>
                                        <button class="btn btn-primary" id="addCategoryBtn">Create</button>
                                        {{-- <a href="{{ route('products.create') }}" class="btn btn-primary" id="addCategoryBtn">Create</a> --}}
                                        <div id="loading" class="d-none">Loading...</div>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                            <th>Cost Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <td>{{ ($items->currentPage() - 1) * $items->perPage() + $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ $item->categories->name }}</td>
                                                <td>{{ $item->cost_price }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('products.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $items->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="overlay" class="overlay d-none"></div>
    <div class="sliding-form shadow" id="slidingForm">
        <div class="p-4">
            <h4 class="text-center mb-4">Add New Category</h4>
            <button type="button" class="close" id="closeSlidingForm">&times;</button>
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
            <button class="btn btn-secondary" id="closeFormBtn">Cancel</button>
        </div>
        </form>
    </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
    <script>
        // JavaScript for handling the sliding form and overlay
        const addCategoryBtn = document.getElementById('addCategoryBtn');
        const slidingForm = document.getElementById('slidingForm');
        const overlay = document.getElementById('overlay');
        const closeSlidingFormBtns = document.querySelectorAll('#closeSlidingForm, #closeFormBtn');

        addCategoryBtn.addEventListener('click', function() {
            slidingForm.classList.add('show');
            overlay.classList.remove('d-none');
        });

        overlay.addEventListener('click', function() {
            closeForm();
        });

        // closeSlidingFormBtns.forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         closeForm();
        //     });
        // });

        function closeForm() {
            slidingForm.classList.remove('show');
            overlay.classList.add('d-none');
        }
    </script>
@endpush
