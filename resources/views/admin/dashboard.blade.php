@extends('admin.common.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card bg-white">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h4 class="mt-1 mb-1">welcome to {{auth()->user()->name}} !</h4>
                    <!-- <button class="btn btn-info d-none d-md-block">Import</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Total Sales</p>
                    <p class="text-muted">Audience to which the users belonged while on the current date Audience to
                        which
                        the users belonged while on the current date Audience to which the users belonged while on the
                        current date </p>
                    <div class="d-flex flex-wrap mb-4 mt-4 pb-4">
                        <div class="mr-4 mr-md-5">
                            <p class="mb-0">Revenue</p>
                            <h4>13,956</h4>
                        </div>
                        <div class="mr-4 mr-md-5">
                            <p class="mb-0">Returns</p>
                            <h4>27,219</h4>
                        </div>
                        <div class="mr-4 mr-md-5">
                            <p class="mb-0">Queries</p>
                            <h4>03,386</h4>
                        </div>
                        <div class="mr-4 mr-md-5">
                            <p class="mb-0">Invoices</p>
                            <h4>04,739</h4>
                        </div>
                    </div>
                    <canvas id="total-sales-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 grid-margin">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Users</p>
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h2 class="mr-3">33,956</h2>
                                <i class="mdi mdi-arrow-up mr-1 text-danger"></i><span>
                                    <p class="mb-0 text-danger font-weight-medium">+2.12%</p>
                                </span>
                            </div>
                            <p class="mb-0 text-muted">Total users world wide</p>
                        </div>
                        <canvas id="users-chart"></canvas>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Projects</p>
                            <div class="d-flex flex-wrap align-items-baseline">
                                <h2 class="mr-3">50.36%</h2>
                                <i class="mdi mdi-arrow-up mr-1 text-success"></i><span>
                                    <p class="mb-0 text-success font-weight-medium">+9.12%</p>
                                </span>
                            </div>
                            <p class="mb-0 text-muted">Total users world wide</p>
                        </div>
                        <canvas id="projects-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Downloads</p>
                            <p class="text-muted mb-2">Watching ice melt. This is fun. Only you could make those words
                                cute.
                            </p>
                            <div class="row mt-4">
                                <div class="col-md-6 stretch-card">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-6">
                                            <div id="offlineProgress"></div>
                                        </div>
                                        <div class="col-6 pl-0">
                                            <p class="mb-0">Offline</p>
                                            <h2>45,324</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 stretch-card mt-4 mt-md-0">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-6">
                                            <div id="onlineProgress"></div>
                                        </div>
                                        <div class="col-6 pl-0">
                                            <p class="mb-0">Online</p>
                                            <h2>12,236</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>

@endsection

@section('script')


@endsection