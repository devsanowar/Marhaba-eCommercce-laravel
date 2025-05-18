@php
    use App\Models\WebsiteSetting;
    use App\Models\Contact;
    use App\Models\User;
    use App\Models\Order;
    $user_count = User::count();
    $order_count = Order::count();
    $total_order_amount = Order::sum('total_price');

    $status_counts = Order::select('status', DB::raw('count(*) as count'))
        ->whereIn('status', ['pending', 'confirmed', 'shipped', 'delivered'])
        ->groupBy('status')
        ->pluck('count', 'status');

    $pending_order_count = $status_counts['pending'] ?? 0;
    $confirmed_order_count = $status_counts['confirmed'] ?? 0;
    $shipped_order_count = $status_counts['shipped'] ?? 0;
    $delivered_order_count = $status_counts['delivered'] ?? 0;

    $message_count = Contact::count();
    $website_setting = WebsiteSetting::first();
@endphp

<style>
    .dashboard-icons i {
        border: 1px solid #FF9F54;
        padding: 6px;
        border-radius: 10%;
        background: #FF9F54;
        color: #fff;
        font-size: 20px;
    }

    .dashboard-icons i:hover {
        color: #ff9f54;
        background: #f4f4f4;
        border-color: #f4f4f4;
    }
</style>

@extends('admin.layouts.app')
@section('admin_content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to {{ $website_setting->website_title }} web application</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" target="_blank"><i class="zmdi zmdi-home"></i>
                            {{ $website_setting->website_title }}</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-money-box"></i> </span>
                        <h2 class="mt-3">{{ $total_order_amount }}</h2>
                        <p>Total Sale</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-shopping-cart"></i> </span>
                        <h2 class="mt-3">{{ $order_count }}</h2>
                        <p>Total Orders</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-shopping-cart"></i> </span>
                        <h2 class="mt-3">{{ $pending_order_count }}</h2>
                        <p>Pending Orders</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-confirmation-number"></i></span>
                        <h2 class="mt-3">{{ $confirmed_order_count }}</h2>
                        <p>Confirmed Order</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-shopping-car"></i> </span>
                        <h2 class="mt-3">{{ $shipped_order_count }}</h2>
                        <p>Shipped Order</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-check-all"></i> </span>
                        <h2 class="mt-3">{{ $delivered_order_count }}</h2>
                        <p>Delivered Orders</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-accounts"></i></span>
                        <h2 class="mt-3">{{ $user_count }}</h2>
                        <p>Users</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px" data-bar-Width="2"
                            data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                <div class="card tasks_report">
                    <div class="body">
                        <span class="dashboard-icons"><i class="zmdi zmdi-email"></i> </span>
                        <h2 class="mt-3">{{ $message_count }}</h2>
                        <p>Inbox</p>
                        <div class="sparkline m-t-30" data-type="bar" data-width="97%" data-height="30px"
                            data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#ffa07a">9,5,1,5,4,8,7,6,3,4</div>
                    </div>
                </div>
            </div>





        </div>
    </div>
@endsection
