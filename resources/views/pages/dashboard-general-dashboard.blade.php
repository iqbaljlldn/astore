@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Daily Sales</h4>
                            </div>
                            <div class="card-body" id="dailySales">

                            </div>
                            <div class="card-footer" id="today">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Monthly Revenue</h4>
                            </div>
                            <div class="card-body" id="monthlyRevenue">

                            </div>
                            <div class="card-footer" id="thisMonth">
                                1 Nov - 1 Des
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="container my-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Top Seller</h5>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div>

                            <div class="list-group" id="listItems">
                                <!-- Start of Dish Item -->
                                {{-- TODO: create DOM with axios --}}
                                <div class="list-group-item mb-2" style="border-radius: 12px;">
                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/60" alt="Chicken Parmesan" class="mr-3"
                                            style="border-radius: 8px;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0" style="font-weight: bold;">Chicken Parmesan</h6>
                                            <p class="mb-0 text-muted" style="font-size: 0.85rem;">Order : x1 <span
                                                    style="font-weight: bold;">$55.00</span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="mb-1" style="color: #FFC0CB; font-weight: bold;">In Stock</p>
                                            <span style="font-size: 1.1rem; font-weight: bold;">$55.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Dish Item -->

                                <!-- Copy and edit this block for more items -->
                                <div class="list-group-item bg-dark text-white mb-2" style="border-radius: 12px;">
                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/60" alt="Chicken Parmesan" class="mr-3"
                                            style="border-radius: 8px;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0" style="font-weight: bold;">Chicken Parmesan</h6>
                                            <p class="mb-0 text-muted" style="font-size: 0.85rem;">Order : x2 <span
                                                    style="font-weight: bold; color: white;">$55.00</span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="mb-1" style="color: #FFC0CB; font-weight: bold;">In Stock</p>
                                            <span style="font-size: 1.1rem; font-weight: bold;">$110.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item bg-dark text-white mb-2" style="border-radius: 12px;">
                                    <div class="d-flex">
                                        <img src="https://via.placeholder.com/60" alt="Chicken Parmesan" class="mr-3"
                                            style="border-radius: 8px;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0" style="font-weight: bold;">Chicken Parmesan</h6>
                                            <p class="mb-0 text-muted" style="font-size: 0.85rem;">Order : x1 <span
                                                    style="font-weight: bold; color: white;">$55.00</span></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="mb-1" style="color: red; font-weight: bold;">Out of stock</p>
                                            <span style="font-size: 1.1rem; font-weight: bold;">$55.00</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add more items as needed -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 c">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="d-inline">Tasks</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cbx-1">
                                        <label class="custom-control-label" for="cbx-1"></label>
                                    </div>
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('img/avatar/avatar-4.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Redesign header</a></h6>
                                        <div class="text-small text-muted">Alfa Zulkarnain <div class="bullet"></div>
                                            <span class="text-primary">Now</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cbx-2"
                                            checked="">
                                        <label class="custom-control-label" for="cbx-2"></label>
                                    </div>
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('img/avatar/avatar-5.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-primary float-right mb-1">Completed</div>
                                        <h6 class="media-title"><a href="#">Add a new component</a></h6>
                                        <div class="text-small text-muted">Serj Tankian <div class="bullet"></div> 4 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cbx-3">
                                        <label class="custom-control-label" for="cbx-3"></label>
                                    </div>
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('img/avatar/avatar-2.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-warning float-right mb-1">Progress</div>
                                        <h6 class="media-title"><a href="#">Fix modal window</a></h6>
                                        <div class="text-small text-muted">Ujang Maman <div class="bullet"></div> 8 Min
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cbx-4">
                                        <label class="custom-control-label" for="cbx-4"></label>
                                    </div>
                                    <img class="rounded-circle mr-3" width="50"
                                        src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar">
                                    <div class="media-body">
                                        <div class="badge badge-pill badge-danger float-right mb-1">Not Finished</div>
                                        <h6 class="media-title"><a href="#">Remove unwanted classes</a></h6>
                                        <div class="text-small text-muted">Farhan A Mujib <div class="bullet"></div> 21
                                            Min</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary">Week</a>
                                    <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                            <div class="statistic-details mt-sm-4">
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 7%</span>
                                    <div class="detail-value">$243</div>
                                    <div class="detail-name">Today's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-danger"><i
                                                class="fas fa-caret-down"></i></span> 23%</span>
                                    <div class="detail-value">$2,902</div>
                                    <div class="detail-name">This Week's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span>9%</span>
                                    <div class="detail-value">$12,821</div>
                                    <div class="detail-name">This Month's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 19%</span>
                                    <div class="detail-value">$92,142</div>
                                    <div class="detail-name">This Year's Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
