<x-layouts.master title="Dashboard" menutitle="dashboard">

    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('@assets/css/dashboard/dashui.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .card h5 {
                font-weight: 600;
            }

            .chart-container {
                height: 280px;
            }

            .counter-icon {
                font-size: 24px;
                padding: 10px;
                border-radius: 50%;
                background: #f1f1f1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .card-body .chart-container {
                height: 280px;
            }

            .card-body {
                padding: 1rem 0.5rem;
            }

            .counter-icon {
                width: 42px;
                height: 42px;
                font-size: 15px;
            }
            
        </style>
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!-- BEGIN CONTENT AREA -->
    <div id="content" class="main-content">
        <div class="container-fluid p-4">
            <div class="row gy-4">

                {{-- Inventory & Stock --}}
                <div class="col-12">
                    <h4 class="mb-3 fw-bold">Inventory & Stock</h4>

                    <div class="row gx-3">
                        {{-- Left: Counters --}}
                        <div class="col-xl-2 col-lg-3 col-md-3 d-flex flex-column gap-1">
                            @foreach ([
                            ['title' => 'Stock Levels', 'value' => '5,300 Items', 'icon' => 'package'],
                            ['title' => 'Low-Stock Alerts', 'value' => '15 Items', 'icon' => 'alert-triangle'],
                            ['title' => 'Out-of-Stock Items', 'value' => '8 Items', 'icon' => 'x-circle'],
                            ] as $item)
                            <div style="min-height: 120px;" class="m-1">
                                <div class="card shadow-sm border-0 h-100 px-1 py-1">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="counter-icon text-primary d-flex align-items-center justify-content-center m-1">
                                            <i data-feather="{{ $item['icon'] }}"></i>
                                        </div>
                                        <div class="text-start">
                                            <p class="text-muted fw-semibold mb-1">{{ $item['title'] }}</p>
                                            <p class="fw-bold mb-0 text-dark">{{ $item['value'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>



                        {{-- Right: Charts --}}
                        <div class="col-xl-10 col-lg-9 col-md-9">
                            <div class="row h-100">
                                <div class="col-md-6 mb-4 d-flex">
                                    <div class="card border-0 shadow-sm w-100 d-flex flex-fill">
                                        <div class="card-body">
                                            <h5 class="mb-3">Stock Movement</h5>
                                            <div id="stockMovementChart" class="chart-container"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 d-flex">
                                    <div class="card border-0 shadow-sm w-100 d-flex flex-fill">
                                        <div class="card-body">
                                            <h5 class="mb-3">Forecasted Demand vs. Stock</h5>
                                            <div id="forecastDemandChart" class="chart-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="col-12 mb-4 mt-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Low Stock Items</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Stock Level</th>
                                                    <th>Reorder Level</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Sample Data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Orders & Sales --}}
                <div class="col-12 mt-5">
                    <h4 class="mb-3 fw-bold">Orders & Sales</h4>
                    <div class="row">
                        @foreach ([
                        ['title' => 'Total Orders', 'value' => '1,245', 'icon' => 'shopping-cart'],
                        ['title' => 'Pending Orders', 'value' => '230', 'icon' => 'clock'],
                        ['title' => 'Completed Orders', 'value' => '1,015', 'icon' => 'check-circle'],
                        ['title' => 'Revenue (MTD)', 'value' => '$125,980', 'icon' => 'dollar-sign'],
                        ['title' => 'Total Expenses', 'value' => '$45,000', 'icon' => 'trending-down'],
                        ] as $item)
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                            <div class="card shadow-sm border-0 h-100 text-center">
                                <div class="card-body">
                                    <div class="counter-icon text-primary">
                                        <i data-feather="{{ $item['icon'] }}"></i>
                                    </div>
                                    <h6 class="text-muted fw-semibold">{{ $item['title'] }}</h6>
                                    <h4 class="fw-bold mb-0 text-dark">{{ $item['value'] }}</h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @foreach ([
                        ['title' => 'Sales vs. Expenses', 'id' => 'salesExpensesChart'],
                        ['title' => 'Sales Trends', 'id' => 'salesTrendsChart'],
                        ['title' => 'Orders Status Breakdown', 'id' => 'ordersStatusChart'],
                        ['title' => 'Profit Margin Analysis', 'id' => 'profitMarginChart'],
                        ] as $chart)
                        <div class="col-lg-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">{{ $chart['title'] }}</h5>
                                    <div id="{{ $chart['id'] }}" class="chart-container"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Recent Orders</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">Sample Data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Warehouse & Logistics --}}
                <div class="col-12 mt-5">
                    <h4 class="mb-3 fw-bold">Warehouse & Logistics</h4>

                    <div class="row">
                        <div class="col-lg-2 mb-4">
                            <div class="row">
                                @foreach ([
                                ['title' => 'Active Warehouses', 'value' => '4', 'icon' => 'home'],
                                ['title' => 'Warehouse Capacity', 'value' => '75% Utilized', 'icon' => 'bar-chart-2'],
                                ] as $item)
                                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                                    <div class="card shadow-sm border-0 h-100 text-center">
                                        <div class="card-body">
                                            <div class="counter-icon text-primary">
                                                <i data-feather="{{ $item['icon'] }}"></i>
                                            </div>
                                            <h6 class="text-muted fw-semibold">{{ $item['title'] }}</h6>
                                            <h4 class="fw-bold mb-0 text-dark">{{ $item['value'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Warehouse Utilization</h5>
                                    <div id="warehouseUtilizationChart" class="chart-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Warehouse Transfers Log <small>(Last 5 )</small></h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Transfer ID</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">Sample Data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Forecast & Insights --}}
                <div class="col-12 mt-5">
                    <h4 class="mb-3 fw-bold">Forecast & Insights</h4>
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card border-0 shadow-sm chart-equal-height">
                                <div class="card-body p-1">
                                    <h5 class="mb-3">Customer Growth Rate</h5>
                                    <div id="customerGrowthChart" class="chart-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card border-0 shadow-sm chart-equal-height">
                                <div class="card-body">
                                    <h5 class="mb-3">Top Selling Products</h5>
                                    <div id="topSellingProductsChart" class="chart-container"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                {{-- User Access & Roles --}}
                <div class="col-12 mt-5">
                    <h4 class="mb-3 fw-bold">User Access & Roles</h4>
                    <div class="row">
                        <div class="col-12 col-xl-2 col-md-12 mb-4">
                            <div class="row">
                                @foreach ([
                                ['title' => 'Total Users', 'value' => '85', 'icon' => 'user'],
                                ['title' => 'Pending Approvals', 'value' => '12', 'icon' => 'file-text'],
                                ] as $item)
                                <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
                                    <div class="card shadow-sm border-0 h-100 text-center">
                                        <div class="card-body">
                                            <div class="counter-icon text-primary">
                                                <i data-feather="{{ $item['icon'] }}"></i>
                                            </div>
                                            <h6 class="text-muted fw-semibold">{{ $item['title'] }}</h6>
                                            <h4 class="fw-bold mb-0 text-dark">{{ $item['value'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-xl-10 col-md-10 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Employee Activity</h5>
                                    <div id="employeeActivityChart" class="chart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTENT AREA -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/apex/apexcharts.min.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                feather.replace();

                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                const charts = {
                    salesExpensesChart: {
                        type: 'area',
                        multiSeries: [{
                                name: 'Sales',
                                data: months.map(() => Math.floor(Math.random() * 10000))
                            },
                            {
                                name: 'Expenses',
                                data: months.map(() => Math.floor(Math.random() * 8000))
                            }
                        ],
                        categories: months
                    },
                    salesTrendsChart: {
                        type: 'line',
                        multiSeries: [{
                            name: 'Sales',
                            data: months.map(() => Math.floor(Math.random() * 10000))
                        }],
                        categories: months
                    },
                    stockMovementChart: {
                        type: 'bar',
                        multiSeries: [{
                                name: 'Stock In',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            },
                            {
                                name: 'Stock Out',
                                data: months.map(() => Math.floor(Math.random() * 2500))
                            }
                        ],
                        categories: months
                    },
                    topSellingProductsChart: {
                        type: 'donut',
                        labels: ['Product A', 'Product B', 'Product C'],
                        series: [44, 55, 41]
                    },
                    ordersStatusChart: {
                        type: 'pie',
                        labels: ['Shipped', 'Pending', 'Processing', 'Canceled'],
                        series: [400, 300, 200, 100]
                    },
                    warehouseUtilizationChart: {
                        type: 'radialBar',
                        labels: ['Utilized'],
                        series: [75]
                    },
                    customerGrowthChart: {
                        type: 'area',
                        multiSeries: [{
                            name: 'New Customers',
                            data: months.map(() => Math.floor(Math.random() * 500))
                        }],
                        categories: months
                    },
                    profitMarginChart: {
                        type: 'bar',
                        multiSeries: [{
                            name: 'Profit %',
                            data: months.map(() => Math.floor(Math.random() * 100))
                        }],
                        categories: months
                    },
                    employeeActivityChart: {
                        type: 'heatmap',
                        series: months.map(month => ({
                            name: month,
                            data: Array.from({
                                length: 7
                            }, (_, i) => ({
                                x: `W${i + 1}`,
                                y: Math.floor(Math.random() * 100)
                            }))
                        }))
                    },
                    forecastDemandChart: {
                        type: 'bar',
                        multiSeries: [{
                                name: 'Forecasted Demand',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            },
                            {
                                name: 'Stock Available',
                                data: months.map(() => Math.floor(Math.random() * 3000))
                            }
                        ],
                        categories: months
                    }
                };

                Object.entries(charts).forEach(([id, cfg]) => {
                    const options = {
                        chart: {
                            type: cfg.type,
                            height: 280
                        },
                        colors: ['#5A8DEE', '#39DA8A', '#FF5B5C'],
                        tooltip: {
                            theme: 'dark'
                        }
                    };

                    if (cfg.multiSeries) {
                        options.series = cfg.multiSeries;
                        options.xaxis = {
                            categories: cfg.categories
                        };
                    } else if (cfg.type === 'heatmap') {
                        options.series = cfg.series;
                    } else {
                        options.series = cfg.series;
                        options.labels = cfg.labels;
                    }

                    new ApexCharts(document.querySelector(`#${id}`), options).render();
                });
            });
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>